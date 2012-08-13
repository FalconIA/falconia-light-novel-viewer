<?php

if (!defined('VALID_REQUEST')) die ('Access Denied.'); // Security

require_once(PATH_ROOT . 'config.inc.php');

function get_xml($xml_path) {
	$xml_string = file_get_contents($xml_path);
	$xml_object = simplexml_load_string($xml_string);
	return $xml_object;
}

function parse_novel_list($list_path) {
	global $CNF_PATH_LIST, $CNF_PATH_TEXT, $CNF_PATH_CACHE_PAGES, $CNF_PATH_HIGHLIGHT_XML, $CNF_PATH_HIGHLIGHT_PHP, $CNF_PATH_COVER;

	$list_xml = get_xml($list_path);

	$list = array();
	foreach ($list_xml as $novel_xml) {
		$novel = array();
		$novel['title']          = (string) $novel_xml['title'];
		$novel['author']         = (string) $novel_xml['author'];
		$novel['id']             = (string) $novel_xml['id'];
		$novel['id_link']        = strtolower($novel['id']);

		if ($novel_xml['highlightver']) {
			$novel['highlight_version'] = (int) $novel_xml['highlightver'];

			$highlight_file = (string) $novel_xml['highlight'];

			switch ($novel['highlight_version']) {
				case 1:
					$novel['highlight_xml']  = $highlight_file && preg_match('/\.xml$/', $highlight_file) ? $CNF_PATH_HIGHLIGHT_XML . $highlight_file : $CNF_PATH_HIGHLIGHT_XML . $novel['id'] . '.xml';
					break;
				case 2:
					$novel['highlight_file'] = $highlight_file && preg_match('/\.php$/', $highlight_file) ? $CNF_PATH_HIGHLIGHT_PHP . $highlight_file : $CNF_PATH_HIGHLIGHT_PHP . $novel['id'] . '.highlight.php';
					break;
			}
		}
		elseif ($novel_xml['highlight']) {
			$highlight_file = (string) $novel_xml['highlight'];
			if (preg_match('/\.xml$/', $highlight_file)) {
				$novel['highlight_xml']  = $CNF_PATH_HIGHLIGHT_XML . $highlight_file;
				$novel['highlight_version'] = 1;
			}
			elseif (preg_match('/\.php$/', $highlight_file)) {
				$novel['highlight_file'] = $CNF_PATH_HIGHLIGHT_PHP . $highlight_file;
				$novel['highlight_version'] = 2;
			}
		}
		if ($novel['highlight_version'] == 2) {
			$novel['highlight_file_short'] = preg_replace('{^' . PATH_ROOT . '}', '', $novel['highlight_file']);
		}

		if ($novel_xml['thumb']) {
			$novel['thumb'] = (string) $novel_xml['thumb'];
			$novel['thumb'] = (empty($novel['thumb']) && $novel_xml['thumb2']) ? (string) $novel_xml['thumb2'] : $novel['thumb'];
			$novel['thumb'] = preg_match('/^$|^http:\/\//', $novel['thumb']) ? $novel['thumb'] : $CNF_PATH_COVER . $novel['id'] . '/' . $novel['thumb'];

			if ($novel['thumb'] && $novel_xml['thumbsize']) {
				$thumb_size_string = (string) $novel_xml['thumbsize'];
				if (preg_match('/^\d+,\d+$/', $thumb_size_string)) {
					$thumb_size = explode(',', $thumb_size_string);
					$thumb_w = (int) $thumb_size[0];
					$thumb_h = (int) $thumb_size[1];
					$novel['thumb_style'] = "width: {$thumb_w}px; height: {$thumb_h}px; margin: " . (count($thumb_size) == 4 ? (int) $thumb_size[3] . "px" : ($thumb_h > 226 ? ((226 - $thumb_h) / 2) . "px" : "auto")) . " " . (count($thumb_size) == 4 ? (int) $thumb_size[2] . "px" : ($thumb_w > 160 ? ((160 - $thumb_w) / 2) . "px" : "auto"));
				}
			}
		}
		$last_mtime = 0;
		$last_thumb = '';
		$last_thumb_style = '';

		$novel['volumes']        = array();
		foreach ($novel_xml->volume as $volume_xml) {
			$volume = array();
			$volume['title']      = (string) $volume_xml['title'];
			$volume['id']         = (string) $volume_xml['id'];
			$volume['id_link']    = preg_replace("/^{$novel['id_link']}_/", '', strtolower($volume['id']));
			$volume['list_file']  = $CNF_PATH_LIST . $novel['id'] . '/' . (string) $volume['id'] . '.xml';
			$volume['text_file']  = $CNF_PATH_TEXT . $novel['id'] . '/' . (string) $volume['id'] . '.txt';
			$volume['text_mtime'] = filemtime($volume['text_file']);
			$last_mtime = max($last_mtime, $volume['text_mtime']);
			$volume['pages_file'] = $CNF_PATH_CACHE_PAGES . $volume['id'] . '.json';

			if ($volume_xml['old'])
				$volume['is_old'] = preg_match('/^\s*true\s*$/', (string) $volume_xml['old']) > 0;

			if ($volume_xml['thumb']) {
				$volume['thumb'] = (string) $volume_xml['thumb'];
				$volume['thumb'] = (empty($volume['thumb']) && $volume_xml['thumb2']) ? (string) $volume_xml['thumb2'] : $volume['thumb'];
				$volume['thumb'] = preg_match('/^$|^http:\/\//', $volume['thumb']) ? $volume['thumb'] : $CNF_PATH_COVER . $novel['id'] . '/' . $volume['thumb'];
				$last_thumb = $volume['thumb'];

				if ($volume['thumb'] && $volume_xml['thumbsize']) {
					$thumb_size_string = (string) $volume_xml['thumbsize'];
					if (preg_match('/^\d+,\d+$/', $thumb_size_string)) {
						$thumb_size = explode(',', $thumb_size_string);
						$thumb_w = (int) $thumb_size[0];
						$thumb_h = (int) $thumb_size[1];
						$volume['thumb_style'] = "width: {$thumb_w}px; height: {$thumb_h}px; margin: " . (count($thumb_size) == 4 ? (int) $thumb_size[3] . "px" : ($thumb_h > 226 ? ((226 - $thumb_h) / 2) . "px" : "auto")) . " " . (count($thumb_size) == 4 ? (int) $thumb_size[2] . "px" : ($thumb_w > 160 ? ((160 - $thumb_w) / 2) . "px" : "auto"));
					}
				}
				$last_thumb_style = $volume_xml['thumbsize'] ? $volume['thumb_style'] : '';
			}

			if ($volume_xml['vertpagefix'])
				$volume['vert_page_fix'] = (int) $volume_xml['vertpagefix'];

			$novel['volumes'][$volume['id_link']] = $volume;
		}

		$novel['mtime'] = $last_mtime;

		if ((!array_key_exists('thumb', $novel) || (array_key_exists('thumb', $novel) && !$novel['thumb'])) && $last_thumb) {
			$novel['thumb'] = $last_thumb;

			if ($last_thumb_style)
				$novel['thumb_style'] = $last_thumb_style;
		}

		$list[$novel['id_link']] = $novel;
	}

	return $list;
}

function parse_chapter_list(&$volume) {
	$list_xml = get_xml($volume['list_file']);

	$volume['chapters']  = array();
	foreach ($list_xml->chapter as $chapter_xml) {
		$chapter = array();
		$chapter['title']      = (string) $chapter_xml['title'];
		$chapter['line_start'] = (int) $chapter_xml['start'];
		$chapter['line_end']   = (int) $chapter_xml['end'];
		$chapter['is_valid']   = $chapter['line_start'] > -1 && $chapter['line_start'] <= $chapter['line_end'];

		$volume['chapters'][] = $chapter;
	}

	$imgs = $list_xml->imgs;
	$volume['has_pics']   = $imgs && $imgs->img && count($imgs->img) > 0;

	if ($volume['has_pics']) {
		$volume['pic_dir']    = $imgs['dir'] ? (string) $imgs['dir'] : $novel['id'];
		$volume['pic_prefix'] = (string) $imgs['prefix'];
		$volume['pic_suffix'] = (string) $imgs['suffix'];

		$volume['pictures'] = array();
		foreach ($imgs->img as $picture_xml) {
			$picture = array();
			$picture['file']        = $volume['pic_prefix'] . (string) $picture_xml['filename'] . (strlen((string) $picture_xml['suffix']) ? (string) $picture_xml['suffix'] : $volume['pic_suffix']);

			if ($picture_xml['insert']) {
				$picture['line_insert'] = (int) $picture_xml['insert'];
				$picture['name']        = '彩图' . (string) $picture_xml['filename'];
			}
			else {
				$picture['name']        = (string) $picture_xml['alt'];
			}

			if ($picture_xml['notfloat'])
				$picture['not_float']   = preg_match('/^\s*true\s*$/', (string) $picture_xml['notfloat']) > 0;
			if ($picture_xml['joinnext'])
				$picture['join_next']   = preg_match('/^\s*true\s*$/', (string) $picture_xml['joinnext']) > 0;
			if ($picture_xml['clear'])
				$picture['clear_style'] = preg_replace('/^\s*(both|left|right)\s*$/', '$1', (string) $picture_xml['clear']);

			$volume['pictures'][] = $picture;
		}
	}

	return $volume;
}

function get_novel(&$list, $novel_id) {
	return $list[$novel_id];
}

function get_volume(&$novel, $volume_id) {
	if (!array_key_exists($volume_id, $novel['volumes']))
		return;

	$volume = $novel['volumes'][$volume_id];
	$volume = parse_chapter_list($volume);

	if ($volume['has_pics'])
		process_images($volume);

	return $volume;
}

function get_chapter(&$volume, $chapter_id) {
	process_volume_text($volume);

	$chapter = $volume['chapters'][$chapter_id];
	$chapter['text_lines'] = array_slice($volume['text_lines'], $chapter['line_start'] - 1, $chapter['line_end'] - $chapter['line_start'] + 1);

	if ($chapter_id > 0) {
		$chapter_last = $volume['chapters'][$chapter_id - 1];
		$title_text = array_slice($volume['text_lines'], $chapter_last['line_end'], $chapter['line_start'] - $chapter_last['line_end'] - 1);
		$title_text = trim(implode('', $title_text));
		$title_text = preg_replace('/(!!|!\?|·|…|♪)/u', '<span class="sign">$1</span>', $title_text);
		$title_text = preg_replace('/  /u', '<span class="sign">&nbsp;&nbsp;</span>', $title_text);
		$chapter['title_text'] = $title_text;
	}

	//process_chapter_text($novel, $volume, $chapter);

	//global $DEBUG;
	//$DEBUG = implode('<br />', $chapter['text_lines']);

	return $chapter;
}

function process_volume_text(&$volume) {
	$volume['text'] = file_get_contents($volume['text_file'], false, null, 3);
	$volume['text'] = preg_replace('/(^|\r\n|\n|\r)(　　(?!　)|    (?! ))/', '$1', $volume['text']);
	$volume['text_lines'] = preg_split('/\r\n|\n|\r/', $volume['text']);

	if ($volume['has_pics']) {
		foreach ($volume['pictures'] as $picture) {
			if (array_key_exists('line_insert', $picture) && $picture['line_insert']) {
				/* $pic_html = "\r\n" . '<div class="picture'
					. (array_key_exists('join_next', $picture) && $picture['join_next'] ? ' joinNext' : '')
					. (array_key_exists('not_float', $picture) && $picture['not_float'] ? ' notFloat' : '') . '"'
					. (array_key_exists('clear_style', $picture) && $picture['clear_style'] ? ' style="clear: ' . $picture['clear_style'] . ';"' : '')
					. '><a href="' . $picture['file'] . '" target="_blank" rel="shadowbox[line-'. $picture['line_insert'] . ']"><img' . ' src="' . ($picture['file_thumb'] ? $picture['file_thumb'] : $picture['file']) . '" /></a></div>';
				$volume['text_lines'][$picture['line_insert'] - 1] .= $pic_html; */
				$volume['text_lines'][$picture['line_insert'] - 1] .= "（{$picture['name']}）";
			}
		}
	}
}

function process_chapter_text(&$novel, &$volume, &$chapter) {
	$text = '<p>' . implode("</p>\r\n<p>", $chapter['text_lines']) . '</p>';

	$text = preg_replace('/\[LOST\]/u', '<span class="tooltip lost" desc="The content is lost.">…………</span>', $text);

	if ($novel['highlight_version'] == 2) {
		include_once($novel['highlight_file']);
		$sepcial_subtitile = $highlight->sepcial_subtitile ? '|' . $highlight->sepcial_subtitile : '';
	}

	// Add style for subtitles
	$subtitle_pattern = "<p>([\d１２３４５６７８９０]+" . ($sepcial_subtitile ? $sepcial_subtitile : '') . ")<\\/p>(\r\n<p><\\/p>)";
	$text = preg_replace("/^(){$subtitle_pattern}/u", '$1<p class="subtitle">$2</p>$3', $text);
	$text = preg_replace("/<p><\\/p>(\r\n){$subtitle_pattern}/u", '<p class="subend"></p>$1<p class="subtitle">$2</p>$3', $text);

	if ($novel['highlight_version'] == 2) {
		include_once($novel['highlight_file']);
		$highlight->highlightText($text);
	}

	if ($volume['has_pics']) {
		// Fix for inser pictures
		$text = preg_replace('/<p>(?=<div )|(?<=<\/div>)<\/p>/', '', $text);

		foreach ($volume['pictures'] as $picture) {
			if (array_key_exists('name', $picture) && $picture['name']) {
				$pic_html = '<div class="picture'
					. (array_key_exists('join_next', $picture) && $picture['join_next'] ? ' joinNext' : '')
					. (array_key_exists('not_float', $picture) && $picture['not_float'] ? ' notFloat' : '') . '"'
					. (array_key_exists('clear_style', $picture) && $picture['clear_style'] ? ' style="clear: ' . $picture['clear_style'] . ';"' : '')
					.'><a href="' . $picture['file'] . '" target="_blank" rel="shadowbox' . ($picture['line_insert'] ? '[line-'. $picture['line_insert'] . ']' : '') . '"><img' . ' src="' . ($picture['file_thumb'] ? $picture['file_thumb'] : $picture['file']) . '"></a></div>';
				$text = preg_replace("/<p>（{$picture['name']}）<\/p>/", $pic_html, $text);
				$text = preg_replace("/（{$picture['name']}）/", $pic_html, $text);
			}
		}
	}

	$text = preg_replace('/  (?![^<]*>)/u', '<span class="sign">&nbsp;&nbsp;</span>', $text);

	$text = preg_replace('/(—{10}|…{10})/u', '$1<!-- -->', $text);
	$text = preg_replace('/(——|……)/u', '<span class="sign2">$1</span>', $text);
	$text = preg_replace('/(—)/u', '<span class="sign1">$1</span>', $text);
	$text = preg_replace('/(…|·)/u', '<span class="sign1-2">$1</span>', $text);
	$text = preg_replace('/(!!|!\?|\?\?|♪)/u', '<span class="sign">$1</span>', $text);
	$text = preg_replace('/<span class="sign2">(?:<span class="sign([0-9-]*)">([^<>]+)<\/span>){2}<\/span>(?=[^"<>]*(<span class="sign[0-9-]*">(?:(?:<span class="sign[0-9-]*">[^"<>]+<\/span>){2}|[^"<>]+)<\/span>[^"<>]*)*">)/u', htmlspecialchars('<span class="sign2"><span class="sign$1">$2</span><span class="sign$1">$2</span></span>'), $text);
	$text = preg_replace('/<span class="sign([0-9-]*)">([^<>]+)<\/span>(?=[^"<>]*(?:<span class="sign[0-9-]*">(?:(?:<span class="sign[0-9-]*">[^"<>]+<\/span>){2}|[^"<>]+)<\/span>[^"<>]*)*">)/u', htmlspecialchars('<span class="sign$1">$2</span>'), $text);

	$chapter['text'] = $text;

	return $chapter['text'];
}

function get_pages_v(&$volume, &$chapter) {
	process_volume_text($volume);

	$pages = array();
	for ($i = 0; $i < count($volume['chapters']); $i++) {
		$volume['chapters'][$i]['text_lines'] = array_slice($volume['text_lines'], $volume['chapters'][$i]['line_start'] - 1, $volume['chapters'][$i]['line_end'] - $volume['chapters'][$i]['line_start'] + 1);
		$chapter_pages = get_chapter_pages_v($volume, $volume['chapters'][$i], count($pages));
		if ($i > 0 && $chapter_pages[0][1]['is_title']) {
			$chapter_last = $volume['chapters'][$i - 1];
			$title_text = array_slice($volume['text_lines'], $chapter_last['line_end'], $volume['chapters'][$i]['line_start'] - $chapter_last['line_end'] - 1);
			$title_text = trim(implode('', $title_text));
			$title_text = preg_replace('/^(?:(序|终)(章)|(后)(记)|(行间)(\S))/u', '$1$3$5　$2$4$6', $title_text);
			$volume['chapters'][$i]['title_text'] = $title_text;
			$chapter_pages[0][1]['text'] = $title_text;
		}
		$volume['chapters'][$i]['text_lines'] = null;
		$volume['chapters'][$i]['page_start'] = count($pages);
		$volume['chapters'][$i]['page_end']   = $volume['chapters'][$i]['page_start'] + count($chapter_pages) - 1;
		$volume['chapters'][$i]['page_start_fix'] = $volume['chapters'][$i]['page_start'] > $volume['vert_text_fix'] ? ($volume['chapters'][$i]['page_start'] - $volume['vert_page_fix']) : '0,' . $volume['chapters'][$i]['page_start'];
		$pages = array_merge($pages, $chapter_pages);
	}
	//$volume['pages'] = $pages;
	$volume['text']       = null;
	$volume['text_lines'] = null;

	//$DEBUG = '<pre>' . var_export($pages, true) . '</pre>';exit($DEBUG);

	return array(
		'page_max' => $volume['chapters'][count($volume['chapters']) - 1]['page_end'],
		'page_fix' => $volume['vert_page_fix'] ?  $volume['vert_page_fix'] : 0,
		'chapters' => $volume['chapters'],
		'lines' => $pages
	);
}

function get_chapter_pages_v(&$volume, &$chapter, $pages_before) {
	global $CNF_MAX_WORDS_IN_LINE, $CNF_MAX_LINES_IN_PAGE;

	// Config
	$char_width = array();
	$char_width[] = array( 'value' => -0.5, 'reg' => '/^　　「|『|（/u');
	$char_width[] = array( 'value' => -0.15, 'reg' => '/(?<!^　　)「|」|『|』|（|）/u');
	//$char_width[] = array( 'value' => -0.05, 'reg' => '/，|。/u');
	// Patterns
	$pic_pattern = '/(　*（' . implode('）|　*（', array_keys($volume['pictures_by_name'])) . '）)/ui';
	$subtitle_pattern = "/^　*([\d１２３４５６７８９０]+" . ($sepcial_subtitile ? $sepcial_subtitile : '') . ")$/ui";
	// Default wrap line item
	$default_wrap_line = array(
		'text'        => null,
		'pic'         => null,
		'new_line'    => false,
		'new_page'    => false,
		'new_chapter' => false,
		'after_title' => false,
		'is_title'    => false,
		'is_subtitle' => false,
		'is_pic'      => false,
		'is_two_page' => false
	);

	$text_lines = $chapter['text_lines'];
	//$DEBUG = '<pre>' . var_export($text_lines, true) . '</pre>';exit($DEBUG);

	$chapter_wrap_lines = array();
	foreach ($text_lines as $text_line) {
		if (!$volume['has_pics'] || $text_line == '') {
			$lines = array( '　　' . $text_line );
		}
		else {
			$lines = preg_split($pic_pattern, '　　' . $text_line, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
		}

		$wrap_lines = array();
		foreach ($lines as $line) {
			$wrap_line = $default_wrap_line;

			// Check whether the line is picture
			if ($volume['has_pics'] && preg_match($pic_pattern, $line)) {
				$pic_name = mb_substr(preg_replace('/^　　/u', '', $line), 1, -1);
				$pic = $volume['pictures_by_name'][$pic_name];
				$wrap_line['text']        = preg_replace('/^　　/u', '', $line);
				$wrap_line['pic']         = $pic;
				$wrap_line['new_line']    = true;
				$wrap_line['new_page']    = true;
				$wrap_line['is_pic']      = true;
				$wrap_line['is_two_page'] = $pic['is_two_page'];
				$wrap_lines[] = $wrap_line;
				continue;
			}

			$line_length = mb_strlen($line);

			if ($line_length <= $CNF_MAX_WORDS_IN_LINE) {
				// Check whether the line is subtitle
				if (preg_match($subtitle_pattern, $line))
					$wrap_line['is_subtitle'] = true;

				$wrap_line['new_line']    = true;
				$wrap_line['text']        = preg_replace('/^　　/u', '', $line);;
				$wrap_lines[] = $wrap_line;
				continue;
			}

			$pos = 0;
			$len = (int)$CNF_MAX_WORDS_IN_LINE;

			while ($pos + $len < $line_length) {
				$part = mb_substr($line, $pos, $len);
				$width = mb_strlen($part);

				foreach ($char_width as $char_measue) {
					if (preg_match_all($char_measue['reg'], $part, $matches)) {
						$width += $char_measue['value'] * count($matches[0]);
					}
				}
				//echo "width = {$width}, part = {$part}<br>";

				if ($width >= $CNF_MAX_WORDS_IN_LINE) {
					if ($width > $CNF_MAX_WORDS_IN_LINE) {
						$len--;
						$part = mb_substr($part, 0, $len);
					}
					else {
					}
					$wrap_line['text'] = $part;
					$wrap_lines[] = $wrap_line;
					$pos += $len;
					$len = (int)$CNF_MAX_WORDS_IN_LINE;
				}
				else {
					$len++;
				}
			}

			if ($pos + $len >= $line_length) {
				$wrap_line['text'] = mb_substr($line, $pos, $len);
				$wrap_lines[] = $wrap_line;
			}
		}
		$wrap_lines[0]['new_line'] = true;
		$wrap_lines[0]['text'] = preg_replace('/^　　/u', '', $wrap_lines[0]['text']);

		$chapter_wrap_lines = array_merge($chapter_wrap_lines, $wrap_lines);
	}
	//$DEBUG = '<pre>' . var_export($chapter_wrap_lines, true) . '</pre>';exit($DEBUG);

	$pages = array();
	$pages[] = array();

	if ($chapter['title'] != '') {
		// Line 1
		$wrap_line = $default_wrap_line;
		$wrap_line['new_chapter'] = true;
		$wrap_line['new_page']    = true;
		$wrap_line['new_line']    = true;
		$wrap_line['text']        = '';
		$pages[0][] = $wrap_line;
		// Line 2
		$wrap_line = $default_wrap_line;
		$wrap_line['new_line']    = true;
		$wrap_line['is_title']    = true;
		$wrap_line['text']        = $chapter['title'];
		$pages[0][] = $wrap_line;
		// Line 3
		$wrap_line = $default_wrap_line;
		$wrap_line['after_title'] = true;
		$wrap_line['new_line']    = true;
		$wrap_line['text']        = '';
		$pages[0][] = $wrap_line;
		// Line 4
		$wrap_line['after_title'] = false;
		$pages[0][] = $wrap_line;
	}

	$count_lines = count($pages[0]);

	foreach ($chapter_wrap_lines as $wrap_line) {
		if ($wrap_line['new_page'] || $count_lines >= $CNF_MAX_LINES_IN_PAGE) {
			if ($wrap_line['new_page']) {
				if ($wrap_line['is_two_page']) {
					if (($pages_before + count($pages)) % 2 == 1) {
						$pages[] = array();
					}
					$pages[] = array($wrap_line);
					$pages[] = array();
				}
				else {
					if ($wrap_line['pic']['id'] + 1 < count($volume['pictures']) && $volume['pictures'][$wrap_line['pic']['id'] + 1]['clear_style']) {
						$pages[] = array();
					}
					$pages[] = array($wrap_line);
				}
				$count_lines = $CNF_MAX_LINES_IN_PAGE;
				continue;
			}

			$pages[] = array();
			$count_lines = 0;
		}
		$pages[count($pages) - 1][] = $wrap_line;
		$count_lines++;
	}
	if ($pages_before == 0 && count($pages) % 2 == 1) {
		$pages[] = array();
	}
	//$DEBUG = '<pre>' . var_export($pages, true) . '</pre>';exit($DEBUG);

	return $pages;
}

function get_two_pages_v($pages, $page_id) {
	$id = $page_id - $page_id % 2;
	$two_pages   = array();
	$two_pages[] = get_page_v($pages, $id);
	if ($id + 1 < $pages['page_max'])
		$two_pages[] = get_page_v($pages, $id + 1);
	return $two_pages;
}

function get_page_v($pages, $page_id) {
	$display_pages = array();
	$display_pages = $pages['lines'][$page_id];
	$lines = array();
	foreach($display_pages as $line) {
		if ($line['is_pic']) {
			$picture = $line['pic'];
			$pic_html = '<div class="picture'
				. (array_key_exists('is_two_page', $picture) && $picture['is_two_page'] ? ' twoPage' : '')
				.'"><a href="' . $picture['file'] . '" target="_blank" rel="shadowbox' . ($picture['line_insert'] ? '[line-'. $picture['line_insert'] . ']' : '') . '"><img' . ' src="' . ($picture['file_thumb'] ? $picture['file_thumb'] : $picture['file']) . '" style="margin-top: ' . ((650 - ($picture['size_thumb'] ? $picture['size_thumb'][1] : min($picture['size'][1], 650))) / 2) . 'px;"></a></div>';
			$lines[] = $pic_html;
		}
		else if (count($lines) == 0 && !$line['new_line']) {
			$lines[] = '<p>' . $line['text'];
		}
		else if ($line['new_line']) {
			if (count($lines) != 0)
				$lines[count($lines) - 1] .= '</p>';
			$lines[] = '<p class="newLine'
				. ($line['is_title'] ? ' isTitle' : '')
				. ($line['is_subtitle'] ? ' isSubTitle' : '')
				. ($line['after_title'] ? ' afterTitle' : '')
				. '">' . $line['text'];
		}
		else
			$lines[count($lines) - 1] .= $line['text'];
	}
	if (!$display_pages[count($display_pages) - 1]['is_pic']) {
		$lines[count($lines) - 1] .= '</p>';
	}

	$text = implode("\r\n", $lines);
	$text = preg_replace('/(?<=>)(「|『|（)/u', '<span class="sign-quotes-1">$0</span>', $text);
	$text = preg_replace('/(?<!>)「/u', '<span class="sign-quotes-3">$0</span>', $text);
	$text = preg_replace('/」/u', '<span class="sign-quotes-4">$0</span>', $text);
	$text = preg_replace('/(?<!>)『/u', '<span class="sign-quotes-3">$0</span>', $text);
	$text = preg_replace('/』/u', '<span class="sign-quotes-4">$0</span>', $text);
	$text = preg_replace('/(?<!>)（/u', '<span class="sign-quotes-5">$0</span>', $text);
	$text = preg_replace('/）/u', '<span class="sign-quotes-6">$0</span>', $text);
	$text = preg_replace('/…/u', '<span class="sign">$0</span>', $text);
	//$text = preg_replace('/，|。/u', '<span class="sign-2">$0</span>', $text);

	$page = array();
	$page['text'] = $text;
	$page['is_two_page'] = preg_match('/^<div class="picture twoPage">/', $text) ? true : false;
	$page['id'] = $page_id;
	$page['next_id'] = $page_id < $pages['page_max'] ? $page_id + 1 : 0;
	$page['prev_id'] = $page_id - 1;
	$page['prev2_id'] = $page_id - 2;
	$page['next_id_fix']  = $pages['page_fix'] && $page['next_id']  >= 0 ? ($page['next_id']  > $pages['page_fix'] ? $page['next_id']  - $pages['page_fix'] : '0,' . $page['next_id'] ) : '';
	$page['prev_id_fix']  = $pages['page_fix'] && $page['prev_id']  >= 0 ? ($page['prev_id']  > $pages['page_fix'] ? $page['prev_id']  - $pages['page_fix'] : '0,' . $page['prev_id'] ) : '';
	$page['prev2_id_fix'] = $pages['page_fix'] && $page['prev2_id'] >= 0 ? ($page['prev2_id'] > $pages['page_fix'] ? $page['prev2_id'] - $pages['page_fix'] : '0,' . $page['prev2_id']) : '';

	return $page;
}

function process_images(&$volume) {
	global $CNF_PATH_PIC, $CNF_PATH_PIC_THUMB;

	$volume['pictures_by_name'] = array();
	for ($i = 0; $i < count($volume['pictures']); $i++) {
		$pic_path       = "{$CNF_PATH_PIC}{$volume['pic_dir']}/{$volume['pictures'][$i]['file']}";
		$pic_thumb_path = "{$CNF_PATH_PIC}{$volume['pic_dir']}/{$CNF_PATH_PIC_THUMB}/{$volume['pictures'][$i]['file']}";
		$pic_size       = getimagesize(PATH_ROOT . $pic_path);
		if (file_exists(PATH_ROOT . $pic_thumb_path)) {
			$volume['pictures'][$i]['file_thumb'] = $pic_thumb_path;
			$pic_thumb_size = getimagesize(PATH_ROOT . $pic_thumb_path);
			$volume['pictures'][$i]['size_thumb'] = array( 0 => $pic_thumb_size[0], 1 => $pic_thumb_size[1] );
		}
		$volume['pictures'][$i]['file'] = $pic_path;
		$volume['pictures'][$i]['size'] = array( 0 => $pic_size[0], 1 => $pic_size[1] );
		$volume['pictures'][$i]['is_two_page'] = $pic_size[0] >= $pic_size[1];
		$volume['pictures_by_name'][$volume['pictures'][$i]['name']] = $volume['pictures'][$i];
		$volume['pictures_by_name'][$volume['pictures'][$i]['name']]['id'] = $i;
	}

	return $volume['pictures'];
}

?>