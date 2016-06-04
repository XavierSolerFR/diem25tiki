{* $Id: user_watch_category_created.tpl 58608 2016-05-17 10:44:20Z eromneg $ *}{tr}A new {$prefs.mail_template_custom_text}category was created in:{/tr} {$parentName}

{tr}Created by:{/tr} {$author|username}
{tr}Date:{/tr} {$mail_date|tiki_short_datetime:"":"n"}
{tr}Name:{/tr} {$categoryName}
{tr}Path:{/tr} {$categoryPath}
{tr}Description:{/tr} {$description}

{$mail_machine}/{$categoryId|sefurl:category}