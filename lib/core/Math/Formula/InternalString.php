<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: InternalString.php 57952 2016-03-17 19:32:46Z jyhem $

class Math_Formula_InternalString
{
	private $content;
	private $type;
	private $children;

	function __construct( $content )
	{
		$this->content = trim($content, '"');
	}

	function getContent()
	{
		return $this->content;
	}
}

