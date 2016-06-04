{* $Id: forum_outbound.tpl 58597 2016-05-14 09:03:17Z eromneg $ *}
{$prefs.mail_template_custom_text}{$title}

{tr}Author:{/tr} {$author|username}

{$data}
{if $reply_link}

--
Reply Link: <{$reply_link}>
{/if}
