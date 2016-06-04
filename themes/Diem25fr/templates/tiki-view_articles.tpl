{block name="bread_title"}
{if !isset($topic)}
	{bread_title help='' parents=''	admpage="" actionsAdd="" }{tr}Articles{/tr}{/bread_title}
{else}
	{capture name="parentArticle"}
		<li><a class="link" href="{if $prefs.feature_sefurl eq 'y'}articles{else}tiki-view_articles.php{/if}">{tr}Articles{/tr}</a></li>
	{/capture}
	{bread_title help='' parents=$smarty.capture.parentArticle	admpage="" actionsAdd="" }{$topic}{/bread_title}
{/if}
{/block}
{if !isset($useLinktoURL)}{$useLinktoURL='n'}{/if}
<div class="row">
<div class="col-md-12" id="listarticles">
{section name=ix loop=$listpages}
	{if $listpages[ix].disp_article eq 'y'}
		{capture name=href}{strip}
			{if empty($urlparam)}
				{if $useLinktoURL eq 'n' or empty($listpages[ix].linkto)}
					{$listpages[ix].articleId|sefurl:article}
				{else}
					{$listpages[ix].linkto}
				{/if}
			{else}
				{$listpages[ix].articleId|sefurl:article:with_next}{$urlparam}
			{/if}
		{/strip}{/capture}
		<article class="clearfix article col-sm-6 col-md-4 article{$smarty.section.ix.index}">
			<div class="thumbnail">
			{if $listpages[ix].hasImage eq 'y'}
			<div class="articleimage" style="background-image: url(article_image.php?image_type=article&amp;id={$listpages[ix].articleId}) !important;"></div>
			{/if}
				<div class="caption">
					{if $listpages[ix].show_topline eq 'y' and $listpages[ix].topline}
					<div class="articletopline" style="height:58px;overflow:scroll">{$listpages[ix].topline|escape}</div>
					{/if}
					<h4 style="height:58px;overflow:scroll">
					{object_link type='article' id=$listpages[ix].articleId url=$smarty.capture.href title=$listpages[ix].title}
					</h4>

					{if isset($fullbody) and $fullbody eq "y"}
						<div class="articlebody" style="height:200px;overflow:scroll">{$listpages[ix].parsed_body}</div>
					{else}
						<div class="articleheadingtext" style="height:200px;overflow:scroll">{$listpages[ix].parsed_heading}</div>
					{/if}
<p></p>

				{if ($listpages[ix].size > 0) or (($prefs.feature_article_comments eq 'y') and ($tiki_p_read_comments eq 'y'))}
					<div class="btn-group actions">
					{if ($tiki_p_read_article eq 'y' and $listpages[ix].heading_only ne 'y' and (!isset($fullbody) or $fullbody ne "y"))}
						{if ($listpages[ix].size > 0 and !empty($listpages[ix].body))}
								<a class="btn btn-primary" href="{$smarty.capture.href}" class="more">{tr}Read More{/tr}
							{if ($listpages[ix].show_size eq 'y')}
								({$listpages[ix].size} {tr}bytes{/tr})
								{/if}
								</a>
						{/if}
					{/if}
					{if ($prefs.feature_article_comments eq 'y') and ($tiki_p_read_comments eq 'y') and ($listpages[ix].allow_comments eq 'y')}

							<a href="{$listpages[ix].articleId|sefurl:article:with_next}{if $prefs.feature_sefurl neq 'y'}&amp;{/if}show_comzone=y{if !empty($urlparam)}&amp;{$urlparam}{/if}#comments"{if $listpages[ix].comments_cant > 0} class="highlight"{/if}>
								{if $listpages[ix].comments_cant == 0 and $tiki_p_post_comments == 'y'}
									{if !isset($actions) or $actions eq "y"}
										{tr}Add Comment{/tr}
									{/if}
								{elseif $tiki_p_read_comments eq 'y'}
									{if $listpages[ix].comments_cant == 1}
										{tr}1 comment{/tr}
									{else}
										{$listpages[ix].comments_cant}&nbsp;{tr}comments{/tr}
									{/if}
								{/if}
							</a>

					{/if}

					</div>
				{/if}
				{if !isset($actions) or $actions eq "y"}
					<div class="btn-group actions pull-right dropup">
						{if $prefs.feature_multilingual eq 'y' and $tiki_p_edit_article eq 'y'}
							{include file='translated-lang.tpl' object_type='article' trads=$listpages[ix].translations articleId=$listpages[ix].articleId}
						{/if}
						<a class="btn btn-link" data-toggle="dropdown" data-hover="dropdown" href="#">
							{icon name="wrench"}
						</a>
						<ul class="dropdown-menu dropdown-menu-right">
							<li class="dropdown-title">
								{tr _0="{$listpages[ix].title}"}Actions for %0{/tr}
							</li>
							<li class="divider"></li>
							{if $tiki_p_edit_article eq 'y' or (!empty($user) and $listpages[ix].author eq $user
							and $listpages[ix].creator_edit eq 'y')}
								<li>
									<a href="tiki-edit_article.php?articleId={$listpages[ix].articleId}">
										{icon name='edit'} {tr}Edit{/tr}
									</a>
								</li>
							{/if}
							{if $prefs.feature_cms_print eq 'y'}
								<li>
									<a href="tiki-print_article.php?articleId={$listpages[ix].articleId}">
										{icon name='print'} {tr}Print{/tr}
									</a>
								</li>
							{/if}
							{if $tiki_p_remove_article eq 'y'}
								<li>
									<a href="tiki-list_articles.php?remove={$listpages[ix].articleId}">
										{icon name='remove'} {tr}Remove{/tr}
									</a>
								</li>
							{/if}
						</ul>
					</div>
				{/if}

			{if $prefs.feature_freetags eq 'y' and $tiki_p_view_freetags eq 'y' and $listpages[ix].freetags.data|@count >0}
				<div class="freetaglist">
					{foreach from=$listpages[ix].freetags.data item=taginfo}
						{capture name=tagurl}
							{if (strstr($taginfo.tag, ' '))}"{$taginfo.tag}"{else}{$taginfo.tag}{/if}
						{/capture}
						<a class="freetag" href="tiki-browse_freetags.php?tag={$smarty.capture.tagurl|escape:'url'}">
							{$taginfo.tag}
						</a>
					{/foreach}
				</div>
			{/if}
				</div>
			</div>
		</article>
	{/if}
{sectionelse}
	{if $quiet ne 'y'}
		{remarksbox type=info title="{tr}No articles yet.{/tr}" close="n"}
		{/remarksbox}
	{/if}
{/section}
</div>
</div>
{if $headerLinks eq "y"}
	<div class="t_navbar margin-bottom-md">
		{if $tiki_p_edit_article eq 'y' or $tiki_p_admin eq 'y' or $tiki_p_admin_cms eq 'y'}
			{button href="tiki-edit_article.php"  _xtype="link" class="btn btn-primary" _icon_name="create" _text="{tr}New Article{/tr}"}
		{/if}
		{if $prefs.feature_submissions == 'y' && $tiki_p_edit_submission == "y" && $tiki_p_edit_article neq 'y' && $tiki_p_admin neq 'y' && $tiki_p_admin_cms neq 'y'}
			{button href="tiki-edit_submission.php"  _xtype="link" class="btn btn-primary" _icon_name="create" _text="{tr}New Submission{/tr}"}
		{/if}
		{if $tiki_p_read_article eq 'y' or $tiki_p_articles_read_heading eq 'y' or $tiki_p_admin eq 'y' or $tiki_p_admin_cms eq 'y'}
			{button href="tiki-list_articles.php" _xtype="link" class="btn btn-primary" _icon_name="list" _text="{tr}List Articles{/tr}"}
		{/if}

		{if $prefs.feature_submissions == 'y' && ($tiki_p_approve_submission == "y"
		|| $tiki_p_remove_submission == "y" || $tiki_p_edit_submission == "y")}
			{button href="tiki-list_submissions.php"  _xtype="link" class="btn btn-link" _icon_name="view" _text="{tr}View Submissions{/tr}"}
		{/if}
		{if $prefs.javascript_enabled != 'y'}
			{$js = 'n'}
		{else}
			{$js = 'y'}
		{/if}
		<div class="btn-group pull-right">
			{if $js == 'n'}<ul class="cssmenu_horiz"><li>{/if}
					<a class="btn btn-link" data-toggle="dropdown" data-hover="dropdown" href="#">
						{icon name='menu-extra'}
					</a>
					<ul class="dropdown-menu dropdown-menu-right">
						<li class="dropdown-title">
							{tr}Monitoring{/tr}
						</li>
						<li class="divider"></li>
						<li>
							{if $user_watching_articles eq 'n'}
								{self_link watch_event='article_*' watch_object='*' watch_action='add' _icon_name='watch' _text="{tr}Monitor articles{/tr}"}
								{/self_link}
							{else}
								{self_link watch_event='article_*' watch_object='*' watch_action='remove' _icon_name='stop-watching' _text="{tr}Stop monitoring articles{/tr}"}
								{/self_link}
							{/if}
						</li>
						<li>
							{if $prefs.feature_group_watches eq 'y' and $tiki_p_admin_users eq 'y'}
								<a href="tiki-object_watches.php?watch_event=article_*&amp;objectId=*">
									{icon name='watch-group'} {tr}Group monitor{/tr}
								</a>
							{/if}
						</li>
					</ul>
					{if $js == 'n'}</li></ul>{/if}
		</div>
	</div>
{/if}


{if !empty($listpages) && (!isset($usePagination) or $usePagination ne 'n')}
	{pagination_links cant=$cant step=$maxArticles offset=$offset}{if isset($urlnext)}{$urlnext}{/if}{/pagination_links}
{/if}
<!-- Go to www.addthis.com/dashboard to customize your tools
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5741db3b6ed60807"></script>
-->