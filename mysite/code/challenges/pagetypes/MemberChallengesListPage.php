<?php
class MemberChallengesListPage extends MemberPage {

}

class MemberChallengesListPage_Controller extends MemberPage {

	public function init() {
		parent::init();
	}

	public function ActiveChallenges() {
		return Challenge::get();
	}

	public function getCompletedChallenges() {

	}
}