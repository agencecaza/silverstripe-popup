<?php


namespace Intwebg\Popup;



use SilverStripe\Control\Cookie;
use SilverStripe\Control\Controller;


class PopupController extends Controller {

  private static $allowed_actions = array(
    'close'
  );

  public function close() {
    Cookie::set('Popup', $_REQUEST['datetime'], 2400);
    return Cookie::get('Popup');
  }

}
