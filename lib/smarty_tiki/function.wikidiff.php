<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: function.wikidiff.php 59608 2016-09-06 16:01:59Z jonnybradley $


// this script may only be included - so its better to die if called directly.
if (strpos($_SERVER['SCRIPT_NAME'], basename(__FILE__)) !== false) {
  header('location: index.php');
  exit;
}

/**
 * To display with difference between two blocks of text, often wiki syntax or html
 *
 * @param array $params
 * @param Smarty $smarty
 * @return string html
 */

function smarty_function_wikidiff($params, $smarty)
{
	$defaults = [
		'object_id' => '',					// int | string (for wiki page)
		'object_type' => 'wiki page',		// string object type, wiki page if empty
		'oldver' => '',						// int|string   required version or date string (uses strtotime)
		'newver' => '',						// int|string   version or date string, latest if empty  (uses strtotime)
		'diff_style' => '',					// string       one of the options for default_wiki_diff_style pref
	];

	$params = array_merge($defaults, $params);

	if (! $params['object_id']) {
		return '<span class="text-danger">' . tra('wikidiff: error - only wiki pages supported currently') . '</span>';
	}

	if (! $params['oldver']) {
		return '<span class="text-danger">' . tra('wikidiff: error - no old version specified') . '</span>';
	}

	if ($params['object_type'] === 'wiki page') {
		$html = '';

		$smarty = TikiLib::lib('smarty');
		$histlib = TikiLib::lib('hist');

		if (! is_numeric($params['oldver'])) {
			$time = strtotime($params['oldver']);
			$oldver = $histlib->get_version_by_time($params['object_id'], $time);
		} else {
			$oldver = $params['oldver'];
		}

		if (! is_numeric($params['newver']) && ! empty($params['newver'])) {
			$time = strtotime($params['newver']);
			$newver = $histlib->get_version_by_time($params['object_id'], $time);
		} else {
			$newver = $params['newver'];
		}

		histlib_helper_setup_diff($params['object_id'], $oldver, $newver, $params['diff_style']);

		$html = $smarty->fetch('pagehistory.tpl');

		return $html;

	} else {
		// TODO for other types, e.g. tracker items

		return '<span class="text-danger">' . tra('wikidiff: Error - only wiki pages supported currently') . '</span>';
	}
}
