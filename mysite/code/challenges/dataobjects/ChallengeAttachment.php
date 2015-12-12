<?php
class ChallengeAttachment extends DataObject {

	private static $db = array(
		'Title' => 'Text', 
		'SortOrder' => 'Int'
	);

	private static $has_one = array(
		'Challenge' => 'Challenge', 
		'Attachment' => 'File'
	);

	private static $singular_name = 'Attachment';

	private static $plural_name = 'Attachments';	

	private static $default_sort = 'SortOrder';

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->removeFieldsFromTab(
			'Root.Main', 
			array('ChallengeID', 'SortOrder', 'Attachment')
		);

		$fields->replaceField(
			'Title', 
			TextField::create('Title', 'Title')
		);

		if ($this->exists()) {
			$fields->insertAfter(
				UploadField::create('Attachment', 'Attachment')
					->setFolderName('Challenge/' . $this->ID . '/Attachments/'), 
				'Title'
			);
		}

		return $fields;
	}
}