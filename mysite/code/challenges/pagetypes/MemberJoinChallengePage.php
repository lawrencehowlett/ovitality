<?php
class MemberJoinChallengePage extends MemberPage {

	private static $icon = 'mysite/images/signing-icon.png';
}

class MemberJoinChallengePage_Controller extends MemberPage_Controller {

	private static $allowed_actions = array(
		'team', 'individual', 'Form', 'GetTeams'
	);

	public function init() {
		parent::init();

		Requirements::javascript('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/3.1.1/bootstrap3-typeahead.min.js');
		Requirements::customScript(<<<JS
			(function($) {
			    $(document).ready(function(){
			    	$('#Form_Form_TeamAssignment .radio-option').click(function(){
			    		var option = $(this).find('input');
			    		if (option.val() == 'JoinExistingTeam') {
			    			$('#JoinExistingTeam').show();
			    			$('#CreateNewTeam').hide();
			    		} else if (option.val() == 'CreateNewTeam') {
			    			$('#CreateNewTeam').show();
			    			$('#JoinExistingTeam').hide();
			    		} else {
			    			$('#CreateNewTeam').hide();
			    			$('#JoinExistingTeam').hide();
			    		}
			    	});

					$('#Form_Form_SuggestTeam').typeahead({
						autoSelect: true, 
						source:function(query, process){
							return $.getJSON('member-area/challenges/join-challenge/GetTeams/Competitive', function(data){
								return process(data);
							});
						}
					});

	                $('#Form_Form_SuggestTeam').change(function() {
	                    var current = $(this).typeahead("getActive");
	                    $('#Form_Form_TeamID').val(current.id);
	                });		
			    });
			})(jQuery);			
JS
		);
	}

	public function GetTeams(SS_HTTPRequest $request) {
		$result = array();
		$teams = $this->getChallenge()->getAvailableTeams($request->param('ID'));
		foreach ($teams as $team) {
			array_push($result, array('id' => $team->ID, 'name' => $team->Title));
		}

		return Convert::array2json($result);
	}

	public function Form() {
		$fields = new FieldList();
		if ($this->getChallenge()->HasAvailableTeams()) {
			$fields->push(
				DropdownField::create(
					'Category', 
					'What is your motivation', 
					array(
						'Competitive' => 'Competitive', 
						'Motivation' => 'Motivation', 
					)
				)->setEmptyString('Select one')				
			);

			$fields->push(
				CheckboxField::create(
					'AutoAssignedTeam', 
					'Yes please automatically assign me to a team.'
				)				
			);
		}

        if ($this->IsTeam()) {
        	$fields->removeByName('AutoAssignedTeam');
        	$fields->push(
        		OptionsetField::create(
        			'TeamAssignment', 
        			false, 
        			array(
        				'AutoAssignedTeam' => 'Automatically assign me to a team', 
        				'JoinExistingTeam' => 'Join an existing team', 
        				'CreateNewTeam' => 'Create a new team and invite members'
        			), 
        			'AutoAssignedTeam'
        		)
        	);
        	$fields->push(TextField::create('SuggestTeam', 'Start typing the team name below to find the join your team'));
        	$fields->push(HiddenField::create('TeamID', false));
        	$fields->push(TextField::create('TeamName', 'Team name'));
        	$fields->push(TextField::create('TeamMemberName[]', 'Name'));
        	$fields->push(EmailField::create('TeamMemberEmail[]', 'Email'));
        }

        $actions = new FieldList(
            FormAction::create("doSubmit")
            	->setTitle("Proceed to next step")
        );

        $form = new Form($this, 'Form', $fields, $actions);
        $form->setTemplate('ChallengeTeamForm');

        return $form;	
	}

	public function doSubmit($data, Form $form) {
		$reference = new MemberChallengeReference();
		$reference->MemberID = Member::currentUserID();
		$reference->ChallengeID = $this->getChallenge()->ID;

		if (isset($data['AutoAssignedTeam']) && $data['AutoAssignedTeam']) {
			$reference->TeamID = $this->getChallenge()->getAutoTeamAllocation($data['Category'])->ID;
		}

		$form->saveInto($reference);

		try {
			$reference->write();

			if ($reference->TeamID) {
				$team = Team::get()->byID($reference->TeamID);
				if ($team) {
					$team->Members()->add(Member::currentUser());
				}
			}
		} catch(ValidationException $e) {
			$form->sessionMessage($e->getResult()->message(), 'bad');
			return $this->redirectBack();
		}

		return $this->redirectBack();
		//return $this->redirect(MemberStartPage::get()->First()->Link());		
	}

	public function team(SS_HTTPRequest $request) {
		Session::set('EnteredChallengeID', $this->request->param('ID'));
		return $this->renderWith(array('MemberJoinChallengePage_team', 'Page'));
	}

	public function individual(SS_HTTPRequest $request) {
		Session::set('EnteredChallengeID', $this->request->param('ID'));
		return $this->renderWith(array('MemberJoinChallengePage_individual', 'Page'));
	}

	public function getChallenge() {
		return Challenge::get()->byID(Session::get('EnteredChallengeID'));
	}

	public function IsTeam() {
		if ($this->request->param('Action') == 'team') {
			return true;
		}

		return false;
	}

	public function IsIndividual() {
		if ($this->request->param('Action') == 'individual') {
			return true;
		}

		return false;		
	}
}