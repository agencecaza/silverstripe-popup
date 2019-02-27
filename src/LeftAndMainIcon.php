<?php

namespace Intwebg\Popup;

use SilverStripe\View\Requirements;
use SilverStripe\Core\Extension;

class LeftAndMainIcon extends Extension {

	public function init() {
		Requirements::css('intwebg/silverstripe-popup:client/css/PopupLeftAndMainIcon.css');
	}
  
}
