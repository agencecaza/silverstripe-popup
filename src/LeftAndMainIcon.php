<?php

namespace AgenceCaza\Popup;

use SilverStripe\View\Requirements;
use SilverStripe\Core\Extension;

class LeftAndMainIcon extends Extension {

	public function init() {
		Requirements::css('agencecaza/silverstripe-popup:client/css/PopupLeftAndMainIcon.css');
	}
  
}
