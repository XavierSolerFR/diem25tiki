<?php
/**
 * This redirects to the site's root to prevent directory browsing.
 *  
 * @ignore 
 * @package TikiWiki
 * @subpackage css
 * @copyright (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
 * @licence Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
 */
// $Id: index.php 57940 2016-03-17 19:24:00Z jyhem $

// This redirects to the sites root to prevent directory browsing
header("location: ../index.php");
die;
