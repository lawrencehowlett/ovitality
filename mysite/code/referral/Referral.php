<?php
class Referral extends DataObject {

	private static $db = array(
		'Points' => 'Int'
	);

	private static $has_one = array(
		'Member' => 'Member', 
		'ReferralMember' => 'Member'
	);

	private static $default_sort = 'Created';

	public function PointsEarned($from = null, $to = null) {
		return 0;
	}

	public function NumberOfReferrals($from = null, $to = null) {
		return 0;
	}
}