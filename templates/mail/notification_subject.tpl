{* $Id: notification_subject.tpl 58602 2016-05-16 09:35:24Z eromneg $ *}{if isset($forumId)}{tr}Reply Notification: {/tr} {$prefs.mail_template_custom_text}{$mail_topic}{else}{tr}{$prefs.mail_template_custom_text}Email Notification{/tr}{/if}
