{* $Id: user_welcome_msg.tpl 58611 2016-05-17 14:35:45Z eromneg $ *}{if $prefs.login_autogenerate eq 'y'}
	<strong>Your {$prefs.mail_template_custom_text}account ID {$username} has been generated.</strong>
{/if}
{tr}Thank you for your {$prefs.mail_template_custom_text}registration.{/tr} <a href="tiki-login_scr.php?clearmenucache=y">{tr}You may log in now.{/tr}</a>
