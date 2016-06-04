{* $Id: list.tpl 58572 2016-05-10 11:59:59Z jonnybradley $ *}
{extends 'layout_view.tpl'}

{block name="title"}
	{title}{$title|escape}{/title}
{/block}

{block name="content"}
<div class="kaltura-media-list">
	{foreach $entries as $item}
		<div class="media" data-id="{$item->id}">
			<div class="media-left">
				<img class="athumb media-object" src="{$item->thumbnailUrl}" alt="{$item->description}" height="80" width="120">
			</div>
			<div class="media-body">
				<h4 class="media-heading">{$item->name}</h4>
			</div>
		</div>
	{/foreach}
</div>

{jq}
$(".media", ".kaltura-media-list").click(function () {
	var hidden = $('<input type="hidden">')
		.attr('name', '{{$targetName}}')
		.attr('value', $(this).data('id'))
		;
	$('#{{$formId}}').append(hidden);
	$(this).parents(".ui-dialog-content").data("ui-dialog").close();
}).css("cursor", "pointer");
{/jq}
{/block}
