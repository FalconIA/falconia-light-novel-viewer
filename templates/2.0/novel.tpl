{include file="header.tpl"}

<!--main begin-->
	<div id="main-wrap" class="contain">
		<div id="main" role="main" class="contain">
{foreach $novel['volumes'] as $id => $volume}
			<div class="thumbWrapper{if $volume.is_old} gray{/if}" id="{$novel_id}_{$id}">
				<a href="{$novel_id}/{$id}/">
					<div class="thumb">
						<div class="thumbImage">{if $volume.thumb}<img src="{$volume.thumb}"{if $volume.thumb_style} style="{$volume.thumb_style}"{/if}>{else}<img src="images/no_cover.gif">{/if}</div>
						<div class="thumbTitle">{$volume.title|regex_replace:"/^(.+?)(?: (（.+?）))?$/":"<span class=\"_title\">$1</span> <span class=\"_subtitle\">$2</span>"}</div>
						<div class="thumbUpdate">{$volume['text_mtime']|date_format:"%Y-%m-%d %H:%M:%S%z"|replace:'Eastern Standard Time':'-0500'|replace:'Eastern Daylight Time':'-0400'|replace:'China Standard Time':'+0800'}</div>
					</div>
				</a>
			</div>
{/foreach}
		</div>
	</div>
<!--main finish-->

{include file="footer.tpl"}
