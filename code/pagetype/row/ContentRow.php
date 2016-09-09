<?php

class ContentRow extends Page {
    private static $singular_name = 'Content Row';

    private static $description = 'Grid Layout Row';

    private static $allowed_children = array('ContentBlock');

    private static $icon = 'bootstrap4-grid/images/icons/content-row.png';

    private static $has_many = array(
        'ContentBlocks' => 'ContentBlock'
    );

    private static $db = array(
		"extraClasses" => "Varchar"
    );

    private static $defaults = array(
		"ShowInMenus" => false,
		"ShowInSearch" => false
    );

    public function getCMSFields() {
        $fields = parent::getCMSFields();

        $fields->addFieldToTab('Root.Main', new TextField('extraClasses', _t('ContentBlock.ADDITIONAL_CLASSES', 'CSS classes')), 'Content');

        $fields->removeByName('MenuTitle');
        $fields->removeByName('Metadata');
        $fields->removeByName('Content');


        return $fields;
    }

}

class ContentRow_Controller extends Page_Controller {


}


