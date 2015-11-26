<?php
class MemberJoinChallengePlanPage extends MemberPage {
	private static $icon = 'mysite/images/price-icon.png';
}

class MemberJoinChallengePlanPage_Controller extends MemberPage_Controller {

	private static $allowed_actions = array(
		'SelectMembershipPlan'
	);

	public function init() {
		parent::init();
	}

	public function SelectMembershipPlan(SS_HTTPRequest $request) {
		$planID = $request->param('ID');
		if ($planID) {
			
		}
		exit();
	}

	public function getChallenge() {
		$id = Session::get('EnteredChallengeID');
		return Challenge::get()->byID($id);
	}
}