{* $Id: comment-footer.tpl 56845 2015-12-01 10:30:47Z chibaguy $ *}
<div class="postfooter clearfix" style="background-color: #f5f5f5;
  border-top: 1px solid #dddddd;
  border-bottom-right-radius: 3px;
  border-bottom-left-radius: 3px;
  ">
	<div class="status pull-right">
	{if $prefs.feature_contribution eq 'y' and $prefs.feature_contribution_display_in_comment eq 'y'}
		<span class="contributions"
		>{section name=ix loop=$comment.contributions}
			<span class="contribution">{$comment.contributions[ix].name|escape}</span>
		{/section}</span>
	{/if}
	{if $forum_info.vote_threads eq 'y' and ($tiki_p_ratings_view_results eq 'y' or $tiki_p_admin eq 'y')}
		<span class="ratingResultAvg">{tr}Users rating: {/tr}</span>{rating_result_avg type=comment id=$comment.threadId }
	{/if}
	{if $forum_info.vote_threads eq 'y' and $tiki_p_forum_vote eq 'y'}
		<span class="score">
		<b>{tr}Score{/tr}</b>: {$comment.average|string_format:"%.2f"}
		{if $comment.userName ne $user and $comment.approved eq 'y' and $forum_info.vote_threads eq 'y' and ( $tiki_p_forum_vote eq 'y' or $tiki_p_admin_forum eq 'y' )}
		<b>{tr}Vote{/tr}</b>:

		{if $first eq 'y'}
			<form method="post" action="">
				{rating type=comment id=$comment.threadId changemandated=y}
			</form>
		{else}
			{rating type=comment id=$comment.threadId changemandated=y}
		{/if}

		{/if}
		</span>
	{/if}
	{if $forum_info.vote_threads eq 'y' and ($tiki_p_ratings_view_results eq 'y' or $tiki_p_admin eq 'y')}
		{rating_result type=comment id=$comment.threadId }
	{/if}
	</div>
</div>
