<?php

namespace Intwebg\Popup;

use SilverStripe\View\Requirements;
use SilverStripe\Core\Extension;

class LeftAndMainIcon extends Extension {

  public function init() {
			Requirements::css('resources/vendor/intwebg/silverstripe-popup/client/css/PopupLeftAndMainIcon.css');
  }
  
}
