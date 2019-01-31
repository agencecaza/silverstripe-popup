<?php

use SilverStripe\ORM\DataObject;

class PopUpInfolettreConfig extends DataObject {

	function canEdit($member = null)
	{
	return true;
	}
	function canDelete($member = null)
	{
	return true;
	}
	function canCreate($member = null)
	{
	return true;
	}
	function canPublish($member = null)
	{
	return true;
	}
	function canView($member = null)
	{
	return true;
	}


	public static $db = array(
		'Online'=>'Boolean',
		'DateTime'=>'SS_Datetime',
		'DateTimeEnd'=>'SS_Datetime',
		'DateTimeActive' => 'SS_Datetime',
		'ButtonText' => 'Text',
		'Content' => 'HTMLText'
	);

	public static $has_one = array(
		'Image' => 'Image',
		'Redirection' => 'SiteTree',
	);


}
