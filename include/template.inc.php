<?php

/**
 * Smarty Template Library
 *
 * @version 1.0.1.20120731
 */

if (!defined('VALID_REQUEST'))	die('Access Denied.'); // Security

if (!defined('CONFIG'))			die('<br />Required Config'		. ' in <b>' . __FILE__ . '</b><br />'); // Config
if (!defined('PATH_ROOT'))		die('<br />Required Root Dir'	. ' in <b>' . __FILE__ . '</b><br />');
if (!defined('PATH_SMARTY'))	die('<br />Required Smarty'		. ' in <b>' . __FILE__ . '</b><br />');

require_once(PATH_ROOT    . 'config.inc.php');
require_once(PATH_INCLUDE . 'global.inc.php');
require_once(PATH_SMARTY  . 'Smarty.class.php');

function initi_smarty() {
	global $smarty, $CNF_THEME;

	$smarty = new Smarty;

	$smarty->template_dir	= PATH_ROOT . 'templates/' . ($CNF_THEME ? $CNF_THEME : 'default/');
	$smarty->compile_dir	= PATH_ROOT . "templates_c";
	$smarty->cache_dir		= PATH_ROOT . "cache";
	$smarty->config_dir		= PATH_ROOT . "configs";

	$smarty->caching		= Smarty::CACHING_LIFETIME_SAVED;

	$smarty->compile_check	= true;
	$smarty->debugging		= false;
}

function get_template($template, $moudle = '') {
	global $smarty;

	if (endsWith($template, '.php') || endsWith($template, '.tpl'))
		$template = substr($template, 0, -4);
	else
		$template = $template;

	if (strlen($moudle) > 0)
		$template = "{$template}_{$moudle}";

	$template = "{$template}.tpl";
	$template_dir = is_array($smarty->template_dir) ? $smarty->template_dir[0] : $smarty->template_dir;
	
	while (!file_exists($template_dir . $template)) {
		if (!$template_original) {
			$template_original = $template;
			$template = "template_not_found.tpl";
		} else {
			die("<br /><b>Template not found</b>: '{$template_original}'<br />");
		}
	}

	return $template;
}

function createTemplate($template, $cache_id) {
	global $smarty, $template_objects;

	$template = get_template($template);
	$template_object = $smarty->createTemplate($template, $cache_id);
	$template_objects[$template][$cache_id] = $template_object;

	return $template_object;
}

function clearCache($template, $cache_id) {
	global $smarty;

	$template = get_template($template);

	return $smarty->clearCache($template, $cache_id);
}

function isCached($template, $cache_id) {
	global $template_objects;

	$template_object = $template_objects[$template][$cache_id] ? $template_objects[$template][$cache_id] :
		createTemplate($template, $cache_id);

	return $template_object->isCached();
}

function display($template, $cache_id, $cache_time = 0, $assigns = array()) {
	global $template_objects, $microtime;

	$template_object = $template_objects[$template][$cache_id] ? $template_objects[$template][$cache_id] :
		createTemplate($template, $cache_id);

	if ($template_object->isCached()) {
		$template_object->assign('microtime', $microtime);
		$template_object->assign('cached', true);
	} else {
		foreach ($GLOBALS as $key => $value) {
			if ($key !== 'smarty' && $key !== 'GLOBALS' && !startsWith($key, '_') && !startsWith($key, 'CNF_') && !startsWith($key, 'HTTP_')) {
				$template_object->assign($key, $value);
			}
		}
	}

	foreach ($assigns as $key => $value) {
		$template_object->assign($key, $value);
	}

	$template_object->setCacheLifetime($cache_time);
	$template_object->display();
}


if (!function_exists('apache_get_version')) {
	function apache_get_version() {
		return 'PHP/' . phpversion();
	}
}

?>
