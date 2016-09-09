<?php

class ContentBlock extends Page {
    private static $singular_name = 'Content Block';
    private static $description = 'Abstract Content Container, use Text or Image instead';
    private static $allowed_children = "none";

    private static $db = array(
        'ColumnCount' => 'Int',
        'MobileColumnCount' => 'Int',
        'OffsetSmall' => 'Int',
        'OffsetLarge' => 'Int',
        'ColumnOrdering' => "Int",
        'HideFor' => 'Varchar',
        'AdditionalClasses' => 'Varchar',
        'Alignment' => "Enum(array('none', 'left', 'center', 'right'), 'none')"
    );

    private static $defaults = array(
        'ColumnCount' => null,
        'MobileColumnCount' => null,
        'OffsetSmall' => null,
        'OffsetLarge' => null,
        'ColumnOrdering' => null,
        'HideFor' => null,
        "ShowInMenus" => false,
        "ShowInSearch" => false,
    );


    public function CSSClasses($stopAtClass = 'ViewableData') {
        $class = parent::CSSClasses('Page');

        $largeColumns = (int) $this->getField('ColumnCount');
        if ($largeColumns != 0) {
            $class .= ' col-md-' . $largeColumns;
        } else {
            $class .= ' col-md-12';
        }

        $smallColumns = (int) $this->getField('MobileColumnCount');
        if ($smallColumns != 0) {
            $class .= ' col-xs-' . $smallColumns;
        }

        // TODO: Hier mit CSS-Klassenerstellung fortsetzen
        return $class;

        if ($this->getField('Alignment') !== 'none') {
            $class .= ' align-' . $this->getField('Alignment');
        }

        $class .= ' ' . $this->getField('AdditionalClasses');

        $sourceOrdering = (int) $this->getField('SourceOrdering');
        if ($sourceOrdering > 0) {
            $class .= ' push-' . $sourceOrdering;
        } else if ($sourceOrdering < 0) {
            $class .= ' pull-' . abs($sourceOrdering);
        }

        $offsetSmall = (int) $this->getField('OffsetSmall');
        if ($offsetSmall > 0) {
            $class .= ' small-offset-' . $offsetSmall;
        }

        $offsetLarge = (int) $this->getField('OffsetLarge');
        if ($offsetLarge > 0) {
            $class .= ' large-offset-' . $offsetLarge;
        }

        $showFor = $this->getField('ShowFor');
        if ($showFor != null) {
            $class .= ' ' . $showFor;
        }

        $hideFor = $this->getField('HideFor');
        if ($hideFor != null) {
            $class .= ' ' . $hideFor;
        }

        return $class;
    }

    public function getCMSFields() {
        $fields = parent::getCMSFields();

        $alignField = new DropdownField('Alignment', _t('ContentBlock.ALIGNMENT', 'Alignment'), array(
            'none' => _t('ContentBlock.ALIGN_NONE', '(none)'),
            'left' => _t('ContentBlock.ALIGN_LEFT', 'left'),
            'center' => _t('ContentBlock.ALIGN_CENTER', 'center'),
            'right' => _t('ContentBlock.ALIGN_RIGHT', 'right'),
         ));
        $fields->addFieldToTab('Root.Main', $alignField, 'Metadata');

        // remove unneeded fields
        //$fields->removeByName('URLSegment');
        $fields->removeByName('MenuTitle');
        $fields->removeByName('Title');
        $fields->removeByName('Metadata');

        // add fields for foundation CSS
        $tabName = 'Root.BootstrapCSS';
        $fields->addFieldToTab($tabName, new HeaderField('ColumnHeader', _t('ContentBlock.HEADER_BOOTSTRAP', 'Bootstrap CSS Settings')));
        $fields->addFieldToTab($tabName, new LiteralField('IntroHint', '<p>' . _t('ContentBlock.INTRO_HINT') . '</p>'));

        $of = _t('ContentBlock.OF', 'of');
        $fields->addFieldToTab($tabName, new DropdownField('ColumnCount', _t('ContentBlock.COLUMNS_LARGE_GRID', 'Grid Columns (Desktop)'), array(
            null => _t('ContentBlock.COLUMNS_LARGE_DEFAULT', 'default (full width)'),
            1 => '1 ' . $of . ' 12',
            2 => '2 ' . $of . ' 12',
            3 => '3 ' . $of . ' 12',
            4 => '4 ' . $of . ' 12',
            5 => '5 ' . $of . ' 12',
            6 => '6 ' . $of . ' 12',
            7 => '7 ' . $of . ' 12',
            8 => '8 ' . $of . ' 12',
            9 => '9 ' . $of . ' 12',
            10 => '10 ' . $of . ' 12',
            11 => '11 ' . $of . ' 12',
            12 => '12 ' . $of . ' 12'
        )));

        $fields->addFieldToTab($tabName, new DropdownField('MobileColumnCount', _t('ContentBlock.COLUMNS_SMALL_GRID', 'Grid Columns (Mobile)'), array(
            null => _t('ContentBlock.COLUMNS_SMALL_DEFAULT', 'default (full width)'),
            1 => '1 ' . $of . ' 12',
            2 => '2 ' . $of . ' 12',
            3 => '3 ' . $of . ' 12',
            4 => '4 ' . $of . ' 12',
            5 => '5 ' . $of . ' 12',
            6 => '6 ' . $of . ' 12',
            7 => '7 ' . $of . ' 12',
            8 => '8 ' . $of . ' 12',
            9 => '9 ' . $of . ' 12',
            10 => '10 ' . $of . ' 12',
            11 => '11 ' . $of . ' 12',
            12 => '12 ' . $of . ' 12'
        )));

        $fields->addFieldToTab($tabName, new HeaderField('OffsetHeader', _t('ContentBlock.HEADER_OFFSET', 'Offset and Source Ordering'), 3));

        $fields->addFieldToTab($tabName, new DropdownField('OffsetLarge', _t('ContentBlock.OFFSET_LARGE', 'Left Offset (Desktop)'), array(
            null => _t('ContentBlock.NONE', 'none'),
            1 => '1',
            2 => '2',
            3 => '3',
            4 => '4',
            5 => '5',
            6 => '6',
            7 => '7',
            8 => '8',
            9 => '9',
            10 => '10',
            11 => '11'
        )));
        $fields->addFieldToTab($tabName, new DropdownField('OffsetSmall', _t('ContentBlock.OFFSET_SMALL', 'Left Offset (Mobile)'), array(
            null => _t('ContentBlock.NONE', 'none'),
            1 => '1',
            2 => '2',
            3 => '3',
            4 => '4',
            5 => '5',
            6 => '6',
            7 => '7',
            8 => '8',
            9 => '9',
            10 => '10',
            11 => '11'
        )));

        $pushMsgString = _t('ContentBlock.COLUMN_ORDERING_PUSH', 'push %d columns');
        $pullMsgString = _t('ContentBlock.COLUMN_ORDERING_PULL', 'pull %d columns');
        $orderingField = new DropdownField('ColumnOrdering', _t('ContentBlock.COLUMN_ORDERING', 'Column Ordering (Desktop)'), array(
            -11 => sprintf($pullMsgString, -11),
            -10 => sprintf($pullMsgString, -10),
            -9 => sprintf($pullMsgString, -9),
            -8 => sprintf($pullMsgString, -8),
            -7 => sprintf($pullMsgString, -7),
            -6 => sprintf($pullMsgString, -6),
            -5 => sprintf($pullMsgString, -5),
            -4 => sprintf($pullMsgString, -4),
            -3 => sprintf($pullMsgString, -3),
            -2 => sprintf($pullMsgString, -2),
            -1 => sprintf($pullMsgString, -1),
            1 => sprintf($pushMsgString, +1),
            2 => sprintf($pushMsgString, +2),
            3 => sprintf($pushMsgString, +3),
            4 => sprintf($pushMsgString, +4),
            5 => sprintf($pushMsgString, +5),
            6 => sprintf($pushMsgString, +6),
            7 => sprintf($pushMsgString, +7),
            8 => sprintf($pushMsgString, +8),
            9 => sprintf($pushMsgString, +9),
            10 => sprintf($pushMsgString, +10),
            11 => sprintf($pushMsgString, +11),
        ));
        $orderingField->setEmptyString( _t('ContentBlock.NONE', 'none'));
        $orderingField->setAttribute('width', '5px');

        $fields->addFieldToTab($tabName, $orderingField);

        $fields->addFieldToTab($tabName, new HeaderField('VisibilityHeader', _t('ContentBlock.HEADER_VISIBILITY', 'Visibility'), 3));

        $fields->addFieldToTab($tabName, new DropdownField('HideFor', _t('ContentBlock.HIDE_FOR', 'Hidden for'), array(
            null => _t('ContentBlock.HIDE_FOR_DEFAULT', 'default (never hide)'),
            'hidden-xs-down' => 'Hidden for XS',
            'hidden-sm-down' => 'Hidden for XS/S',
            'hidden-md-down' => 'Hidden for XS/S/M',
            'hidden-lg-down' => 'Hidden for XS/S/M/L',
            'hidden-sm-up' => 'Hidden for S/M/L/XL',
            'hidden-md-up' => 'Hidden for M/L/XL',
            'hidden-lg-up' => 'Hidden for L/XL',
            'hidden-xl-up' => 'Hidden for XL'
        )));

        $fields->addFieldToTab($tabName, new HeaderField('OtherHeader', _t('ContentBlock.HEADER_OTHER', 'Other'), 3));
        $fields->addFieldToTab($tabName, new TextField('AdditionalClasses', _t('ContentBlock.ADDITIONAL_CLASSES', 'Additional CSS classes')));
        return $fields;
    }

    public function getMenuTitle() {
        $content = $this->getField('Content');
        if (!empty($content)) {
            if (strlen($content) > 35) {
                $content = substr($content, 0, 35) . '...';
            }
            return strip_tags($content);
        } else {
            return $this->Title;
        }
    }

    /*
	protected function onBeforeWrite() {
		parent::onBeforeWrite();
        $this->URLSegment = null;
        $this->Title = $this->singular_name();
    }
     */


}

class ContentBlock_Controller extends Page_Controller {



}
