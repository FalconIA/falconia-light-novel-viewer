<?PHP

if (!defined('VALID_REQUEST'))	die('Access Denied.'); // Security


$CNF_SITE_TITLE = "FalconIA's Light Novel Viewer";
$CNF_SITE_DESC  = "FalconIA轻小说在线";

$CNF_BASE_URL   = strtr(str_replace(dirname(ROOT), '', ROOT), '\\', '/');
$CNF_BASE_CSS   = '/css/2.3.0.2/style.css';
$CNF_THEME      = '2.0';

$CNF_CACHE_TIME          = 3600;//0;//
$CNF_CACHE_TIME_CHAPTER  = 3600 * 24 * 30;//0;//

$CNF_MAX_WORDS_IN_LINE = 42.5;
$CNF_MAX_LINES_IN_PAGE = 16;

$CNF_DEV = !preg_match('/falconia\.org$/', $_SERVER['HTTP_HOST']);
$CNF_SHOW_FORCE_REFRESH  = $CNF_DEV;//false;//true;//

$CNF_FILE_LIST             = PATH_ROOT . 'data/list.xml';
$CNF_PATH_LIST             = PATH_ROOT . 'data/list/';
$CNF_PATH_TEXT             = PATH_ROOT . 'data/text/';
$CNF_PATH_COVER            =             'data/cover/';
$CNF_PATH_PIC              =             'data/illustration/';
$CNF_PATH_HIGHLIGHT_XML    =             'data/highlight/';
$CNF_PATH_HIGHLIGHT_THUMB  =             'data/highlight/images/';
$CNF_PATH_HIGHLIGHT_PHP    = PATH_ROOT . 'highlight/';
$CNF_PATH_CACHE_MTIME      = PATH_ROOT . 'cache_mtime/';
$CNF_PATH_CACHE_PAGES      = PATH_ROOT . 'cache_pages/';
$CNF_PATH_PIC_THUMB        =             'thumb_900x650';

$CNF_SMARTY_VERSION = '3.1.11';

mb_internal_encoding('UTF-8');


// const
define('MODE_INDEX',     'MODE_INDEX');
define('MODE_NOVEL',     'MODE_NOVEL');
define('MODE_CHAPTER',   'MODE_CHAPTER');
define('MODE_CHAPTER_V', 'MODE_CHAPTER_V');
define('MODE_PAGE_V',    'MODE_PAGE_V');
define('MODE_INVALID',   'MODE_INVALID');


// define
define('PATH_INCLUDE',   PATH_ROOT . "include/");
define('PATH_HIGHLIGHT', $CNF_PATH_HIGHLIGHT_PHP);
define('PATH_SMARTY',    dirname(PATH_ROOT) . "/Smarty-{$CNF_SMARTY_VERSION}/libs/");

define('CONFIG', true);

?>
