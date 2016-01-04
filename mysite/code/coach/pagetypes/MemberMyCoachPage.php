<?php
class MemberMyCoachPage extends MemberPage {

}

class MemberMyCoachPage_Controller extends MemberPage_Controller {

	public function init() {
		parent::init();

		// add checking if has active challenge, joined as a team and not a coach
		$member = Member::currentUser();
		if ($member && !$member->HasActiveChallenge() && !$member->getActiveChallengeReference()->IsTeam() && !$member->IsCoach()) {
			return $this->redirect($this->getMemberPageInstance('MemberDashboardPage')->Link());
		}
	}
}