<?php

if (!defined('VALID_REQUEST')) die ('Access Denied.'); // Security

require_once(PATH_ROOT . 'config.inc.php');
require_once(PATH_HIGHLIGHT . 'base.highlight.php');


function preg_replace_ex($lookbehind, $pattern, $replacement, $subject) {
	$pattern_ex = substr($pattern, 0, 1) . '(?<lookbehind>' . substr($lookbehind, 1, -1) . ')?(?<match>' . substr($pattern, 1, -1) . ')' . substr($pattern, -1) . 'u';

	$pattern_escape = str_replace('\'', '\\\'', $pattern) . 'u';
	$replacement_escape = str_replace('\'', '\\\'', $replacement);

	$callback = create_function(
		'$matches',
		"\$pattern = '{$pattern_escape}';" .
		"\$replacement = '{$replacement_escape}';" .
		"if (\$matches['lookbehind'] === NULL) \$matches['lookbehind'] = \$matches[1];" .
		"if (\$matches['match']      === NULL) \$matches['match']      = \$matches[2];" .
		//"echo \"\r\n<br />\"; echo var_export(\$matches, true);" .
		"\$match = \$matches['match'];" .
		"if (strlen(\$matches['lookbehind']) == 0) { \$match = preg_replace(\$pattern, \$replacement, \$match); }" .
		"return \$matches['lookbehind'] . \$match;"
	);

	return preg_replace_callback($pattern_ex, $callback, $subject);
}


class HighlightItem {
	public static function createChars($pattern, $delimiter = ' ', $alias = null, $desc = null) {
		$patterns = explode($delimiter, $pattern);

		if (count($patterns) < 2)
			if (trim($pattern))
				return array(new HighlightItem($pattern, $alias, $desc));
			else
				return array();

		$patterns = array(implode(trim($delimiter) ? $delimiter : '', $patterns), $patterns[count($patterns) - 1], $patterns[0]);

		$items = array();
		foreach ($patterns as $pattern) {
			$item = new HighlightItem($pattern, $alias,  $desc);
			$item->alias = $alias;
			$item->desc = $desc;
			$items[] = $item;
		}

		return $items;
	}

	public static function replaceFrom($replace, $pattern, $alias = null, $desc = null, $thumb = null) {
		$item = new HighlightItem($replace, $alias, $desc, $pattern);
		//$item->alias = $alias;
		$item->thumb = $thumb;
		$item->desc = "<div>" . ($desc ? $desc : '') . "</div><div class=\"_replacefrom\">Replace From: " . ($item->isRegex ? '$0' : $item->pattern) . "</div>";
		$item->cat = 'replacefrom';
		$item->isReplace = true;

		return $item;
	}

	public $pattern;
	public $replace;
	public $alias;
	public $desc;
	public $thumb;
	public $cat;
	public $priority;
	public $isTrans;
	public $isReplace;

	public $isRegex;
	public $isEmpty;

	function __construct() {
		$a = func_get_args();
		$i = func_num_args();
		if (method_exists($this, $f = '__construct' . $i)) {
			call_user_func_array(array($this, $f), $a);
		}
		$this->hasBackRef = $this->hasBackRef();
	}

	function __construct1($pattern) {
		$this->setPattern($pattern);
	}

	function __construct3($pattern, $alias, $desc) {
		$this->setPattern($pattern);
		$this->alias = $alias;
		$this->desc = $desc;
	}

	function __construct2($replace, $pattern) {
		$this->setPattern($pattern);
		$this->replace = $replace;
	}

	function __construct4($replace, $alias, $desc, $pattern) {
		$this->setPattern($pattern);
		$this->replace = $replace;
		$this->alias = $alias;
		$this->desc = $desc;
	}

	function __construct5($replace, $alias, $desc, $pattern, $cat) {
		if ($pattern == NULL)
			$this->__construct3($replace, $alias, $desc);
		else
			$this->__construct4($replace, $alias, $desc, $pattern);
		$this->cat = $cat;
	}

	function setPattern($pattern) {
		$this->pattern = $pattern;
		$this->isRegex = (bool) preg_match('/^\/.+\/i?$/', $pattern);
		$this->isEmpty = (bool) preg_match('/^\s*$/', $pattern);
	}

	public function getFlatPattern() {
		return trim($this->pattern, '/');
	}

	public function hasBackRef() {
		return ($this->isRegex && $this->replace === null) || preg_match('/\$\d+/u', "{$this->alias} {$this->desc} {$this->replace}") > 0;
	}
}

class Highlight__Tr extends HighlightItem {
	function __construct() {
		$a = func_get_args();
		call_user_func_array(array($this, 'parent::__construct'), $a);
		$this->isTrans = true;
	}
}

class Highlight_Img extends HighlightItem {
	function __construct() {
		$a = func_get_args();
		$i = func_num_args();
		call_user_func_array(array($this,'parent::__construct' . ($i - 1)), $a);
		$this->thumb = $a[$i - 1];
	}
}


function New_Highlight__Re($replace, $pattern, $alias = null, $desc = null, $thumb = null) {
	return HighlightItem::replaceFrom($replace, $pattern, $alias, $desc, $thumb);
}

function ArrCharHighlightItem(&$list, $pattern, $delimiter = ' ', $alias = null, $desc = null) {
	if ($delimiter === null)
		$delimiter = ' ';
	$list = array_merge($list, HighlightItem::createChars($pattern, $delimiter, $alias, $desc));
	return $list;
}


abstract class HighlightBase {
	public $dic = array();
	public $sepcial_subtitile = '';

	private $callback_pattern;
	private $callback_replace;
	private $callback_prefix;
	private $callback_suffix;
	private $callback_replace_array = array();


	function AddItemFunctionByCatName($cat, $sub = null) {
		$fun = 'Highlight' . ($cat ? '_' . strtr($cat, ' ', '_') : '') . ($sub ? "_{$sub}" : '');
		if (!function_exists($fun))
			return;
		if (array_key_exists($cat, $this->dic) && count($this->dic[$cat]))
			$this->dic[$cat] = array_merge($this->dic[$cat], $fun());
		else
			$this->dic[$cat] = $fun();
	}

	function getCommentLightItems() {
		return HighlightBaseItems::GetCommentLightItems();
	}

	function getCommentItems() {
		return HighlightBaseItems::GetCommentItems();
	}

	function getCommentEndItems() {
		return HighlightBaseItems::GetCommentEndItems();
	}

	function getIdiomItems() {
		return HighlightBaseItems::GetIdiomItems();
	}

	function parseDicItems() {
		$i = 0;
		$items = array();

		foreach ($this->dic as $cat => $list) {
			foreach($list as $item) {
				if ($item->isEmpty)
					continue;
				$item->cat = $cat . ($item->cat ? " {$item->cat}" : '');
				$item->id = $i++;
				$key = $item->pattern;
				//$key = $item->getFlatPattern();
				if (!array_key_exists($key, $items))
					$items[$item->getFlatPattern()] = $item;
				else if ($item->priority > $items[$key]->priority)
					$items[$key] = $item;
			}
		}

		$items = array_combine(range(0, count($items) - 1), $items);

		//usort($items, 'pattern_compare');
		$items = $this->sortItems($items);

		return $items;
	}

	function sortItems($items) {
		$n = count($items);

		for ($i1 = 0; $i1 < $n; $i1++) {
			//echo '<br />' . $i1 . ': ';
			for ($i2 = $n - 1; $i2 > $i1; $i2--) {
				if (($pos = strpos($items[$i2]->pattern, $items[$i1]->pattern)) !== false && $items[$i1]->pattern !== $items[$i2]->pattern) {
				//if (($pos = strpos($items[$i2]->getFlatPattern(), $items[$i1]->getFlatPattern())) !== false && $items[$i1]->getFlatPattern() !== $items[$i2]->getFlatPattern()) {
					//var_dump($i1, $items[$i1]->pattern, $i2, $items[$i2]->pattern, count($a1), count($a2), count($a3));
					//echo "{$pos}, {$i1} => '{$items[$i1]->pattern}', {$i2} => '{$items[$i2]->pattern}'";
					$a1 = array_slice($items, 0, $i1 - 0);
					$a2 = array_slice($items, $i1 + 1, $i2 - ($i1 + 1));
					$a3 = array_slice($items, $i2 + 1, $n  - ($i2 + 1));
					$items = array_merge($a1, $a2, array_slice($items, $i2, 1), array_slice($items, $i1, 1), $a3);
					$i1--;
					break;
				}
			}
		}

		return $items;
	}

	public function highlightText(&$text) {
		if (!$text)
			return '';

		$items = array();

		//$items_dic = $this->parseDicItems();

		$items = array_merge($items, $this->getCommentLightItems());
		$items = array_merge($items, $this->getCommentItems());

		$items = array_merge($items, $this->parseDicItems());
		
		$items = array_merge($items, $this->getCommentEndItems());
		$items = array_merge($items, $this->getIdiomItems());

		/*
		global $DEBUG;
		$DEBUG = htmlspecialchars(var_export($items, true));
		//$DEBUG = preg_replace('/\r?\n\s+\'[^\']+\' =&gt;\s+array \(/', '<br />$0', $DEBUG);
		//$DEBUG = preg_replace('/\r?\n\s+\d+ =&gt;/', '<br />$0', $DEBUG);
		$DEBUG = preg_replace('/(\r?\n\s+)(\d+)( =&gt;\s+)(HighlightItem|Highlight__Tr)::__set_state/', '<br />$1<u>$2</u>$3<b>$4</b>', $DEBUG);
		//$DEBUG = preg_replace('/(\r?\n\s+\')([^\']+)(\' =&gt;\s+)(HighlightItem|Highlight__Tr)::__set_state/', '<br />$1<u>$2</u>$3<b>$4</b>', $DEBUG);
		$DEBUG = preg_replace('/\s+\'[^\']+\' =&gt; NULL,/', '', $DEBUG);
		$DEBUG = preg_replace('/(\s+\'[^\']+\' =&gt; )(\'?)([^\r\n]*)(\2,\r?\n)/', '$1$2<cite>$3</cite>$4', $DEBUG);
		*/

		$this->highlightUrl($text);

		/*
		foreach ($items as $item)
			$this->highlightByItem($text, $item);
		*/

		$this->callback_replace_array = array();

		foreach ($items as $item)
			$this->highlightByItem_v2($text, $item);

		for ($i = 0; $i < count($this->callback_replace_array); $i++)
			$text = str_replace("{{{$i}}}", $this->callback_replace_array[$i], $text);
	}

	function highlightUrl(&$text) {
		$arr_redirect_to = array(
			'http://www.lightnovel.cn/' => '/http:\/\/www\.light-kingdom\.com(\/(index\.php)?)?|http:\/\/www\.lightnovel\.cn\/bbs\/?/'
		);
		$this->redirectUrl($text, $arr_redirect_to);

		$text = preg_replace_ex('/(?:src|href)\s*=\s*[\'"]\s*|<a(?: [^<>]+)? *>|desc="[^"]*/', '/http:\/\/[-\w\d\.]+(\/([^\s<"\']+)?)?/', '<span class="highlight"><a href="$0" target="_blank">$0</a></span>', $text);

		//echo htmlspecialchars($text2);
	}

	function redirectUrl(&$text, $arr_redirect_to) {
		foreach ($arr_redirect_to as $key => $regex)
			$text = preg_replace($regex . 'u', '<span class="highlight tooltip" desc="' . (htmlspecialchars('<div class=\"_alias\">轻之国度</div>' . '<div class="_redirect">Redirect to: ' . $key . '</div>')) . '"><a href="' . $key . '" target="_blank">$0</a></span>', $text);
	}

	function highlightByItem(&$text, $item) {
		global $CNF_PATH_HIGHLIGHT_THUMB, $novel;

		if ($item->replace && preg_match('/┠|┨/u', $item->replace)) {
			preg_match('/(?:(.+)┠)?([^┠┨]+)(?:┨(.+))?/u', $item->replace, $fixes);
			$prefix = $fixes[1];
			$suffix = $fixes[3];
			$item->replace = $fixes[2];
		}

		$replace = ($prefix ? $prefix : '') . '<span class="highlight' . ($item->alias || $item->thumb || $item->desc ? ' tooltip' : '') . ($item->cat ? ' ' . $item->cat : '') . ($item->isTrans ? ' translate' : '') . '"' .
			($item->alias || $item->thumb || $item->desc ? ' desc="' . htmlspecialchars(($item->alias ? "<div class=\"_alias\">{$item->alias}</div>" : '') . ($item->thumb ? "<div class=\"_thumb\"><img src=\"{$CNF_PATH_HIGHLIGHT_THUMB}{$novel['id']}/{$item->thumb}\" /></div>" : '') . ($item->desc ? "<div class=\"_desc\">{$item->desc}</div>" : '')) . '"' : '') . '>' .
			($item->replace !== null ? $item->replace : ($item->isRegex ? '$0' : $item->pattern)) . '</span>' . ($suffix ? $suffix : '');

		$text = preg_replace_ex('/<span class="highlight[^"]*"(?: desc="[^"]+")?>[^<>]*|desc="[^"]*/', $item->isRegex ? $item->pattern : "/{$item->pattern}/", $replace, $text);
	}

	function highlightByItem_v2(&$text, $item) {
		global $CNF_PATH_HIGHLIGHT_THUMB, $novel;

		if ($item->replace && preg_match('/┠|┨/u', $item->replace)) {
			preg_match('/(?:(.+)┠)?([^┠┨]+)(?:┨(.+))?/u', $item->replace, $fixes);
			$prefix = $fixes[1];
			$suffix = $fixes[3];
			$item->replace = $fixes[2];
		}

		$pattern = $item->isRegex ? $item->pattern . 'u' : "/{$item->pattern}/u";

		$replace = '<span class="highlight' . ($item->alias || $item->thumb || $item->desc ? ' tooltip' : '') . ($item->cat ? ' ' . $item->cat : '') . ($item->isTrans ? ' translate' : '') . '"' .
			($item->alias || $item->thumb || $item->desc ? ' desc="' . htmlspecialchars(($item->alias ? "<div class=\"_alias\">{$item->alias}</div>" : '') . ($item->thumb ? "<div class=\"_thumb\"><img src=\"{$CNF_PATH_HIGHLIGHT_THUMB}{$novel['id']}/{$item->thumb}\" /></div>" : '') . ($item->desc ? "<div class=\"_desc\">{$item->desc}</div>" : '')) . '"' : '') . '>' .
			($item->replace !== null ? $item->replace : ($item->isRegex ? '$0' : $item->pattern)) . '</span>';

		if (!$item->hasBackRef()) {
			$i = count($this->callback_replace_array);
			$this->callback_replace_array[$i] = ($prefix ? $prefix : '') . $replace . ($suffix ? $suffix : '');

			$text = preg_replace($pattern, "{{{$i}}}", $text);
		}
		else {
			$this->callback_pattern = $pattern;
			$this->callback_replace = $replace;
			$this->callback_prefix  = $prefix ? $prefix : '';
			$this->callback_suffix  = $suffix ? $suffix : '';

			$text = preg_replace_callback($pattern, array($this, 'highlightByItem_v2_replace_callback'), $text);
		}
	}

	function highlightByItem_v2_replace_callback($matches) {
		$i = count($this->callback_replace_array);
		$this->callback_replace_array[$i] = preg_replace($this->callback_pattern, $this->callback_replace, $matches[0]);
		$prefix = preg_match('/\$/', $this->callback_prefix) ? preg_replace($this->callback_pattern, $this->callback_prefix, $matches[0]) : $this->callback_prefix;
		$suffix = preg_match('/\$/', $this->callback_suffix) ? preg_replace($this->callback_pattern, $this->callback_suffix, $matches[0]) : $this->callback_suffix;

		return "{$prefix}{{{$i}}}{$suffix}";
	}
}

?>
