<?php
class SignupReferralPage extends Page {

	private static $icon = 'mysite/images/handshake-icon.png';
}

class SignupReferralPage_Controller extends Page_Controller {

	private static $allowed_actions = array(
		'challenge', 
		'code', 
		'info', 
		'MembershipPlan', 
		'SelectMembershipPlan', 
		'Payment', 
		'session', 
		'RegisterForm', 
		'PaymentForm'
	);

	public function init() {
		parent::init();
	}

	public function code(SS_HTTPRequest $request) {
		$code = $request->param('ID');
		$reference = MemberChallengeReference::get()->filter('ReferralCode', $code);
		if ($reference->exists()) {
			Session::set('ReferralCode', $code);
		}

		$this->redirect($this->Link());
	}

	public function RegisterForm() {
		$form = parent::RegisterForm();
		$actions = $form->Actions();
		foreach ($actions as $action) {
			$action->setTitle('Proceed to step 2 of 3');
		}

		return $form;
	}

	public function register($data, Form $form) {
		$member = new Member();
		$form->saveInto($member);

		try {
			$member->ReferralID= $this->getReference()->MemberID;
			$member->write();
			$member->login();

			// add to the team
			$team = Team::get()->byID($this->getReference()->TeamID);
			$team->Members()->add(Member::currentUser());
			
			// create a member challenge reference
			$reference = new MemberChallengeReference();
			$reference->MemberID = $member->ID;
			$reference->TeamID = $team->ID;
			$reference->ChallengeID = $this->getChallenge()->ID;
			$reference->Title = $this->getReference()->Title;
			$reference->Category = $this->getReference()->Category;
			$reference->JoinExistingTeam = true;
			$reference->write();

			Session::set('ReferenceID', $reference->ID);

		} catch(ValidationException $e) {
			$form->sessionMessage($e->getResult()->message(), 'bad');
			return $this->redirectBack();
		}

		return $this->redirect($this->Link() . 'MembershipPlan');
	}

	public function PaymentForm() {
        $fields = new FieldList(
        	CheckboxField::create('TermsConditions', false)
        );

        $actions = new FieldList(
            FormAction::create("doPay")
            	->setTitle("Complete Payment & Join Challenge")
        );
        $required = new RequiredFields('TermsConditions');
        $form = new Form($this, 'PaymentForm', $fields, $actions, $required);
        $form->setTemplate('PaymentForm');

        return $form;		
	}

	public function doPay($data, Form $form) {
		$reference = $this->getNewReference();
		try {
			if ($reference) {
				$reference->PaymentStatus = 'Paid';
				$reference->Status = 'Active';
				$reference->write();

				$this->redirect(MemberChallengeDetailPage::get()->First()->Link());
			}
		} catch(ValidationException $e) {
			$form->sessionMessage($e->getResult()->message(), 'bad');
			return $this->redirectBack();
		}

		return $this->redirectBack();
	}

	public function session(SS_HTTPRequest $request) {
		Session::set('ReferralHash',$request->param('ID'));

		$this->redirect($this->Link());
	}

	public function info(SS_HTTPRequest $request) {
		return $this->renderWith(array('SignupReferralPage_form', 'Page'));
	}

	public function MembershipPlan(SS_HTTPRequest $request) {
		return $this->renderWith(array('SignupReferralPage_membership', 'Page'));
	}

	public function Payment(SS_HTTPRequest $request) {
		return $this->renderWith(array('SignupReferralPage_payment', 'Page'));
	}

	public function SelectMembershipPlan(SS_HTTPRequest $request) {
		$planID = $this->request->param('ID');
		$membershipPlan = $this->getChallenge()->MembershipPlans()->find('ID', $planID);
		if ($membershipPlan) {
			$reference = $this->getNewReference();
			if ($reference) {
				$reference->MembershipPlanID = $membershipPlan->ID;
				$reference->write();

				$this->redirect($this->Link() . 'Payment');
			}
		}

		$this->redirectBack();
	}

	public function getReference() {
		$referralCode = Session::get('ReferralCode');
		$reference = MemberChallengeReference::get()->filter('ReferralCode', $referralCode)->First();
		if ($reference) {
			return $reference;
		}

		return null;
	}

	public function getNewReference() {
		$referenceID = Session::get('ReferenceID');
		if ($referenceID) {
			$reference = MemberChallengeReference::get()->byID($referenceID);
			if ($reference) {
				return $reference;
			}
		}

		return null;
	}

	public function getChallenge() {
		if ($this->getReference()) {
			return $this->getReference()->Challenge();
		}

		return null;
	}

	public function getReferrer() {
		if ($this->getReference()) {
			return $this->getReference()->Member();
		}

		return null;
	}
}