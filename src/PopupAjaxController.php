<?php

use SilverStripe\Control\Cookie;
use SilverStripe\Control\Controller;

class PopupAjaxController extends Controller {

  private static $allowed_actions = array(
    'close'
  );

  public function close() {
    Cookie::set('PopUp', $_REQUEST['datetime'], 2400);
    return Cookie::get('PopUp');
  }

}
