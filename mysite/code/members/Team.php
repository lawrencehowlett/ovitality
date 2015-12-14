<?php
class Team extends DataObject {

	private static $db = array(
		'Title' => 'Text', 
		'Description' => 'Text', 
		'Limit' => 'Int', 
		'FacebookURL' => 'Text', 
		'Type' => 'Enum(array("Competitive", "Motivation"), "Competitive")'
	);

	private static $has_one = array(
		'Challenge' => 'Challenge'
	);

	private static $many_many = array(
		'Members' => 'Member', 
		'Leaders' => 'Member'
	);

	private static $summary_fields = array(
		'Title' => 'Title'
	);

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->removeFieldsFromTab(
			'Root.Main', 
			array('ChallengeID')
		);
		$fields->replaceField(
			'Title', 
			TextField::create('Title', 'Title')
		);

		return $fields;
	}

	public function getTeamFormFields() {
		$fields = parent::getFrontendFields();

		$fields->removeByName('TeamLeaderID');
		$fields->removeByName('ChallengeID');
		$fields->removeByName('Type');

		$fields->dataFieldByName('Limit')
			->setTitle('Number of team members');

		$fields->replaceField(
			'Title', 
			TextField::create('Title', 'Team Name')
		);

		$fields->replaceField(
			'FacebookURL', 
			TextField::create('FacebookURL', 'Team Facebook Group URL')
		);

		return $fields;
	}

	public function getTeamMembers() {
		return $this->Members()->exclude('ID', Member::currentUserID());
	}

	public function getTeamMembersForFrontend() {
		$leaderIds = $this->getTeamLeaders()->column('ID');
		$members = $this->Members()->exclude('ID', Member::currentUserID());
		if (count($leaderIds) > 0) {
			foreach ($leaderIds as $id) {
				$members = $members->exclude('ID', $id);
			}
		}

		return $members;
	}

	public function getTeamLeaders() {
		return $this->Leaders()->exclude('ID', Member::currentUserID());
	}

	public function IsNotFull() {
		if (!$this->Limit) {
			return true;
		}

		if ($this->Limit > $this->Members()->Count()) {
			return true;
		}

		return false;
	}

	public function getTeamManagementLink() {
		return Controller::join_links(
            MemberTeamManagementPage::get()->First()->Link()
        );		
	}

	public function getNumberMemberSpacesLeft() {
		return $this->Limit - $this->Members()->Count();
	}

	public function CanInviteMembers() {
		if ($this->Limit == 0) {
			return true;
		}

		if ($this->Limit > $this->Members()->Count()) {
			return true;
		}

		return false;
	}
}