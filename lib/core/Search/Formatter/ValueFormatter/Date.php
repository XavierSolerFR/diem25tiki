<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: Date.php 57951 2016-03-17 19:32:04Z jyhem $

class Search_Formatter_ValueFormatter_Date extends Search_Formatter_ValueFormatter_Datetime
{
	function __construct()
	{
		$tikilib = TikiLib::lib('tiki');
		$this->format = $tikilib->get_short_date_format();
	}
}

