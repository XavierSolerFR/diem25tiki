<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: block.title.php 57997 2016-03-19 08:45:24Z gezzzan $
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 *
 * smarty_block_title : add a title to a template.
 *
 * params:
 *    help: name of the doc page on doc.tiki.org
 *    admpage: admin panel name
 *    url: link on the title
 *
 * usage: {title help='Example' admpage='example'}{tr}Example{/tr}{/title}
 */

//this script may only be included - so its better to die if called directly.
if (strpos($_SERVER["SCRIPT_NAME"], basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

function smarty_block_bread_title($params, $content, $template, &$repeat)
{
	global $prefs, $tiki_p_view_templates, $tiki_p_edit_templates, $tiki_p_admin;

	if ( $repeat || empty($content) ) return;

	$template->loadPlugin('smarty_function_icon');
	$template->loadPlugin('smarty_modifier_sefurl');
	$template->loadPlugin('smarty_modifier_escape');

	if ( ! isset($params['help']) ) $params['help'] = '';
	if ( ! isset($params['admpage']) ) $params['admpage'] = '';
	if ( ! isset($params['actions']) ) $params['actions'] = '';
	if ( ! isset($params['parents']) ) $params['parents'] = '';
	if ( ! isset($params['actionsAdd']) ) $params['actionsAdd'] = '';
	// Set the variable for the HTML title tag
	$template->smarty->assign('headtitle', $content);

	$class = '';
	$current = current_object();

	if ( ! isset($params['url']) ) {
		$params['url'] = smarty_modifier_sefurl($current['object'], $current['type']);
	}

	$metadata = '';
	$coordinates = TikiLib::lib('geo')->get_coordinates($current['type'], $current['object']);
	if ($coordinates) {
		$class = ' geolocated primary';
		$metadata = " data-geo-lat=\"{$coordinates['lat']}\" data-geo-lon=\"{$coordinates['lon']}\"";
		
		if (isset($coordinates['zoom'])) {
			$metadata .= " data-geo-zoom=\"{$coordinates['zoom']}\"";
		}
	}

	$html = '';
	$actions='';
	$breads ="<li><a href='/'>".tra('Home') ."</a></li>";
	$breads .= $params['parents'];
	$breads .= '<li><a class="' . $class . '"' . $metadata . ' href="' . $params['url'] . '"><b>' . smarty_modifier_escape($content) . "</b></a></li>";

	if ($template->getTemplateVars('print_page') != 'y') {
		if ( $prefs['feature_help'] == 'y' && $prefs['helpurl'] != '' && $params['help'] != '' ) {
			$actions .= '<li><a href="'  . $prefs['helpurl'] . rawurlencode($params['help']) . '"  target="tikihelp">' . tra('Help page'). '</a></li>';
		}

		if ($prefs['feature_edit_templates'] == 'y' && $tiki_p_edit_templates == 'y' && ($tpl = $template->getTemplateVars('mid'))) {
			$actions .= '<li><a href="tiki-edit_templates.php?template=' . $tpl . '"  >'.tra('View or edit tpl'). "</a></li>";
		} elseif ($prefs['feature_view_tpl'] == 'y' &&  $tiki_p_view_templates == 'y' && ($tpl = $template->getTemplateVars('mid'))) {
			$actions .= '<li><a href="tiki-edit_templates.php?template='. $tpl . '">' . tra('View tpl'). "</a></li>";
			
		}

		if ( $tiki_p_admin == 'y' && $params['admpage'] != '' ) {
			$actions .= '<li><a href="tiki-admin.php?page=' . $params['admpage'] . '">'  . tra('Settings') ."</a></li>";
		}
		if ($params['actions'] != '') {
		//	$actions .= $params['actions'];
		}
	}
	$actions .=$params['actionsAdd'];

	$html .= '<div class="row">';
	$html .= '<ol id=\'TitleBreadcrumb\' class="breadcrumb col-md-11">'. $breads. '</ol>';
	if ($actions!=""){
	$html .="<div class='btn-group col-md-1 pull-right'>
  <button type='button' class='pull-right btn btn-sm btn-default dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
  <span class=\"icon icon-wrench fa fa-wrench fa-fw \"></span>
  </button>
  <ul id='TitleBreadActions' class='dropdown-menu dropdown-menu-right'>
    ".$actions. "
  </ul>
</div>";
	}
	$html .= '</div>';
	return $html;
}
