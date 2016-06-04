<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: NotFoundException.php 57952 2016-03-17 19:32:46Z jyhem $

class Search_Elastic_NotFoundException extends Search_Elastic_Exception
{
	function __construct($type, $id)
	{
		parent::__construct(tr('Document not found in index %1 (%0)', $type, $id));
	}
}

