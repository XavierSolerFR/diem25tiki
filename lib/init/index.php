<?php
/**
 * This redirects to the site's root to prevent directory browsing.
 *
 * @ignore
 * @package TikiWiki
 * @subpackage lib\init
 * @copyright (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
 * @licence Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
 */
// $Id: index.php 57948 2016-03-17 19:29:43Z jyhem $

header("location: ../index.php");
die;
