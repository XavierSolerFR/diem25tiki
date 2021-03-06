<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: DirectFactory.php 57950 2016-03-17 19:31:22Z jyhem $

namespace Tiki\MailIn\Action;
use Tiki\MailIn\Account;
use Tiki\MailIn\Source\Message;

class DirectFactory implements FactoryInterface
{
	private $class;
	private $parameters;

	function __construct($class, array $parameters = [])
	{
		$this->class = $class;
		$this->parameters = $parameters;
	}

	function createAction(Account $account, Message $message)
	{
		$class = $this->class;
		return new $class($this->parameters);
	}
}

