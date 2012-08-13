{include file="header.tpl"}

<!-- main begin -->
	<div id="main-wrap" class="contain">
		<div id="main" role="main" class="contain">
			<article class="entry">
				<div class="entry-title">
					<h2>{$volume.title}</h2>
				</div>
				<div class="entry-content">
					<div id="page-link-vert">
						<div id="page"></div>
						<span class="nextPage"><a href="{$novel_id}/{$volume_id}/v/0,0.html#page">下一页</a></span>
					</div>
					<div id="toc-vert" class="text-vert">
{foreach $volume.chapters as $id => $temp_chapter}
{if $id == 0}
						<p>P.{$temp_chapter.page_start_fix|string_format:"%03d"}　<a href="{$novel_id}/{$volume_id}/v/{$temp_chapter.page_start_fix}.html#page">{$volume.title}</a></p>
{else}
						<p>P.{$temp_chapter.page_start_fix|string_format:"%03d"}　<a href="{$novel_id}/{$volume_id}/v/{$temp_chapter.page_start_fix}.html#page">{$temp_chapter.title_text}</a></p>
{/if}
{/foreach}
					</div>
					<div id="page-number-vert">
						&nbsp;
					</div>
				</div>
			</article>
		</div>
	</div
<!-- main finish -->

<script>
	var prevPage = '';
	var nextPage = '{$novel_id}/{$volume_id}/v/0,0.html#page';
</script>

{include file="footer.tpl"}
