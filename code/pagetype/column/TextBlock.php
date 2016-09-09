<?php

class TextBlock extends ContentBlock {
    private static $singular_name = 'Text';
    
    private static $description = 'Text Content Block';

    private static $icon = 'timicx-gridpage/images/icons/text.png';

    private static $hide_ancestor = 'ContentBlock';

    public function getCMSFields() {
        $fields = parent::getCMSFields();

        $fields->removeByName('Alignment');
        return $fields;
    }

}

class TextBlock_Controller extends ContentBlock_Controller {

}
