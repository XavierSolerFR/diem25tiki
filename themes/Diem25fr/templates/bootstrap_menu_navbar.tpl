<ul class="nav navbar-nav">
	{foreach from=$list item=item}
		{if $item.children|default:null|count}
			<li class="dropdown{if $item.selected|default:null} active{/if}">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					{if $item.class}
					<i class="fa {$item.class}" aria-hidden="true"></i>&nbsp;
					{/if}
						{tr}{$item.name}{/tr}
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					{foreach from=$item.children item=sub}
						<li class="{if $sub.selected|default:null} active{/if}">
							{if $sub.class}
								<i class="fa {$sub.class}" aria-hidden="true"></i>&nbsp;
							{/if}
							<a href="{$sub.sefurl|escape}">{tr}{$sub.name}{/tr}</a>
						</li>
					{/foreach}
				</ul>
			</li>
		{else}
			<li class="{if $item.selected|default:null} active{/if}"><a href="{$item.sefurl|escape}">
					{if $item.class}
						<i class="fa {$item.class}" aria-hidden="true"></i>&nbsp;
					{/if}{tr}{$item.name}{/tr}</a></li>
		{/if}
	{/foreach}
</ul>
