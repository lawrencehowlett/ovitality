<?php
/**
 * Page block builder manager
 * 
 * @author Julius Caamici <julius@greenbrainer.com>
 * @copyright Copyright (c) 2015, Julius Caamic
 */
class CMSPageBlockBuilderController extends CMSMain {

	/**
	 * Set url segment
	 * 
	 * @var string
	 */
	private static $url_segment = 'pages/blockbuilder';

	/**
	 * Set url rule
	 * 
	 * @var string
	 */
	private static $url_rule = '/$Action/$ID/$OtherID';

	/**
	 * Set url priority
	 * 
	 * @var integer
	 */
	private static $url_priority = 42;

	/**
	 * Set menu title
	 * 
	 * @var string
	 */
	private static $menu_title = 'Block Builder';

	/**
	 * Set permission code
	 * 
	 * @var string
	 */
	private static $required_permission_codes = 'CMS_ACCESS_CMSMain';

	/**
	 * Set session namespace
	 * 
	 * @var string
	 */
	private static $session_namespace = 'CMSMain';

	/**
	 * Get the fields
	 * 
	 * @param  Int $id
	 * @param  FieldList $fields
	 * @return FieldList
	 */
	public function getEditForm($id = null, $fields = null) {
		$record = $this->getRecord($id ? $id : $this->currentPageID());
		
		return parent::getEditForm($record, ($record) ? $record->getBlockBuilderFields() : null);
	}
}