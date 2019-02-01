<?php

use SilverStripe\ORM\DataObject;
use SilverStripe\Assets\Image;
use SilverStripe\CMS\Model\SiteTree;

class PopupConfig extends DataObject {

	private static $db = array(
		'Online' => 'Boolean',
		'DateTime' => 'Datetime',
		'DateTimeEnd' => 'Datetime',
		'DateTimeActive' => 'Datetime',
		'ButtonText' => 'Text',
		'Content' => 'HTMLText'
	);

	private static $has_one = array(
		'Image' => Image::class,
		'Redirect' => SiteTree::class,
	);


}
