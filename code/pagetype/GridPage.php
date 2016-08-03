<?php

/**
 * GridPage is a container page type to build responsive grid layouts based
 * on Bootstrap CSS Grids
 *
 * @author Guido Ehlert <guido.ehlert@timicx.com>
 */
class GridPage extends Page {

    private static $allowed_children = array('ContentRow');

    private static $description = 'Grid Layout page (Bootstrap 4 CSS)';

    private static $icon = 'bootstrap4-grid/images/icons/grid_page.png';
}

class GridPage_Controller extends Page_Controller {

}

