<?php
class TeamMember extends DataObject {

	private static $db = array(
		'Title' => 'Varchar', 
		'Position' => 'Varchar', 
		'Content' => 'HTMLText', 
		'SortOrder' => 'Int'
	);

	private static $has_one = array(
		'TeamParent' => 'BlockTeam', 
		'Image' => 'Image'
	);

	private static $has_many = array(
		'SocialMediaAccounts' => 'TeamMemberSocialMediaAccount'
	);

	private static $summary_fields = array(
		'Thumbnail' => 'Thumbnail', 
		'Title' => 'Title', 
		'Position' => 'Position'
	);

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->removeFieldsFromTab(
			'Root.Main', 
			array('TeamParentID', 'SortOrder')
		);

		$fields->dataFieldByName('Content')
			->setRows(20);
		$fields->dataFieldByName('Image')
			->setFolderName('TeamMembers/');

		return $fields;
	}

	public function Thumbnail() {
		return $this->Image()->CMSThumbnail();
	}
}