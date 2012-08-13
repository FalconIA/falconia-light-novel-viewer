	<nav id="menu" role="navigation">
		<div id="menu-inner-wrapper">
			<ul>
{if $novel_id}
				<li><a href=".">HOME</a></li>
{*				<li><span>=></span></li>*}
{else}
				<li><span><em>HOME</em></span></li>
{/if}
{if $volume_id}
				<li><a href="{$novel_id}/">{$novel.title}</a></li>
{*				<li><span>=></span></li>*}
{elseif $novel_id}
				<li><span><em>{$novel.title}</em></span></li>
{/if}
{if $chapter_id}
				<li><a href="{$novel_id}/{$volume_id}/">{$volume.title}</a></li>
				<!--li><span>{$volume.title}</span></li-->
{*				<li><span>=></span></li>*}
				<li><span><em>{$chapter.title}</em></span></li>
{elseif $volume_id}
				<li><span><em>{$volume.title}</em></span></li>
{/if}
			</ul>
{if SHOW_FORCE_REFRESH}
				<ul class="hide-menu">
					<li>
						<a href="javascript:forceRefresh();" title="Force Refresh"><span>[F]</span></a>
					</li>
				</ul>
{/if}
		</div>
	</nav>