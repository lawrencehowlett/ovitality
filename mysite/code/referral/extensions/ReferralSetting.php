<?php
class ReferralSetting extends DataExtension {

	private static $db = array(
		'ReferralPoints' => 'Int', 
		'ReferralFrom' => 'Varchar', 
		'ReferralSubject' => 'Text', 
		'ReferralBody' => 'HTMLText'
	);

	public function updateCMSFields(FieldList $fields) {
		$fields->addFieldToTab(
			'Root.Referral', 
			TextField::create('ReferralPoints', 'Points')
		);

		$fields->addFieldToTab(
			'Root.Referral', 
			TextField::create('ReferralFrom', 'Email from')
		);

		$fields->addFieldToTab(
			'Root.Referral', 
			TextField::create('ReferralSubject', 'Subject')
		);

		$fields->addFieldToTab(
			'Root.Referral', 
			HTMLEditorField::create('ReferralBody', 'Body')
				->setRows(20)
		);		
	}
}