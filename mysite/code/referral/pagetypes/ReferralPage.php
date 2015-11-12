<?php
class ReferralPage extends Page {

	private static $icon = 'mysite/images/handshake-icon.png';
}

class ReferralPage_Controller extends Page_Controller {

	private static $allowed_actions = array(
		'ReferralForm'
	);

	public function init() {
		parent::init();

		Requirements::customScript(<<<JS
			(function($) {
			    $(document).ready(function(){
			        $('a#addmore').click(function(e){
			        	e.preventDefault();
			        });
			    });
			})(jQuery);
JS
		);
	}

	public function ReferralForm() {
		$fields = new FieldList(
			TextField::create('Name[]', 'Name'), 
			EmailField::create('Email[]', 'Email'), 
			LiteralField::create('AddMore', '<a href="javascript:void(0);" id="addmore" title="add more">Add more fields</a>')
		);

		$actions = new FieldList(
            FormAction::create("doSend")
            	->setTitle("Send")
        );

        $required = new RequiredFields('Name', 'Email');

        $form = new Form($this, 'ReferralForm', $fields, $actions, $required);

        return $form;
	}

	public function doSend($data, Form $form) {
		$settings = SiteConfig::current_site_config();
		for ($x=0; $x < count($data['Email']); $x++) {
			$member = Member::currentUser();
	        $emailData = array(
	            '$Name' => $data['Name'][$x], 
	            '$Referrer' => $member->FirstName, 
	            '$Link' => $member->SignupReferralLink()
	        );
	        $body = str_replace(array_keys($emailData), array_values($emailData), $settings->ReferralBody);

			$email = new Email(
				$settings->ReferralFrom, 
				$data['Email'][$x], 
				$settings->ReferralSubject, 
				$body
			);

			$email->send();
		}

		$form->sessionMessage('We have sent your invitation successfully', 'success');

        return $this->redirectBack();
    }	
}