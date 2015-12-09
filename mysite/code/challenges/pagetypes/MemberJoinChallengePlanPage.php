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
		$reference = MemberChallengeReference::get()->byID($this->getSesJoinChallenge()->ChallengeReferenceID);
		if ($reference) {
			$reference->MembershipPlanID = $request->param('ID');
			$reference->write();
		}

		$this->redirect(MemberJoinChallengePayPage::get()->First()->Link());
	}

	public function getChallenge() {
		return Challenge::get()->byID($this->getSesJoinChallenge()->ChallengeID);
	}

	public function getSesJoinChallenge() {
		return unserialize(Session::get('JoinChallenge'));
	}
}