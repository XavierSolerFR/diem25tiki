{* $Id: share.tpl 58604 2016-05-16 11:56:52Z eromneg $ *}{if !empty($comment)}
{$prefs.mail_template_custom_text}{$comment}
{else}
{tr}Look at this {$prefs.mail_template_custom_text}link:{/tr}
{/if}
{$url_for_friend|replace:' ':'+'}
-
{$name|username}
{$email}
