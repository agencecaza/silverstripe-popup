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

class PopUpLeftAndMain extends LeftAndMain {

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

		$fields = FieldList::create(
			new CheckboxField('Online', 'Put Popup online'),
			new CheckboxField('Reset', 'Reset the date and time'),
			new DateTimeField('DateTime', 'Date and time start'),
			new DateTimeField('DateTimeEnd', 'Date and time end'),
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
			),
			DropdownField::create(
				'RedirectionID',
				'Redirect to:',
				Versioned::get_by_stage('Page','Live')->map('ID','Title')
			)
		);

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

		if ($config>0) {
			$form->saveInto($config);
		} else {
			$config = new PopupConfig();
			$config->DateTime = $data['DateTime'];
			$config->DateTimeEnd = $data['DateTimeEnd'];
		}

		if ($data['Reset']) {
			$config->DateTimeActive = time();
		}
		$config->write();

		if ($config) {
			$form->sessionMessage('Settings saved', 'good');
		} else {
			$form->sessionMessage('Settings not saved', 'bad');
		}
		return $this->redirectBack();

	}



}
