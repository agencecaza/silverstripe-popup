<?php

namespace AgenceCaza\Popup;


use SilverStripe\Admin\LeftAndMain;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\DateTimeField;
use SilverStripe\Forms\TimeField;
use SilverStripe\Forms\DateField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\Form;
use SilverStripe\Versioned\Versioned;
use SilverStripe\Forms\FormAction;
use SilverStripe\View\Requirements;
use SilverStripe\Forms\TabSet;
use SilverStripe\Forms\Tab;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;

use AgenceCaza\Popup\PopupConfig;



use SheaDawson\TimePickerField\TimePickerField;


class PopupLeftAndMain extends LeftAndMain {

	private static $url_segment = 'popup';
	private static $menu_title  = 'Popup';
	private static $url_rule    = '/$Action/$ID/$OtherID';



	private static $allowed_actions = array(
	  'doSave'
	);

	public function getEditForm($id = null, $fields = null)
	{
		if (!$id) {
			$id = $this->currentPageID();
		}
		$form = parent::getEditForm($id);


		$fields = FieldList::create(
		$root = TabSet::create(
			'Root',
			 Tab::create(
				 '',
					CheckboxField::create('Online', _t('PopupLeftAndMain.ONLINE','Put online')),
					CheckboxField::create('Reset', _t('PopupLeftAndMain.RESETDATETIME','Reset the cookie datetime')),
					TextField::create(
						'DisplayDelay',
						_t('PopupLeftAndMain.DISPLAYDELAY','Display delay')
					)->setDescription( _t('PopupLeftAndMain.INSECONDS','in seconds') ),
					$date = DatetimeField::create('DateTime', _t('PopupLeftAndMain.STARTDATETIME','Start datetime'))->setDatetimeFormat('YYYY-MM-dd HH:mm:ss')->setHTML5(false),
					$dateend = DatetimeField::create('DateTimeEnd', _t('PopupLeftAndMain.ENDDATETIME','End datetime'))->setDatetimeFormat('YYYY-MM-dd HH:mm:ss')->setHTML5(false),
					DropdownField::create(
						'RedirectID',
						_t('PopupLeftAndMain.REDIRECTTO','Redirect to:'),
						Versioned::get_by_stage('Page','Live')->map('ID','Title')
					),
					HtmlEditorField::create(
						'Content',
						_t('PopupLeftAndMain.CONTENT','Content')
					),
					$uploadField = UploadField::create(
						'Image',
						'Image'
					)->setAllowedMaxFileNumber(1),
					TextField::create(
						'ButtonText',
						_t('PopupLeftAndMain.BUTTONTEXT','Button text')
					)
				)
			)
		);

		$uploadField->setFolderName('Uploads/Popup');

		$actions = new FieldList(
			FormAction::create("doSave")->setTitle(_t('PopupLeftAndMain.SUBMIT','Submit'))->addExtraClass('btn-primary')
		);

    $form = new Form(
        $this,
        'EditForm',
        $fields,
        $actions
    );

    $form->setTemplate($this->getTemplatesWithSuffix('_EditForm'));

		$config = PopupConfig::get()->first();
		if (isset($config) > 0) {
			$form->loadDataFrom($config);
		}
		$this->extend('updateEditForm', $form);

    return $form->addExtraClass('PopupForm');
  }

	public function doSave($data, Form $form) {

		$config = PopupConfig::get()->first();

		if (!isset($config) ) {

			$config = new PopupConfig();

		} else {

			if (isset($data['Reset'])) {
				$config->DateTimeActive = time();

				$form->sessionMessage(_t('PopupLeftAndMain.SETTINGSSAVEDANDCOOKIERRESETTED','Settings saved and cookie resetted'), 'good');
			} else {

				$form->sessionMessage(_t('PopupLeftAndMain.SETTINGSSAVED','Settings saved'), 'good');
			}

		}

		$form->saveInto($config);
		$config->write();

		return $this->redirectBack();

	}

	

	public function init() {
	    parent::init();

			Requirements::css('agencecaza/silverstripe-popup:client/css/PopupLeftAndMain.css');

			Requirements::css('agencecaza/silverstripe-popup:client/thirdparty/datetimepicker/build/jquery.datetimepicker.min.css');
			Requirements::javascript('agencecaza/silverstripe-popup:client/thirdparty/datetimepicker/build/jquery.datetimepicker.full.min.js');

			Requirements::javascript('agencecaza/silverstripe-popup:client/javascript/DateTime.js');





	}


}
