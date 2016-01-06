<?php
class MemberDashboardPage extends MemberPage {

	private static $icon = 'mysite/images/dashboard-icon.png';
}

class MemberDashboardPage_Controller extends MemberPage_Controller {

	public function init() {
		parent::init();

		$currentDailyChallegePos = $this->getActiveDailyChallengePosition();
		Requirements::customScript(<<<JS
			var dailyChallengePos = '$currentDailyChallegePos';
JS
		);
	}

	public function index() {
		$template = '';
		if (Member::currentUser()->HasActiveChallenge()) {
			$template = '_current';
		}

		return $this->renderWith(array(
			'MemberDashboardPage' . $template, 'Page'
		));
	}

	public function getActiveChallenge() {
		$currentUser = Member::currentUser();
		if ($currentUser) {
			return $currentUser->getActiveChallenge();
		}

		return null;
	}

	public function getActiveDailyChallengePosition() {
		$position = 0;
		if ($this->getActiveChallenge()) {
			$dailyChallenges = $this->getActiveChallenge()->DailyChallenges();
			if ($dailyChallenges) {
				foreach ($dailyChallenges as $dailyChallenge) {
					if (DBField::create_field('Date', $dailyChallenge->Date)->IsToday()) {
						return $position;
					}
					$position++;
				}
			}
		}

		return $position;
	}

	public function getAvailableChallenges() {
		$challengeIDS = Member::currentUser()->ChallengeReferences()->filter(array('Status' => 'Active',
			'PaymentStatus' => 'Paid'))->column('ChallengeID');
		if (count($challengeIDS)) {
			return Challenge::get()->filter(array('Status' => 'Published'))->exclude('ID', $challengeIDS);
		}

		return Challenge::get()->filter(array('Status' => 'Published'));
	}

	public function getCompletedChallenges() {
		return Member::currentUser()->getCompletedChallenges();
	}
}