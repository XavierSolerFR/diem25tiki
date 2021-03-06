<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: Sub.php 57952 2016-03-17 19:32:46Z jyhem $

class Math_Formula_Function_Sub extends Math_Formula_Function
{
	function evaluate( $element )
	{
		$elements = array();

		foreach ( $element as $child ) {
			$elements[] = $this->evaluateChild($child);
		}

		$out = array_shift($elements);

		foreach ($elements as $element) {
			$out -= $element;
		}

		return $out;
	}
}

