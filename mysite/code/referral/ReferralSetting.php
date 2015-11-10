<?php
class ReferralSetting extends DataExtension {

	private static $db = array(
		'ReferralPoints' => 'Int'
	);

	public function updateCMSFields(FieldList $fields) {
		$fields->addFieldToTab(
			'Root.Referral', 
			TextField::create('ReferralPoints', 'Points')
		);
	}
}