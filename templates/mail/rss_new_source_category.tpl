{* $Id: rss_new_source_category.tpl 58603 2016-05-16 11:16:41Z eromneg $ *}
{tr}A new {$prefs.mail_template_custom_text}source category was detected by the RSS article creator at{/tr} {$mail_date|tiki_short_datetime:"":"n"}

{tr}Feed:{/tr} {$title|escape}

{tr}New categories:{/tr}
{foreach $newcats as $cat}
{$cat|escape}
{/foreach}

{tr}Configure settings for the new category at:{/tr} {$mail_machine_raw}/tiki-admin_rssmodules.php?article={$rssId|escape}

