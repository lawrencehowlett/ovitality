<?php
/**
 * Represents the team block
 * 
 * @author Juius <julius@greenbrainer.com>
 * @copyright Copyright (c) 2015, Julius
 */
class BlockTeam extends Block {

	/**
	 * Set has many
	 * 
	 * @var array
	 */
	private static $has_many = array(
		'TeamMembers' => 'TeamMember'
	);

	/**
	 * Get component title
	 * 
	 * @var string
	 */
	protected $component_title = 'Team';

	/**
	 * Get CMS fields
	 * 
	 * @return FieldList
	 */
	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->removeByName('TeamMembers');

		$fields->addFieldToTab(
			'Root.Main', 
			GridField::create(
				'TeamMembers', 
				'Team Members', 
				$this->TeamMembers(), 
				GridFieldConfig_RecordEditor::create()
					->addComponent(new GridFieldSortableRows('SortOrder'))
			)
		);

		return $fields;
	}
}