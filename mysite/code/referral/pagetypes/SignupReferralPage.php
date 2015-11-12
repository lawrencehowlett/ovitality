<?php
class SignupReferralPage extends Page {
	private static $icon = 'mysite/images/handshake-icon.png';
}

class SignupReferralPage_Controller extends Page_Controller {

	private static $allowed_actions = array(
		'challenge', 
		'info', 
		'MembershipPlan', 
		'Payment', 
		'session', 
		'RegisterForm', 
		'PaymentForm'
	);

	public function init() {
		parent::init();
	}

	public function RegisterForm() {
		return parent::RegisterForm();
	}

	public function register($data, Form $form) {
		$this->redirect($this->Link() . 'MembershipPlan');
		/*$member = new Member();
		$form->saveInto($member);

		try {
			$member->write();
			$member->login();
		} catch(ValidationException $e) {
			$form->sessionMessage($e->getResult()->message(), 'bad');
			return $this->redirectBack();
		}

		return $this->redirect(MemberStartPage::get()->First()->Link());*/
	}

	public function PaymentForm() {
		$form = new Form (
			$this,
			'PaymentForm',
			new FieldList(),
			new FieldList(
				new FormAction('pay', 'Complete Payment and join challenge')
			)
		);

		return $form;
	}

	public function pay($data, Form $form) {
		
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

	public function Referrer() {
		$hash = Session::get('ReferralHash');
		return Member::get()->filter(array('ReferralHash' => $hash))->First();
	}
}