<?php
class ReferralMember_Extension extends DataExtension {

	private static $db = array(
		'ReferralHash' => 'Text'
	);

	private static $has_one = array(
		'Referral' => 'Referral'
	);

	public function SignupReferralLink() {
		return Controller::join_links(
			SignUpReferralPage::get()->First()->Link(), 
			"session", 
			$this->owner->ReferralHash
		);
	}
}