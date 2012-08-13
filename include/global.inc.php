<?php

/**
 * Global Library
 *
 * @version 1.0.1.20120730
 */

/**
 * Magic constants
 */

if (!defined('PHP_VERSION_ID')) {
	$version = explode('.', PHP_VERSION);
	define('PHP_VERSION_ID', ($version[0] * 10000 + $version[1] * 100 + $version[2]));
}

if (PHP_VERSION_ID < 50207) {
	define('PHP_MAJOR_VERSION',   $version[0]);
	define('PHP_MINOR_VERSION',   $version[1]);
	define('PHP_RELEASE_VERSION', $version[2]);
}

/**
 * String Utility
 */
 
function startsWith($haystack, $needle) {
	$length = strlen($needle);
	return (substr($haystack, 0, $length) === $needle);
}

function endsWith($haystack, $needle) {
	$length = strlen($needle);
	return (substr($haystack, $length * -1) === $needle);
}

/**
 * URL Utility
 */

function join_url($url1, $url2) {
	if (strlen($url1) <= 0 || strlen($url2) <= 0)
		return '';
	elseif (strlen($url1) <= 0)
		return trim($url2);
	elseif (strlen($url2) <= 0)
		return trim($url1);

	$url1 = preg_match('{^https?:/{0,2}$}i', $url1) ? '' : trim($url1);
	$url2 = trim($url2);

	if (preg_match('{^https?://}i', $url2))
		return $url2;
	elseif (startsWith($url2, '/'))
		if ((startsWith($url1, 'http://') || startsWith($url1, 'https://')) && preg_match('{^(https?://[^/]+)/?}i', $url1, $match))
			return "{$match[1]}{$url2}";
		else
			return $url2;
	elseif (preg_match('{^[?#]}i', $url2))
		return "{$url1}{$url2}";
	elseif (preg_match('{^(https?://[^/]+)$}i', $url1, $match))
		return "{$match[1]}/{$url2}";
	elseif (preg_match('{^(.+/)[^/]*$}i', $url1, $match))
		return "{$match[1]}{$url2}";
	else
		return $url2;
}

/**
 * Debug Utility
 */

function debug_dump($string) {
	if (!is_string($string))
		$string = var_export($string, true);
	return "
<div style=\"text-align: left; background-color: #111; color: #999; border: 1px solid #999; padding: 0px .25em; z-index: 1000; float: left;\">
" . preg_replace('/[\r\n]{1,2}/', "<br />
", str_replace('  ', '&nbsp;&nbsp;', htmlspecialchars($string))) . "
</div>
";
}

function debug_dump_r($array, $offset = 0, $length = 0) {
	if (!$length)
		$length = count($array) - $offset;
	$string = var_export(array_slice($array, $offset, $length, true), true);
	$string = preg_replace('/^array/', 'array[' . count($array) . ']', $string);
	//debug_print($string);
	if ($offset > 0) {
		$count = preg_match_all('/  (\d+) => /m', $string, $matches, PREG_OFFSET_CAPTURE);
		for ($i = $count - 1; $i >= 0; $i--) {
			//debug_print($matches[1][$i]);
			$m_s = $matches[1][$i][0];
			$m_i = $matches[1][$i][1];
			//$string = substr_replace($string, $m_s + $offset, $m_i, strlen($m_s));
		}
	}
	return $string;
}

function debug_print($var) {
	print(debug_dump($var));
}

function debug_print_r($array, $offset = 0, $length = 0) {
	debug_print(debug_dump_r($array, $offset, $length));
}

?>
