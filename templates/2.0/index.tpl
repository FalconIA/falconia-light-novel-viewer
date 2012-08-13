{include file="header.tpl"}

<!--main begin-->
	<div id="main-wrap" class="contain">
		<div id="main" role="main" class="contain">
{foreach $list as $id => $novel}
			<div class="thumbWrapper" id="{$id}">
				<a href="{$id}/">
					<div class="thumb">
						<div class="thumbImage">{if $novel.thumb}<img src="{$novel.thumb}"{if $novel.thumb_style} style="{$novel.thumb_style}"{/if}>{else}<img src="images/no_cover.gif">{/if}</div>
						<div class="thumbTitle"><span class="_title">{$novel.title}</span> <span class="_subtitle">({$novel.author})</span></div>
						<div class="thumbUpdate">{$novel['mtime']|date_format:"%Y-%m-%d %H:%M:%S%z"|replace:'Eastern Standard Time':'-0500'|replace:'Eastern Daylight Time':'-0400'|replace:'China Standard Time':'+0800'}</div>
					</div>
				</a>
			</div>
{/foreach}
		</div>
	</div>
<!--main finish-->

{include file="footer.tpl"}
