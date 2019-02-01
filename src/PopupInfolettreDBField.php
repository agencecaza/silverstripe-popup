<?php

use SilverStripe\ORM\DataObject;

class PopupConfig extends DataObject {

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
		'Online' => 'Boolean',
		'DateTime' => 'Datetime',
		'DateTimeEnd' => 'Datetime',
		'DateTimeActive' => 'Datetime',
		'ButtonText' => 'Text',
		'Content' => 'HTMLText'
	);

	public static $has_one = array(
		'Image' => Image::class,
		'Redirect' => SiteTree::class,
	);


}
