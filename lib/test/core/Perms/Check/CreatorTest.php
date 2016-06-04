<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: CreatorTest.php 57944 2016-03-17 19:26:53Z jyhem $

/**
 * @group unit
 * 
 */

class Perms_Check_CreatorTest extends TikiTestCase
{
	function testNoActionTakenWhenNoCreator()
	{
		$mock = $this->getMock('Perms_Resolver');
		$mock->expects($this->never())
			->method('check');

		$creator = new Perms_Check_Creator('foobar');
		$this->assertFalse($creator->check($mock, array(), 'view', array('Registered')));
	}

	function testNoActionTakenWhenWrongCreator()
	{
		$mock = $this->getMock('Perms_Resolver');
		$mock->expects($this->never())
			->method('check');

		$creator = new Perms_Check_Creator('foobar');
		$this->assertFalse($creator->check($mock, array('creator' => 'barbaz'), 'view', array('Registered')));
	}

	function testCallForwarded()
	{
		$mock = $this->getMock('Perms_Resolver');
		$mock->expects($this->once())
			->method('check')
			->with($this->equalTo('view_own'), $this->equalTo(array('Registered')))
			->will($this->returnValue(true));

		$creator = new Perms_Check_Creator('foobar');
		$this->assertTrue($creator->check($mock, array('creator' => 'foobar'), 'view', array('Registered')));
	}
}