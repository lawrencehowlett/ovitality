<?php
class ReferralMember_Extension extends DataExtension {

	private static $db = array(
		'ReferralHash' => 'Text'
	);

	private static $has_one = array(
		'Referral' => 'Referral'
	);
}