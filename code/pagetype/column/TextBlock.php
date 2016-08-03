<?php

class TextBlock extends ContentBlock {
    static $singular_name = 'Text';
    static $description = 'Text Content Block';

    static $icon = 'timicx-gridpage/images/icons/text.png';

    static $hide_ancestor = 'ContentBlock';

    public function getCMSFields() {
        $fields = parent::getCMSFields();

        $fields->removeByName('Alignment');
        return $fields;
    }

}

class TextBlock_Controller extends ContentBlock_Controller {
    
}
