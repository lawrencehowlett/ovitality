<?php
/**
 * Represents the page
 * 
 * @author Julius <julius.caamic@yahoo.com>
 * @copyright Copyright (c) 2015, Julius
 */
class Page extends SiteTree {}

/**
 * Represents the page controller
 * 
 * @author Julius <julius.caamic@yahoo.com>
 * @copyright Copyright (c) 2015, Julius
 */
class Page_Controller extends ContentController implements PermissionProvider {

	private static $allowed_actions = array(
		'RegisterForm', 'SearchForm'
	);

	/**
	 * Initialise the controller
	 */
	public function init() {
		parent::init();

		Requirements::css('themes/ovitality/css/bootstrap.css');
		Requirements::css('themes/ovitality/css/themify-icons.css');
		Requirements::css('themes/ovitality/css/flexslider.css');
		Requirements::css('themes/ovitality/css/lightbox.min.css');
		Requirements::css('themes/ovitality/css/ytplayer.css');
		Requirements::css('themes/ovitality/css/theme.css');
		Requirements::css('themes/ovitality/css/custom.css');
		Requirements::css('http://fonts.googleapis.com/css?family=Lato:300,400%7CRaleway:100,400,300,500,600,700%7COpen+Sans:400,500,600');
	
		Requirements::javascript('themes/acs/js/jquery.min.js');
		Requirements::javascript('themes/acs/js/bootstrap.min.js');
		Requirements::javascript('themes/acs/js/flickr.js');
		Requirements::javascript('themes/acs/js/flexslider.min.js');
		Requirements::javascript('themes/acs/js/lightbox.min.js');
		Requirements::javascript('themes/acs/js/masonry.min.js');
		Requirements::javascript('themes/acs/js/twitterfetcher.min.js');
		Requirements::javascript('themes/acs/js/spectragram.min.js');
		Requirements::javascript('themes/acs/js/ytplayer.min.js');
		Requirements::javascript('themes/acs/js/countdown.min.js');
		Requirements::javascript('themes/acs/js/smooth-scroll.min.js');
		Requirements::javascript('themes/acs/js/parallax.js');
		Requirements::javascript('themes/acs/js/scripts.js');
	}

	/**
	 * Provide permission
	 * 
	 * @return array
	 */
	public function providePermissions() {
		return array(
			'COACH' => 'Can be part of one team, and be a team leader of that team. Can also coach many teams.', 
			'TEAM_LEADER' => 'Can create a team & nominate new team leader', 
			'LEVEL_1' => 'Limited content access', 
			'LEVEL_2' => 'Points + Recipes', 
			'LEVEL_3' => 'Points + Recipes + Workout videos'
		);
	}

	public function CurrentUser() {
		return Member::currentUser();
	}

	public function getIsAdminLoginPage() {
		if ($this->owner->URLSegment == 'Security') {
			return true;
		}

		return false;
	}	

	public function SearchForm() {
		$form = parent::SearchForm();
		$form->addExtraClass('search-form');

		$fields = $form->Fields();
		$fields->dataFieldByName('Search')
			->setAttribute('placeholder', 'Type here')
			->setValue('');

		return $form;
	}	

	public function RegisterForm() {
		$form = new Form (
			$this,
			'RegisterForm',
			singleton('Member')->getRegisterFields(),
			new FieldList(
				new FormAction('register', 'Join Now')
			)
		);

		return $form;		
	}

	public function register($data, Form $form) {
		$member = new Member();
		$form->saveInto($member);

		try {
			$member->write();
			$member->login();
		} catch(ValidationException $e) {
			$form->sessionMessage($e->getResult()->message(), 'bad');
			return $this->redirectBack();
		}

		return $this->redirect(MemberStartPage::get()->First()->Link());	
	}	
}
