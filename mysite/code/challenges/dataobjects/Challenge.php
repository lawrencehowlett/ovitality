<?php
class Challenge extends DataObject {

	private static $db = array(
		'Title' => 'Text', 
		'Content' => 'HTMLText', 
		'Summary' => 'HTMLText', 
		'StartDate' => 'Date', 
		'EndDate' => 'Date'
	);

	private static $has_many = array(
		'MembershipPlans' => 'ChallengeMembershipPlan', 
		'DailyChallenges' => 'DailyChallenge', 
		'Teams' => 'Team'
	);

	private static $many_many = array(
		'Members' => 'Member'
	);

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->removeFieldsFromTab(
			'Root.Main', 
			array('SortOrder', 'Summary')
		);

		$fields->replaceField(
			'Title', 
			TextField::create('Title', 'Title')
		);

		if ($this->ID) {
			$fields->dataFieldByName('DailyChallenges')
				->getConfig()
				->addComponent(new GridFieldSortableRows('SortOrder'));
		}

		$fields->dataFieldByName('Content')
			->setRows(20);
		$fields->insertAfter(
			ToggleCompositeField::create(
				'ToggleSummary',
				'Add a summary',
				array(HTMLEditorField::create('Summary', false)->setRows(10))
			)->setHeadingLevel(4), 
			'Content'
		);

		$fields->dataFieldByName('StartDate')
			->setConfig('showcalendar', true)
			->setConfig('dateformat', 'dd/MM/yyy');
		$fields->dataFieldByName('EndDate')
			->setConfig('showcalendar', true)
			->setConfig('dateformat', 'dd/MM/yyy');

		return $fields;
	}

	public function getAutoTeamAllocation($category = null) {
		$teams = ($category) ? $this->Teams()->sort('Created ASC') : $this->Teams()->filter(array('Type' => $category))->sort('Created ASC');
		if ($teams) {
			foreach ($teams as $team) {
				if ($team->IsNotFull()) {
					return $team;
				}
			}
		}

		return null;
	}

	public function getAvailableTeams($category = null) {
		$result = new ArrayList();
		$teams = $this->Teams();
		if ($category) {
			$teams = $teams->filter(array('Type' => $category));
		}

		if ($teams->Count() > 0) {
			foreach ($teams as $team) {
				if ($team->Limit > $team->Members()->Count()) {
					$result->push($team);
				}
			}
		}

		return $result;
	}

	public function HasAvailableTeams() {
		if ($this->Teams()->Count() > 0) {
			foreach ($this->Teams() as $team) {
				if (!$team->Limit) {
					return true;
				}

				if ($team->Limit > $team->Members()->Count()) {
					return true;
				}
			}
		}

		return false;
	}

	public static function getInProgressChallenges() {
		return Challenge::get()->filter(array(
			'EndDate:GreaterThan' => 'NOW'
		))->sort('StartDate ASC');
	}

	public static function getCompletedChallenges() {
		return Challenge::get()->filter(array(
			'EndDate:LessThan' => 'NOW'
		));
	}

	public function getStartLabel() {
		if ($this->IsComingSoon()) {
			return 'Starting';
		}

		return 'Started';
	}

	public function IsComingSoon() {
		$now = DBField::create_field('Date', date('Y-m-d'));
		if ($this->StartDate > $now && $this->EndDate >= $now) {
			return true;
		}

		return false;
	}

	public function IsInProgress() {
		$now = DBField::create_field('Date', date('Y-m-d'));
		if ($this->StartDate <= $now && $this->EndDate >= $now) {
			return true;
		}

		return false;
	}

	public function HasEnded() {
		$now = DBField::create_field('Date', date('Y-m-d'));
		if ($this->EndDate <= $now) {
			return true;
		}

		return false;
	}

	public function getJoinIndividualChallengeLink() {
        return Controller::join_links(
            MemberJoinChallengePage::get()->First()->Link(),
            'individual',
            $this->ID
        );
	}

	public function getJoinTeamChallengeLink() {
        return Controller::join_links(
            MemberJoinChallengePage::get()->First()->Link(),
            'team',
            $this->ID
        );
	}	
}