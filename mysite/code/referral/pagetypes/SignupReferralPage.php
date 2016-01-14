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

		$stripePublishKey = STRIPE_PUBLISH_KEY;
		Requirements::javascript('https://js.stripe.com/v2/');
		Requirements::customScript(<<<JS
			Stripe.setPublishableKey('$stripePublishKey');

			function stripeResponseHandler(status, response) {
				var form = $('form#Form_PaymentForm');

				if (response.error) {

					// Show the errors on the form
					form.find('.payment-errors').addClass('alert-danger').text(response.error.message).show();
					form.find('#Form_PaymentForm_action_doPay').prop('disabled', false).val('Complete Payment & Join Challenge');
				} else {

					// response contains id and card, which contains additional card details
					var token = response.id;

					// Insert the token into the form so it gets submitted to the server
					form.append($('<input type="hidden" name="stripeToken" />').val(token));

					// and submit
					form.get(0).submit();
				}
			};

			(function($) {
			    $(document).ready(function(){
					$('form#Form_PaymentForm').submit(function(event) {

						// Disable the submit button to prevent repeated clicks
						$(this).find('#Form_PaymentForm_action_doPay').prop('disabled', true).val('Loading...');

						Stripe.card.createToken($(this), stripeResponseHandler);

						// Prevent the form from submitting with the default action
						return false;
					});
			    });
			})(jQuery);			
JS
		);		
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
			$reference->IndividualOrTeam = 'Team';
			$reference->write();

			Session::set('ReferenceID', $reference->ID);

			$settings = SiteConfig::current_site_config();
			$MailChimp = new \Drewm\MailChimp($settings->APIKey);
			$apiData = array(
				'id'                => '0e51140d39',
				'email'             => array('email' => $member->Email),
				'merge_vars'        => array('Name' => $member->FullName),
				'double_optin'      => false,
				'update_existing'   => true,
				'replace_interests' => false,
				'send_welcome'      => false,
			);
			$result = $MailChimp->call('lists/subscribe', $apiData);

		} catch(ValidationException $e) {
			$form->sessionMessage($e->getResult()->message(), 'bad');
			return $this->redirectBack();
		}

		return $this->redirect($this->Link() . 'MembershipPlan');
	}

	public function PaymentForm() {
        $fields = new FieldList(
        	TextField::create('CardNumber', false)
        		->setAttribute('size', 20)
        		->setAttribute('data-stripe', 'number'), 
        	TextField::create('CVC', false)
        		->setAttribute('size', 4)
        		->setAttribute('data-stripe', 'cvc'),         		
        	TextField::create('ExpirationMonth', false)
        		->setAttribute('size', 2)
        		->setAttribute('data-stripe', 'exp-month'), 
        	TextField::create('ExpirationYear', false)
        		->setAttribute('size', 4)
        		->setAttribute('data-stripe', 'exp-year'),
        	CheckboxField::create('TermsConditions', false)
        );

        $actions = new FieldList(
            FormAction::create("doPay")
            	->setTitle("Complete Payment & Join Challenge")
        );
        $required = new RequiredFields('CardNumber', 'CVC', 'ExpirationMonth', 'ExpirationYear', 'TermsConditions');
        $form = new Form($this, 'PaymentForm', $fields, $actions, $required);
        $form->setTemplate('PaymentForm');

        return $form;
	}

	public function doPay($data, Form $form) {
		\Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);
		$reference = $this->getNewReference();
		try {
			if ($reference) {				
				$reference->PaymentStatus = 'Paid';
				$reference->Status = 'Active';
				$reference->write();

				$charge = \Stripe\Charge::create(array(
					"amount" => $reference->MembershipPlan()->WholePriceInCents(),
					"currency" => "gbp",
					"source" => $data['stripeToken'],
					"description" => $reference->MembershipPlan()->Title . ' at £' . $reference->MembershipPlan()->WholePrice() 
				));				

				Session::clear('ReferralHash');

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