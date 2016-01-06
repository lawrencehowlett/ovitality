<?php
class MemberChallengesListPage extends MemberPage {

}

class MemberChallengesListPage_Controller extends MemberPage_Controller {

	public function init() {
		parent::init();
	}

	public function getAvailableChallenges() {
		$challengeIDS = Member::currentUser()->ChallengeReferences()->filter(array('Status' => 'Active',
			'PaymentStatus' => 'Paid'))->column('ChallengeID');
		if (count($challengeIDS)) {
			return Challenge::get()->filter(array('Status' => 'Published'))->exclude('ID', $challengeIDS);
		}

		return Challenge::get()->filter(array('Status' => 'Published'));
	}	

	public function getActiveChallenge() {
		return Member::currentUser()->getActiveChallenge();
	}

	public function getCompletedChallenges() {
		return Member::currentUser()->getCompletedChallenges();
	}
}