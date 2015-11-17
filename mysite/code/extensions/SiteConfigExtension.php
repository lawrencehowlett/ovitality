<?php
class SiteConfig_Extension extends DataExtension {

	private static $db = array(
		'FooterContactTitle' => 'Varchar',
		'FooterContactText' => 'HTMLText',
		'Address' => 'Text', 
		'ContactNumber' => 'Varchar', 
		'Email' => 'Varchar', 
		'CopyrightText' => 'HTMLText'
	);

	private static $has_one = array(
		'Logo' => 'Image'
	);

	private static $has_many = array(
		//'FooterMenus' => 'FooterMenu', 
		//'SocialMediaServices' => 'SocialMediaService'
	);

	public function updateCMSFields(FieldList $fields) {

		$fields = $this->getContactfields($fields);

		$fields->addFieldToTab(
			'Root.Main', 
			HTMLEditorField::create('CopyrightText', 'Copyright')
				->setRows(20)
		);

		$fields->addFieldToTab(
			'Root.Main', 
			UploadField::create('Logo', 'Logo')
		);		

		/*$fields->addFieldToTab(
			'Root.FooterMenus', 
			GridField::create(
				'FooterMenus', 
				'Footer Menus', 
				$this->owner->FooterMenus(), 
				GridFieldConfig_RecordEditor::create()
					->addComponent(new GridFieldSortableRows('SortOrder'))
			)
		);

		$fields->addFieldToTab(
			'Root.SocialMediaServices', 
			GridField::create(
				'SocialMediaServices', 
				'Social Icons', 
				$this->owner->SocialMediaServices(), 
				GridFieldConfig_RecordEditor::create()
					->addComponent(new GridFieldSortableRows('SortOrder'))
			)
		);*/
	}

	private function getContactfields(&$fields) {
		$fields->addFieldToTab(
			'Root.Contact', 
			TextField::create('Address', 'Address')
		);		
		
		$fields->addFieldToTab(
			'Root.Contact', 
			TextField::create('Email', 'E-mail Address')
		);		

		$fields->addFieldToTab(
			'Root.Contact', 
			TextField::create('ContactNumber', 'Contact Number')
		);

		$fields->addFieldToTab(
			'Root.Contact', 
			TextField::create('FooterContactTitle', 'Footer Title')
		);		

		$fields->addFieldToTab(
			'Root.Contact', 
			TextareaField::create('FooterContactText', 'Footer Text')
		);
		
		return $fields;		
	}
}