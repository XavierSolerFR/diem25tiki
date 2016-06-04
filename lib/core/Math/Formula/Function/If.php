<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: If.php 57953 2016-03-17 19:33:34Z jyhem $

class Math_Formula_Function_If extends Math_Formula_Function
{
	function evaluate( $element )
	{
		$out = array();

		$cond = $this->evaluateChild($element[0]);
		$then = $element[1];
		$else = $element[2] ?: 0;

		return $this->evaluateChild($cond ? $then : $else);
	}
}

