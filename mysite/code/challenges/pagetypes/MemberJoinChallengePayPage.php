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

		if (!Session::get('JoinChallenge')) {
			return $this->redirect(MemberDashboardPage::get()->First()->Link());
		}

		$stripePublishKey = STRIPE_PUBLISH_KEY;
		Requirements::javascript('https://js.stripe.com/v2/');
		Requirements::customScript(<<<JS
			Stripe.setPublishableKey('$stripePublishKey');

			function stripeResponseHandler(status, response) {
				var form = $('form#Form_Form');

				if (response.error) {

					// Show the errors on the form
					form.find('.payment-errors').addClass('alert-danger').text(response.error.message).show();
					form.find('#Form_Form_action_doPay').prop('disabled', false).val('Complete Payment & Join Challenge');
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
					$('form#Form_Form').submit(function(event) {

						// Disable the submit button to prevent repeated clicks
						$(this).find('#Form_Form_action_doPay').prop('disabled', true).val('Loading...');

						Stripe.card.createToken($(this), stripeResponseHandler);

						// Prevent the form from submitting with the default action
						return false;
					});
			    });
			})(jQuery);			
JS
		);
	}

	public function Form() {
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
        $form = new Form($this, 'Form', $fields, $actions, $required);
        $form->setTemplate('PaymentForm');
        return $form;		
	}

	public function doPay($data, Form $form) {
		\Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);

		if ($this->getSesJoinChallenge()->ChallengeReferenceID) {
			$reference = MemberChallengeReference::get()->byID($this->getSesJoinChallenge()->ChallengeReferenceID);

			try {
				$charge = \Stripe\Charge::create(array(
					"amount" => $this->getReference()->MembershipPlan()->WholePriceInCents(),
					"currency" => "gbp",
					"source" => $data['stripeToken'],
					"description" => $this->getReference()->MembershipPlan()->Title . ' at £' . $this->getReference()->MembershipPlan()->WholePrice() 
				));
	
				$reference->PaymentStatus = 'Paid';
				$reference->Status = 'Active';
				$reference->write();

				Session::clear('JoinChallenge');

			} catch(\Stripe\Error\Card $e) {
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