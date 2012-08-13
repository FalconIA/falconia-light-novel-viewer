{include file="header.tpl"}

<!-- main begin -->
	<div id="main-wrap" class="contain">
		<div id="main" role="main" class="contain">
			<article class="entry">
				<div class="entry-title">
					<h2>{if $chapter.title_text}{$chapter.title_text}{elseif $chapter.title}{$chapter.title}{else}{$volume.title}{/if}</h2>
				</div>
				<div class="entry-content">
					<div id="page-link-vert">
						<div id="page"></div>
						<span class="return"><a href="{$novel_id}/{$volume_id}/v/#page">回目录</a></span>
						<span class="prevPage"><a href="{$novel_id}/{$volume_id}/v/{if $pages[0].prev2_id >= 0}{$pages[0].prev2_id_fix}.html{/if}#page">上一页</a></span>
						{if $pages[1] && $pages[1].next_id}<span class="nextPage"><a href="{$novel_id}/{$volume_id}/v/{$pages[1].next_id_fix}.html#page">下一页</a></span>{else}<span class="nextPage disable">下一页</span>{/if}
					</div>
{if $pages[0].is_two_page}
					<div id="text-page-1" class="text-vert isTwoPage">
{$pages[0].text}
					</div>
{else}
					<div id="text-page-1" class="text-vert">
{$pages[0].text}
					</div>
{if $pages[1]}
					<div id="text-page-2" class="text-vert">
{$pages[1].text}
					</div>
{/if}
{/if}
					<div id="page-number-vert">
						<span class="page1">{math equation="max(x-y,0)" x=$pages[0].id y=$volume.vert_page_fix}</span>
{if $pages[1]}
						<span class="page2">{if $pages[1]}{math equation="max(x-y,0)" x=$pages[1].id y=$volume.vert_page_fix}{/if}</span>
{/if}
					</div>
				</div>
			</article>
		</div>
	</div>
<!-- main finish -->

<script>
	var prevPage = '{$novel_id}/{$volume_id}/v/{if $pages[0].prev2_id >= 0}{$pages[0].prev2_id_fix}.html{/if}#page';
	var nextPage = {if $pages[1] && $pages[1].next_id}'{$novel_id}/{$volume_id}/v/{$pages[1].next_id_fix}.html#page'{else}''{/if};
</script>

{include file="footer.tpl"}
