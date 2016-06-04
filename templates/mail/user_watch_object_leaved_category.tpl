{* $Id: user_watch_object_leaved_category.tpl 58610 2016-05-17 14:28:41Z eromneg $ *}{tr}An object was removed from {$prefs.mail_template_custom_text}category{/tr} {$categoryName}

{tr}Removed by:{/tr} {$author|username}
{tr}Date:{/tr} {$mail_date|tiki_short_datetime:"":"n"}
{tr}Name:{/tr} {$categoryName}
{tr}Path:{/tr} {$categoryPath}
{$mail_machine}/{$categoryId|sefurl:category}

{tr}Object:{/tr} {$objectName}
{tr}Object type:{/tr} {$objectType}
{$mail_machine}/{$objectUrl}
