<?php
/**
 * This redirects to the site's root to prevent directory browsing.
 *
 * @ignore
 * @package TikiWiki
 * @subpackage lib\setup
 * @copyright (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
 * @licence Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
 */
// $Id: index.php 57946 2016-03-17 19:28:19Z jyhem $

header("location: ../../index.php");
die;
