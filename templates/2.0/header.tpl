<!DOCTYPE html>
<html class="no-js">

<!-- old-ie notice begin -->
<!--[if lt IE 7]>
<div id="old-ie-notice">
	<p>Your browser is <em>ANCIENT!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">Install Google Chrome Frame</a> to experience this site.<br>
	您的浏览器过于古老！请 <a href="http://browsehappy.com/">升级为其他浏览器</a> 或 <a href="http://www.google.com/chromeframe/?redirect=true">安装Google Chrome 浏览器内嵌框架</a> 以便更好的体验本站点。</p>
</div>
<![endif]-->
<!-- old-ie notice finish -->

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
{if $url_base}
	<base href="{nocache}{$url_base}{/nocache}">
{/if}

	<title>{if isset($key) && $key}搜索 {$key} - {/if}{if $chapter.title}{$chapter.title} - {/if}{if $volume.title}{$volume.title} - {/if}{if $novel.title}{$novel.title} - {/if}{$SITE_TITLE}</title>
	<meta name="description" content="{$SITE_DESC}">
	<meta name="author" content="FalconIA">
	<meta name="keywords" content="light novel,轻小说{if $novel.title},{$novel.title}{/if}{if $novel.author},{$novel.author}{/if}{if $volume.title},{$volume.title}{/if}{if $chapter.title},{$chapter.title}{/if}">

	<meta name="viewport" content="width=device-width">

	<link rel="stylesheet" href="{$BASE_CSS}">
	<link rel="stylesheet" href="images/{$THEME}/novel.css">
{if $mode === $smarty.const.MODE_CHAPTER || $mode === $smarty.const.MODE_CHAPTER_V || $mode === $smarty.const.MODE_PAGE_V}
	<!-- Shadowbox.js 3.0.3 -->
	<link rel="stylesheet" href="/js/shadowbox-3.0.3/shadowbox.css">
{/if}
{if $novel.highlight_version == 1}
	<!-- highlight v1 -->
	<link rel="stylesheet" href="images/{$THEME}/highlight_v1.css">
{elseif $novel.highlight_version == 2}
	<!-- highlight v2 -->
	<link rel="stylesheet" href="images/{$THEME}/highlight_v2.css">
{/if}

	<script src="/js/libs/modernizr-2.5.3.min.js"></script>
</head>
<body class="global">

{nocache}{if $DEBUG}
<div id="DEBUG">
<div class="debug-bg"></div>
<div class="debug-front">
	<div class="debug-title">DEBUG</div>
	<div class="debug-text">{$DEBUG}</div>
</div>
</div>

{/if}{/nocache}
{if $mode === $smarty.const.MODE_CHAPTER && $novel.highlight_version == 1}
<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>

{/if}
<div id="container">
	<header id="header" role="banner">
		<h1 id="site-title"><a href=".">{$SITE_TITLE}</a></h1>
		<h2 id="site-description">{$SITE_DESC} - Theme {$THEME} - Base Style v{$BASE_CSS|regex_replace:'{^/css/([^/]+)/.+$}':'\1'} @ <a href="/">FalconIA's BASE</a></h2>
	</header>
{include file="menu.tpl"}

<!-- dev notice begin -->
{capture name='url_redirect' assign='url_redirect'}{$script_uri|regex_replace:'/(?<=http:\/\/)[^\/]+(?=\/)/':'falconia.org'}{/capture}
	<div id="dev-notice"{nocache}{if !$DEV} style="display: none;"{/if}{/nocache}>
		<em>THIS IS A DEVELOPMENT SITE. PLEASE REDIRECT TO '<a href="{$url_redirect}" desc="{$url_redirect}">FALCONIA.ORG</a>'.<br>
		此站点为开发用。请跳转至「<a href="{$url_redirect}" desc="{$url_redirect}">FALCONIA.ORG</a>」。</em>
{if $volume_id}
		<del>TODO: Update the highlighting methods. [@version = {$novel.highlight_version}, {if $novel.highlight_version == 2}@file = {$novel.highlight_file_short}{else}@xml = {$novel.highlight_xml}{/if}]</del>
{/if}
	</div>
<!-- dev notice finish -->