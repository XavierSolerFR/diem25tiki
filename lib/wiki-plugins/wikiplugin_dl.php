<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: wikiplugin_dl.php 59290 2016-07-27 15:39:33Z xavidp $

function wikiplugin_dl_info()
{
	return array(
		'name' => tra('Definition List'),
		'documentation' => 'PluginDL',
		'description' => tra('Create a definition list'),
		'prefs' => array('wikiplugin_dl'),
		'body' => tr('One entry per line. Each line is in %0Term: Definition%1 format.', '<code>', '</code>'),
		'iconname' => 'list',
		'tags' => array( 'basic' ),
		'introduced' => 1,
		'params' => array(
		),
	);
}

function wikiplugin_dl($data, $params)
{
	global $tikilib;

	global $replacement;
	if (isset($param))
		extract($params, EXTR_SKIP);
	$result = '<dl>';
	$lines = explode("\n", $data);

	foreach ($lines as $line) {
		$parts = explode(":", $line, 2);

		if (isset($parts[0]) && isset($parts[1])) {
			$result .= '<dt>' . $parts[0] . '</dt><dd>' . $parts[1] . '</dd>';
		} else {
			$result .= '<dt>'.$line.'</dt>';
		}
	}

	$result .= '</dl>';
	return $result;
}
