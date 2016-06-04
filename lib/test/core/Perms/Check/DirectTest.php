<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: DirectTest.php 57944 2016-03-17 19:26:53Z jyhem $

/**
 * @group unit
 * 
 */

class Perms_Check_DirectTest extends TikiTestCase
{
	function testCallForwarded()
	{
		$direct = new Perms_Check_Direct;

		$mock = $this->getMock('Perms_Resolver');
		$mock->expects($this->once())
			->method('check')
			->with($this->equalTo('view'), $this->equalTo(array('Admins', 'Anonymous')))
			->will($this->returnValue(true));

		$this->assertTrue($direct->check($mock, array(), 'view', array('Admins', 'Anonymous')));
	}

	function testCallForwardedWhenFalseToo()
	{
		$direct = new Perms_Check_Direct;

		$mock = $this->getMock('Perms_Resolver');
		$mock->expects($this->once())
			->method('check')
			->with($this->equalTo('view'), $this->equalTo(array('Admins', 'Anonymous')))
			->will($this->returnValue(false));

		$this->assertFalse($direct->check($mock, array(), 'view', array('Admins', 'Anonymous')));
	}
}
