<?php

use SilverStripe\Admin\LeftAndMain;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\DateTimeField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\Form;
use SilverStripe\Versioned\Versioned;
use SilverStripe\Forms\FormAction;

class PopupLeftAndMain extends LeftAndMain {

	private static $url_segment = 'popup';
	private static $menu_title  = 'Popup';
	private static $url_rule    = '/$Action/$ID/$OtherID';



	private static $allowed_actions = array(
      	  'PopupSubmit'
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
					$date = DateTimeField::create('DateTime', 'Start date'),
					$dateend = DateTimeField::create('DateTimeEnd', 'End date'),
					DropdownField::create(
						'RedirectionID',
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
					),
					TextField::create(
						'ButtonText',
						'Button text'
					)
				)
			)
		);

		$date->getDateField()->setConfig('showcalendar', true);
		$date->setTimeField(TimePickerField::create('DateTime[time]')->setTitle('Start time'));
		$dateend->getDateField()->setConfig('showcalendar', true);
		$dateend->setTimeField(TimePickerField::create('DateTimeEnd[time]')->setTitle('End time'));

		$uploadField->setFolderName('Uploads/Popup');
		$uploadField->setDisplayFolderName('Uploads/Popup');

		$actions = new FieldList(
			FormAction::create("PopupSubmit")->setTitle("Submit")
		);

    $form = new Form(
        $this,
        'EditForm',
        $fields,
        $actions
    );


	$Config = PopupConfig::get()->first();
	if ($Config>0) {
		$form->loadDataFrom($Config);
	}

$form->addExtraClass('cms-edit-form');
    $form->setTemplate($this->getTemplatesWithSuffix('_EditForm'));

    $this->extend('updateEditForm', $form);

    return $form;
  }

	public function PopupSubmit($data, Form $form) {

		$config = PopupConfig::get()->first();

		if ($config) {
			if (isset($data['Reset'])) {
				$config->DateTimeActive = time();
				$config->write();

				$form->sessionMessage('Changes saved and counter resetted', 'good');
			} else {
				$form->sessionMessage('Changes saved', 'good');
			}
			return $this->redirectBack();

		} else {

			$form->sessionMessage('Problem when trying to save data', 'bad');

			return $this->redirectBack();
		}

	}

	

	public function init() {
	    parent::init();

	    Requirements::css('intwebg/silverstripe-popup:client/css/PopupLeftAndMain.css');

	}
	
	
}
