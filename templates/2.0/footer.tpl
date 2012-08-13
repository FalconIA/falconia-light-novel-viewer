	<footer id="colophon" role="contentinfo">
		<div id="processtime">
{nocache}{if isset($cached) && $cached}
			Cached,
{/if}{/nocache}
			{$smarty.now|date_format:'%Y-%m-%d %H:%M:%S %z'|replace:'Eastern Standard Time':'GMT-0500'|replace:'Eastern Daylight Time':'GMT-0400'|replace:'China Standard Time':'GMT+0800'|regex_replace:'/ (GMT|UTC)$/':'Z'|replace:' GMT':''},
			Processed in {nocache}{processed_time start=$microtime decimals=3}{/nocache}s,
			{$smarty.version|replace:'-':'/'}, PHP/{$smarty.const.PHP_VERSION}
		</div>
		<div class="border"></div>
		<div class="copyright">{$SITE_TITLE} <span>v{$version|regex_replace:'/ ?(Alpha|Beta)$/i':' <span class="version">\1</span>'} <span class="version">Build{$build}</span></span>. Copyright <span class="copysign">©</span> 2005-2012 FalconIA Studio.</div>
	</footer>
</div> <!--! end of #container -->

<!-- jQuery 1.7.1 -->
{nocache}{if $DEV}
<script src="/js/jquery/jquery-1.7.1.min.js"></script>
{else}
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="/js/jquery/jquery-1.7.1.min.js"><\/script>')</script>
{/if}{/nocache}
<!-- jquery.cookie.js (20100108) -->
<script type="text/javascript" src="/js/jquery/jquery.cookie.js"></script>

<!-- common -->
<script src="js/common.js"></script>

<!-- style fix -->
<script src="js/style_fix_2_0.js"></script>
{if $mode === $smarty.const.MODE_INDEX || $mode === $smarty.const.MODE_NOVEL}
<script>$(fixThumbTitleWidth);</script>
{elseif $mode === $smarty.const.MODE_CHAPTER}
<script>$(document).ready(intialFontResize); $(window).ready(setPagelinkPosition); $(window).resize(setPagelinkPosition);</script>
<!-- hotkey -->
<script>$(function() { $(document).keydown(function(e) { jumpPage(e); }); });</script>
<!-- Shadowbox.js 3.0.3 -->
<script src="/js/shadowbox-3.0.3/shadowbox-jquery.js"></script>
<script>Shadowbox.init();</script>

{if $novel.highlight_version == 1}
<!-- overLIB 4.21 -->
<script type="text/javascript" src="/js/overlib421/Mini/overlib_mini.js"><!-- overLIB (c) Erik Bosrup --></script>
<script type="text/javascript">var ol_wrap=1;/*Set for overlib*/</script>
<!-- Dojo 1.7.2 -->
<script src="http://ajax.googleapis.com/ajax/libs/dojo/1.7.2/dojo/dojo.js"></script>
<!-- highlight v1 -->
<script type="text/javascript" src="js/highlight_v1.js"></script>
<script type="text/javascript" src="js/regexpext.js"></script>
<script>
var highlight_xml = '{$novel.highlight_xml}';
if (window.dojo && !isLtIE(8)) {
	dojo.require("dojox.collections.ArrayList");
	dojo.require("dojox.collections.Dictionary");
	dojo.addOnLoad(function() { readHighlight(highlight_xml); });
}
</script>
{elseif $novel.highlight_version == 2}
<!-- jquery.tooltip.js 1.3 (20080824) -->
<script type="text/javascript" src="/js/jquery/jquery.tooltip.mod.min.js"></script>
<!-- highlight v2 -->
<script type="text/javascript" src="js/highlight_v2.js"></script>
{/if}
{elseif $mode === $smarty.const.MODE_CHAPTER_V || $mode === $smarty.const.MODE_PAGE_V}
<!-- hotkey -->
<script>$(function() { $(document).keydown(function(e) { jumpPage(e); }); });</script>
<!-- Shadowbox.js 3.0.3 -->
<script src="/js/shadowbox-3.0.3/shadowbox-jquery.js"></script>
<script>Shadowbox.init();</script>
{/if}
{if !$DEV}

<!-- Asynchronous Google Analytics snippet. -->
{literal}<script>
	var _gaq=[['_setAccount','UA-33956239-1'],['_setDomainName','falconia.org'],['_trackPageview']];
	(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
	g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
	s.parentNode.insertBefore(g,s)}(document,'script'));
</script>{/literal}
{/if}

</body>
</html>