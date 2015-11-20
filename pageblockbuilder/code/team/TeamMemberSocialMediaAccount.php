<?php
class TeamMemberSocialMediaAccount extends DataObject {

	private static $db = array(
		'Title' => 'Varchar', 
		'Account' => "Enum(array('Facebook', 'Twitter', 'LinkedIn', 'Instagram'), 'Facebook')", 
		'AccountAddress' => 'Text', 
		'SortOrder' => 'Int'
	);

	private static $has_one = array(
		'TeamMember' => 'TeamMember'
	);

	private static $singular_name = 'Social media account';

	private static $plural_name = 'Social media accounts';

	private static $default_sort = 'SortOrder';

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->removeFieldsFromTab(
			'Root.Main', 
			array('TeamMemberID', 'Title', 'SortOrder')
		);

		$fields->dataFieldByName('Account')
			->setEmptyString('select an account');

		$fields->replaceField(
			'AccountAddress', 
			TextField::create('AccountAddress', 'Address')
		);

		return $fields;
	}

	public function onBeforeWrite() {
		parent::onBeforeWrite();

		$this->Title = $this->Account;
	}
}