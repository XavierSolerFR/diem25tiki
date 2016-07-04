<article class="article">
{if $hasImage eq 'biniinin'}
	{$headerlib->set_metatags("og:image","{$base_url_canonical}article_image.php?id={$articleId}")}
{/if}
	{if $show_topline eq 'y' and $topline}
		<div class="articletopline">{$topline|escape}</div>
	{/if}
	{if $hasImage eq 'y' && $isfloat eq 'n'}
		{* display own article image *}
		{$imgstyle=''}
		{if $image_y > 0}{$imgstyle=$imgstyle|cat:"max-height:"|cat:$image_y|cat:"px;"}{/if}
		<div style="">
			<img
					alt="{$smarty.capture.imgTitle}"
					src="article_image.php?image_type={if isset($preview) and $imageIsChanged eq 'y'}preview&amp;id={$previewId}{elseif isset($preview) and $subId}submission&amp;id={$subId}{else}article&amp;id={$articleId}{/if}"
					style="padding-bottom:10px;"
					class="img-responsive"
			>
		</div>
	{/if}
	<header class="articletitle">
		<h1 STYLE="display:inline">{object_link type=article id=$articleId title=$arttitle}</h1>
		{if $prefs.art_trailer_pos ne 'between'}{include file='article_trailer.tpl'}{/if}
		{if $show_subtitle eq 'y' and $subtitle}
			<div class="articlesubtitle">{$subtitle|escape}</div>
		{/if}

		<span class="titleb">
			{if $show_author eq 'y' && ($authorName or $author)}{tr}Author:{/tr} {if $authorName}{$authorName|escape}{else}{$author|username}{/if}
				{if $show_pubdate eq 'y' || $show_expdate eq 'y' || $show_reads eq 'y'} - {/if}
			{/if}
			{if $show_pubdate eq 'y' && $publishDate}{$publishDate|tiki_short_datetime:'Published At:'}
				{if $show_expdate eq 'y' || $show_reads eq 'y'} - {/if}
			{/if}
			{if $show_expdate eq 'y' && $expireDate}{tr}Expires At:{/tr} {$expireDate|tiki_short_datetime}
				{if $show_reads eq 'y'} - {/if}
			{/if}
			{if $show_reads eq 'y'}({$reads} {tr}Reads{/tr}){/if}
		</span>
		{if $comment_can_rate_article eq 'y' and $prefs.article_user_rating eq 'y' && ($tiki_p_ratings_view_results eq 'y' or $tiki_p_admin eq 'y')}
			- <span class="ratingResultAvg">{tr}Users rating: {/tr}</span>{rating_result_avg id=$articleId type=article}
		{/if}
	</header>


{*	{if $prefs.art_trailer_pos ne 'between'}{include file='article_trailer.tpl'}{/if} *}

	{if $hasImage eq 'y' && $isfloat eq 'y'}
		{* display own article image *}
		{$imgstyle=''}
		{if $image_y > 0}{$imgstyle=$imgstyle|cat:"max-height:"|cat:$image_y|cat:"px;"}{/if}
		<div style="padding-right:10px;padding-bottom:10px;padding-top:5px;float:left;{$imgstyle}">
		<img
				alt="{$smarty.capture.imgTitle}"
				src="article_image.php?image_type={if isset($preview) and $imageIsChanged eq 'y'}preview&amp;id={$previewId}{elseif isset($preview) and $subId}submission&amp;id={$subId}{else}article&amp;id={$articleId}{if $image_x > 0}&width={$image_x}{/if}{/if}"
				style="{$imgstyle}"
				class="img-responsive"
		>
		</div>
	{/if}
	<div class="articleheading">
			<div class="articleheadingtext">
				{if $article_attributes}
					<div class="articleattributes">
						{foreach from=$article_attributes key=attname item=attvalue}
							{$attname|escape}: {$attvalue|escape}<br>
						{/foreach}
					</div>
				{/if}
				{$parsed_heading}
			</div>
		</div>


	<div class="articlebody clearfix">

		{if $tiki_p_read_article eq 'y'}
			{$parsed_body}
		{else}
			<div class="alert alert-danger">
				{tr}You do not have permission to read complete articles.{/tr}
			</div>
		{/if}

		{if $prefs.article_paginate eq 'y' and $pages > 1}
			<div align="center">
				<a href="{$articleId|sefurl:article:with_next}page={$first_page}" class="tips" title=":{tr}First page{/tr}">
					{icon name="backward_step"}
				</a>

				<a href="{$articleId|sefurl:article:with_next}page={$prev_page}" class="tips" title=":{tr}Previous page{/tr}">
					{icon name='backward'}
				</a>

				<small>{tr}page:{/tr}{$pagenum}/{$pages}</small>

				<a href="{$articleId|sefurl:article:with_next}page={$next_page}" class="tips" title=":{tr}Next page{/tr}">
					{icon name='forward'}
				</a>

				<a href="{$articleId|sefurl:article:with_next}page={$last_page}" class="tips" title=":{tr}Last page{/tr}">
					{icon name='forward_step'}
				</a>
			</div>
		{/if}
	</div>

	{if $show_linkto eq 'y' and $linkto}
		<div class="articlesource">
			{tr}Source:{/tr} <a href="{$linkto|escape}"{if $prefs.popupLinks eq 'y'} target="_blank"{/if}>{$linkto|escape}</a>
		</div>
	{/if}

	{if isset($related_articles)}
		<div class="related_articles">
			<h4>{tr}Related content:{/tr}</h4>
			<ul>
				{foreach from=$related_articles item=related}
					<li>{self_link articleId=$related.articleId}{$related.name}{/self_link}</li>
				{/foreach}
			</ul>
		</div>
	{/if}

	{capture name='copyright_section'}
		{include file='show_copyright.tpl' copyright_context="article"}
	{/capture}

	{* When copyright section is not empty show it *}
	{if $smarty.capture.copyright_section neq ''}
		<footer class="help-block">
			{$smarty.capture.copyright_section}
		</footer>
	{/if}
</article>
{wikiplugin _name="sharethis5x"}{/wikiplugin}