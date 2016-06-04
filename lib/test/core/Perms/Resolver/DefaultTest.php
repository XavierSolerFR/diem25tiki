<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: DefaultTest.php 57944 2016-03-17 19:26:53Z jyhem $

/** 
 * @group unit
 * 
 */

class Perms_Resolver_DefaultTest extends TikiTestCase
{
	function testAsExpected()
	{
		$resolver = new Perms_Resolver_Default(true);
		$this->assertTrue($resolver->check('view', array()));

		$resolver = new Perms_Resolver_Default(false);
		$this->assertFalse($resolver->check('view', array()));
	}

	function testApplicableGroups()
	{
		$resolver = new Perms_Resolver_Default(true);
		$this->assertContains('Anonymous', $resolver->applicableGroups());
		$this->assertContains('Registered', $resolver->applicableGroups());
	}
}

