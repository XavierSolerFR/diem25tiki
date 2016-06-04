<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: user_wizard.php 57942 2016-03-17 19:25:28Z jyhem $

require_once('lib/wizard/wizard.php');

/**
 * The Wizard's first page and frame handler 
 */
class UserWizard extends Wizard 
{
    function pageTitle ()
    {
        return tra('Welcome to the User Wizard');
    }

	function isEditable ()
	{
		return false;
	}

	function onSetupPage ($homepageUrl) 
	{
		global $TWV;
		$smarty = TikiLib::lib('smarty');
		// Run the parent first
		parent::onSetupPage($homepageUrl);
		
		$smarty->assign('tikiMajorVersion', substr($TWV->version, 0, 2));
				
		// Assign the page template
        $smarty->assign('pageTitle', $this->pageTitle());
		
		return true;		
	}

	function getTemplate()
	{
		$wizardTemplate = 'wizard/user_wizard.tpl';
		return $wizardTemplate;
	}

	function onContinue ($homepageUrl) 
	{
		// Run the parent first
		parent::onContinue($homepageUrl);
	}
}