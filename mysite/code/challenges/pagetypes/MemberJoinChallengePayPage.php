<?php
class MemberJoinChallengePayPage extends MemberPage {

	private static $icon = 'mysite/images/money-icon.png';
}

class MemberJoinChallengePayPage_Controller extends MemberPage_Controller {

	private static $allowed_actions = array(
		'Form'
	);

	public function init() {
		parent::init();
	}

	public function Form() {
        $fields = new FieldList(
        	CheckboxField::create('TermsConditions', false)
        );

        $actions = new FieldList(
            FormAction::create("doPay")
            	->setTitle("Complete Payment & Join Challenge")
        );
        $required = new RequiredFields('TermsConditions');
        $form = new Form($this, 'Form', $fields, $actions, $required);
        $form->setTemplate('PaymentForm');
        return $form;		
	}

	public function doPay($data, Form $form) {
		if ($this->getSesJoinChallenge()->ChallengeReferenceID) {
			$reference = MemberChallengeReference::get()->byID($this->getSesJoinChallenge()->ChallengeReferenceID);

			try {
				$reference->PaymentStatus = 'Paid';
				$reference->Status = 'Active';
				$reference->write();
			} catch(ValidationException $e) {
				$form->sessionMessage($e->getResult()->message(), 'bad');
				return $this->redirectBack();
			}

			$this->redirect(MemberChallengeDetailPage::get()->First()->Link());
		}

		return $this->redirectBack();
	}

	public function getChallenge() {
		return Challenge::get()->byID($this->getSesJoinChallenge()->ChallengeID);
	}

	public function getReference() {
		$sesJoinChallenge = $this->getSesJoinChallenge();
		if ($sesJoinChallenge->ChallengeReferenceID) {
			return MemberChallengeReference::get()->byID($sesJoinChallenge->ChallengeReferenceID);
		}

		return null;
	}

	public function getSesJoinChallenge() {
		return unserialize(Session::get('JoinChallenge'));
	}	
}