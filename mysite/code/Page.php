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

	/**
	 * Initialise the controller
	 */
	public function init() {
		parent::init();

		/*$rand = new RandomGenerator();
		echo substr($rand->randomToken(), 0, -100);
		exit();*/
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
}
