{include file="header.tpl"}

<!-- main begin -->
	<div id="main-wrap" class="contain">
		<div id="main" role="main" class="contain">
			<article class="entry">
				<div class="entry-title">
					<div id="font-resize"><span>FONT SIZE</span>: [<a href="javascript:exit(0);" id="_font+" class="tooltip" desc="字体放大" title="字体放大">FONT<sup>＋</sup></a>] [<a href="javascript:exit(0);" id="_font0" class="tooltip" desc="字体重置" title="字体重置">RESET</a>] [<a href="javascript:exit(0);" id="_font-" class="tooltip" desc="字体缩小" title="字体缩小">FONT<sup>－</sup></a>]</div>
					<h2>{if $chapter_id ==0}{$volume.title}{else}{$chapter.title_text}{/if}</h2>
				</div>
				<div class="entry-content">
					<div id="toc">
						<div id="tocTitle">目　录</div>
						<div id="tocToc" style="float: left;">
							<ul>
{foreach $volume.chapters as $id => $temp_chapter}
{if $id == 0 && $chapter_id == 0}
								<li>{$volume.title}</li>
{elseif $id == 0}
								<li><a href="{$novel_id}/{$volume_id}/">{$volume.title}</a></li>
{elseif $id == $chapter_id}
								<li><em><span class="sign"><del>■</del></span>　{$temp_chapter.title}</em></li>
{else}
								<li><a href="{$novel_id}/{$volume_id}/{$id}.html"><span class="sign"><del>■</del></span>　{$temp_chapter.title}</a></li>
{/if}
{/foreach}
							</ul>
						</div>
					</div>
					<div id="text" class="contain {if $chapter_id ==0}intro{/if}">
{$chapter.text}
					</div>
					<div id="pagelink-wrapper" class="contain">
						<div id="pagelink">
							<ul>
								{if $chapter_id + 1 < count($volume.chapters)}<li><a href="{$novel_id}/{$volume_id}/{$chapter_id + 1}.html">Next</a></li>{else}<li class="disable">Next</li>{/if}
								<li><a href="{$novel_id}/">Novel</a></li>
								<li id="refresh"><a href="javascript: refresh();">Refresh</a></li>
								{if $chapter_id > 0}<li><a href="{$novel_id}/{$volume_id}/{if $chapter_id > 1}{$chapter_id - 1}.html{/if}">Prev</a></li>{else}<li class="disable">Prev</li>{/if}
								{nocache}{if $SHOW_FORCE_REFRESH}<li id="force-refresh"><a class="tooltip" desc="强制刷新缓存" title="强制刷新缓存" href="javascript: forceRefresh();">Force Refresh</a></li>{/if}{/nocache}
							</ul>
						</div>
						<div id="pagelink-location"></div>
						<script>
							var prevPage = {if $chapter_id > 0}'{$novel_id}/{$volume_id}/{if $chapter_id > 1}{$chapter_id - 1}.html{/if}'{else}''{/if};
							var nextPage = {if $chapter_id + 1 < count($volume.chapters)}'{$novel_id}/{$volume_id}/{$chapter_id + 1}.html'{else}''{/if};
						</script>
					</div>
				</div>
			</article>
		</div>
	</div>
<!-- main finish -->

{include file="footer.tpl"}
