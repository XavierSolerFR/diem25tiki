<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: Urlencode.php 57951 2016-03-17 19:32:04Z jyhem $

class Search_Formatter_ValueFormatter_Urlencode extends Search_Formatter_ValueFormatter_Abstract
{
	private $separator = false;

	function __construct($arguments)
	{
		if (isset($arguments['separator'])) {
			$this->separator = $arguments['separator'];
		}
	}

	function render($name, $value, array $entry)
	{
		if (is_array($value) && $this->separator !== false) {
			return urlencode(implode($this->separator, $value));
		} else {
			return urlencode($value);
		}
	}
}

