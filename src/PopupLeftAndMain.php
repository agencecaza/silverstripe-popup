<?php

namespace Intwebg\Popup;


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

use Intwebg\Popup\PopupConfig;



use SheaDawson\TimePickerField\TimePickerField;


class PopupLeftAndMain extends LeftAndMain {

	private static $url_segment = 'popup';
	private static $menu_title  = 'Popup';
	private static $url_rule    = '/$Action/$ID/$OtherID';



	private static $allowed_actions = array(
	  'doSave','success'
	);

	public function getEditForm($id = null, $fields = null)
	{
		if (!$id) {
				$id = $this->currentPageID();
		}
		$form = parent::getEditForm($id);

		/* */

		$fields = FieldList::create(
		$root = TabSet::create(
			'Root',
			 Tab::create(
				 '',
					CheckboxField::create('Online', 'Put Popup online'),
					CheckboxField::create('Reset', 'Reset the date and time'),
					$date = DatetimeField::create('DateTime', 'Start date')->setDatetimeFormat('YYYY-MM-dd HH:mm:ss')->setHTML5(false),
					$dateend = DatetimeField::create('DateTimeEnd', 'End date')->setDatetimeFormat('YYYY-MM-dd HH:mm:ss')->setHTML5(false),
					DropdownField::create(
						'RedirectID',
						'Redirect to:',
						Versioned::get_by_stage('Page','Live')->map('ID','Title')
					),
					HtmlEditorField::create(
						'Content',
						'Content'
					),
					$uploadField = UploadField::create(
						'Image',
						'Image'
					)->setAllowedMaxFileNumber(1),
					TextField::create(
						'ButtonText',
						'Button text'
					)
				)
			)
		);

		//$date->setTimeField(TimePickerField::create('DateTime[time]')->setTitle('Date And Time'));

		//$date->getDateField()->setConfig('showcalendar', true);
	//	$dateend->getDateField()->setConfig('showcalendar', true);
	//	$dateend->setTimeField(TimePickerField::create('DateTimeEnd[time]')->setTitle('End time'));

		$uploadField->setFolderName('Uploads/Popup');

		$actions = new FieldList(
			FormAction::create("doSave")->setTitle("Submit")->addExtraClass('btn-primary')
		);

    $form = new Form(
        $this,
        'EditForm',
        $fields,
        $actions
    );

		$form->addExtraClass('cms-edit-form');
    $form->setTemplate($this->getTemplatesWithSuffix('_EditForm'));
		//$form->setFormAction($this->Link().'PopupSubmit');

		$config = PopupConfig::get()->first();
		if (isset($config) > 0) {
			$form->loadDataFrom($config);
		}
		$this->extend('updateEditForm', $form);

    return $form;
  }

	public function doSave($data, Form $form) {

		$config = PopupConfig::get()->first();

		if (!isset($config) ) {

			$config = new PopupConfig();

		} else {

			if (isset($data['Reset'])) {
				$config->DateTimeActive = time();

				$form->sessionMessage('Settings saved and counter resetted', 'good');
			} else {

				$form->sessionMessage('Settings saved', 'good');
			}

		}

		$form->saveInto($config);
		$config->write();


		return $this->redirect($this->Link('success'));



	}

	public function success() {
		return $this->redirect("admin/popup");
	}

	public function init() {
	    parent::init();

			Requirements::css('resources/vendor/intwebg/silverstripe-popup/client/css/PopupLeftAndMain.css');

			Requirements::css('resources/vendor/intwebg/silverstripe-popup/client/thirdparty/datetimepicker/build/jquery.datetimepicker.min.css');
			Requirements::javascript('resources/vendor/intwebg/silverstripe-popup/client/thirdparty/datetimepicker/build/jquery.datetimepicker.full.min.js');

			Requirements::javascript('resources/vendor/intwebg/silverstripe-popup/client/javascript/DateTime.js');





	}


}
