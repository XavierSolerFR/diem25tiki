{* $Id: user_watch_category_updated.tpl 58608 2016-05-17 10:44:20Z eromneg $ *}{tr}A {$prefs.mail_template_custom_text}category was updated:{/tr}

{tr}Updated by:{/tr} {$author|username}
{tr}Date:{/tr} {$mail_date|tiki_short_datetime:"":"n"}

{tr}Old:{/tr}
{tr}Name:{/tr} {$oldCategoryName}
{tr}Path:{/tr} {$oldCategoryPath}
{tr}Description:{/tr} {$oldDescription}

{tr}New:{/tr}
{tr}Name:{/tr} {$categoryName}
{tr}Path:{/tr} {$categoryPath}
{tr}Description:{/tr} {$description}

{$mail_machine}/{$categoryId|sefurl:category}
