<?php

define('VALID_REQUEST', true);

define('PATH_ROOT', strtr(dirname(__FILE__), '\\', '/') . "/");

// Set php.ini
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 1);
ini_set('memory_limit', '128M');
ini_set('pcre.backtrack_limit', 10000000);

// Set header charset
header('Content-type: text/html; charset=utf-8');


// Process started
$microtime = microtime(true);


require_once(PATH_ROOT . 'config.inc.php');

require_once(PATH_INCLUDE . 'template.inc.php');


$_url = ($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] : $_ENV['PHP_SELF'];
$url_base_path = preg_replace('/[^\/]+$/', '', $_url);

$_protocol = (($_SERVER['HTTPS']) ? $_SERVER['HTTPS'] : $_ENV['HTTPS']) ? "https:" : "http:";
$_host = ($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : $_ENV['HTTP_HOST'];
$url_base = "{$_protocol}//{$_host}{$url_base_path}";

$script_uri = $_SERVER['SCRIPT_URI'] ? $_SERVER['SCRIPT_URI'] : "{$_protocol}//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

$version = '3.0 Beta';
$build = date('Ymd', filemtime(__file__));


// Get whether force to refresh page
$force_refresh = false;
if (array_key_exists('force', $_GET) && $_GET['force']
	|| (array_key_exists('force_refresh', $_COOKIE) && $_COOKIE['force_refresh'])) {
	$force_refresh = true;
	setcookie('force_refresh', NULL, 0, $url_base_path, $_host);
}


// Get id
$novel_id       = $_GET['novelid'];
$volume_id      = $_GET['volumeid'];
$chapter_id     = $_GET['chapterid'];
$text_vert_mode = $_GET['textmode'] === 'v';
$page_id        = $_GET['pageid'];

$_cache_id  = '';//($novel_id ? $novel_id : '_index') . ($volume_id ? '_' . $volume_id : '') . ($chapter_id ? '_' . sprintf("%02d", $chapter_id) : '');


// Get fetch mode
$mode = MODE_INDEX;
$_cache_id = '_index';
if ($novel_id) {
	$mode = MODE_NOVEL;
	$_cache_id = $novel_id;

	if ($volume_id) {
		$mode = MODE_CHAPTER;
		$_cache_id .= '_' . $volume_id . ($chapter_id ? '_' . sprintf("%02d", $chapter_id) : '');

		if ($text_vert_mode) {
			$mode = MODE_CHAPTER_V;
			$_cache_id .= '_vert';

			if (preg_match('/^(0),([0-9]+)|([1-9][0-9]*)$/', $page_id, $matches)) {
				$mode = MODE_PAGE_V;
				if ($matches[3])
					$_cache_id .= '_' . sprintf("%03d", $matches[3]);
				else
					$_cache_id .= '_000' . sprintf("%03d", $matches[2]);
			}
		}
	}
}


// Get template name
switch ($mode) {
	case MODE_INDEX:
		$_template = 'index';
		break;
	case MODE_NOVEL:
		$_template = 'novel';
		break;
	case MODE_CHAPTER:
		$_template = 'chapter';
		break;
	case MODE_CHAPTER_V:
		$_template = 'chapter_v';
		break;
	case MODE_PAGE_V:
		$_template = 'page_v';
		break;
}


// Initilize smarty
initi_smarty();

$_assigns = array();

$_assigns['SITE_TITLE'] = $CNF_SITE_TITLE;
$_assigns['SITE_DESC']  = $CNF_SITE_DESC;
$_assigns['BASE_URL']   = $CNF_BASE_URL;
$_assigns['BASE_CSS']   = $CNF_BASE_CSS;
$_assigns['THEME']      = $CNF_THEME;

$_assigns['DEV'] = $CNF_DEV;
$_assigns['SHOW_FORCE_REFRESH'] = $CNF_SHOW_FORCE_REFRESH;


// Check data files are modified
$_data_mtime_file = "{$CNF_PATH_CACHE_MTIME}{$_cache_id}.json";
if (!$force_refresh) {
	if (file_exists($_data_mtime_file)) {
		$_data_mtime  = json_decode(file_get_contents($_data_mtime_file), true);
		$auto_refresh = check_data_mtime($_data_mtime);
	} else {
		$auto_refresh = true;
	}
}


// Check whether page is cached
if ($force_refresh || $auto_refresh) {
	clearCache($_template, $_cache_id);
}
elseif ($_template && $_cache_id && isCached($_template, $_cache_id)) {
	$_assigns['url_base'] = $url_base;
	display($_template, $_cache_id, 0, $_assigns);
	exit();
}


// Read list
require_once(PATH_INCLUDE . 'novel.inc.php');
$list = parse_novel_list($CNF_FILE_LIST);
//$DEBUG = '<pre>' . var_export($list, true) . '</pre>';


// Fetch page
if ($novel_id) {
	$novel = get_novel($list, $novel_id);
	//$DEBUG = '<pre>' . var_export($novel, true) . '</pre>';

	if ($volume_id) {
		$volume = get_volume($novel, $volume_id);
		//$DEBUG = '<pre>' . var_export($volume, true) . '</pre>';//exit($DEBUG);

		if (!$text_vert_mode) {
			$chapter_id = $chapter_id ? $chapter_id : 0;

			if (!$volume || $chapter_id >= count($volume['chapters'])) {
				//header("Location: {$url_base}{$novel_id}/{$volume_id}/");
				header('HTTP/1.0 404 Not Found');
				display_errordoc(404);
				exit();
			}

			$chapter = get_chapter($volume, $chapter_id);
		
			process_chapter_text($novel, $volume, $chapter);
			//$DEBUG = '<pre>' . var_export($chapter, true) . '</pre>';//exit($DEBUG);
		}
		// Vertical text mode
		else {
			// Check whether pages is cached
			$refresh_pages = false;
			$_pages_mtime_file = "{$CNF_PATH_CACHE_MTIME}{$_cache_id}_pages.json";
			if ($force_refresh || !file_exists($_pages_mtime_file)) {
				$refresh_pages = true;
			}
			else {
				$_pages_mtime = json_decode(file_get_contents($_pages_mtime_file), true);
				$refresh_pages = check_data_mtime($_pages_mtime);
			}

			// Regenerate pages
			if ($refresh_pages) {
				$_pages = get_pages_v($volume, $chapter);
				file_put_contents($volume['pages_file'], json_encode($_pages));
				// Store pages file mtime
				$_pages_mtime = get_data_mtime($novel, $volume);
				file_put_contents($_pages_mtime_file, json_encode($_pages_mtime));
				//$DEBUG = '<pre>Refresh Pages</pre>';
			}
			// Read pages from cache
			else {
				$_pages = json_decode(file_get_contents($volume['pages_file']), true);
			}

			$volume['chapters'] = $_pages['chapters'];

			if (preg_match('/^(0),([0-9]+)|([1-9][0-9]*)$/', $page_id, $matches)) {
				if ($matches[3])
					$page_id = $matches[3] + $_pages['page_fix'];
				else
					$page_id = $matches[2];

				if ($matches[2] > $_pages['page_fix'] || $page_id > $_pages['page_max']) {
					header('HTTP/1.0 404 Not Found');
					display_errordoc(404);
					exit();
				}

				$chapters = $_pages['chapters'];

				$chapter_id = 0;
				for ($i = 0; $i < count($chapters); $i++) {
					if ($page_id >= $chapters[$i]['page_start'] && $page_id <= $chapters[$i]['page_end']) {
						$chapter_id = $i;
						break;
					}
				}
				$chapter = $chapters[$chapter_id];

				$pages = get_two_pages_v($_pages, $page_id);
				//$DEBUG = '<pre>' . var_export($pages, true) . '</pre>';//exit($DEBUG);
			}




			//$DEBUG = '<pre>' . var_export($volume['chapters'], true) . '</pre>';exit($DEBUG);
			//$DEBUG = '<pre>' . var_export($chapter, true) . '</pre>';//exit($DEBUG);
			//$DEBUG = '<pre>' . var_export($_pages, true) . '</pre>';//exit($DEBUG);
		}
	}
}


// Store data files mtime
$_data_mtime = get_data_mtime($novel, $volume);
//$DEBUG = $_data_mtime_file . '<pre>' . var_export($_data_mtime, true) . '</pre>';//exit($DEBUG);
file_put_contents($_data_mtime_file, json_encode($_data_mtime));


// Display
$_cache_time = ($mode === MODE_CHAPTER) ? $CNF_CACHE_TIME_CHAPTER : $CNF_CACHE_TIME;

display($_template, $_cache_id, $_cache_time, $_assigns);
exit();


function display_errordoc($code) {
	if (file_exists(dirname(PATH_ROOT) . "/errordocs/{$code}.html"))
		include(dirname(PATH_ROOT) . "/errordocs/{$code}.html");
}

function get_data_mtime($novel = null, $volume = null) {
	global $mode, $CNF_FILE_LIST;

	$data = array();

	switch ($mode) {
		case MODE_INDEX:
		case MODE_NOVEL:
			$data['list_file']       = $CNF_FILE_LIST;
			$data['list_mtime']      = filemtime($data['list_file']);
			break;
		case MODE_CHAPTER_V:
		case MODE_PAGE_V:
			$data['pages_file']       = $volume['pages_file'];
			$data['pages_mtime']      = file_exists($data['pages_file']) ? filemtime($data['pages_file']) : 0;
		case MODE_CHAPTER:
			$data['highlight_file']  = $novel['highlight_version'] == 2 ? $novel['highlight_file'] : false;
			$data['highlight_mtime'] = $data['highlight_file'] ? filemtime($data['highlight_file']) : false;
			$data['text_file']       = $volume['text_file'];
			$data['text_mtime']      = filemtime($data['text_file']);
			$data['list_file']       = $volume['list_file'];
			$data['list_mtime']      = filemtime($data['list_file']);
			$data['high_base_file']  = PATH_HIGHLIGHT . 'base.highlight.php';
			$data['high_base_mtime'] = filemtime($data['high_base_file']);
			break;
	}

	return $data;
}

function check_data_mtime($data) {
	global $mode;

	switch ($mode) {
		case MODE_INDEX:
		case MODE_NOVEL:;
			if (filemtime($data['list_file'])      !== $data['list_mtime'])
				return true;
			break;
		case MODE_CHAPTER_V:
		case MODE_PAGE_V:
			if (!file_exists($data['pages_file']) || filemtime($data['pages_file']) !== $data['pages_mtime'])
				return true;
		case MODE_CHAPTER:
			if ($data['highlight_file'] && filemtime($data['highlight_file']) !== $data['highlight_mtime'])
				return true;
			if (filemtime($data['text_file'])      !== $data['text_mtime'])
				return true;
			if (filemtime($data['list_file'])      !== $data['list_mtime'])
				return true;
			if (filemtime($data['high_base_file']) !== $data['high_base_mtime'])
				return true;
			break;
	}

}

?>
