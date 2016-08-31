<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/column1';
    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();
    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();
    public $viewId = null;
    public $viewData = null;

    /**
     * Override of render to enable unit testing of controller
     * */
    public function render($view, $data = null, $return = false) {
        $this->viewId = $view;
        $this->viewData = $data;

        /* if the component 'fixture' is defined we are probably in the test environment */
        if (!Yii::app()->hasComponent('fixture')) {
            parent::render($view, $data, $return);
        }
    }

    function init() {
        parent::init();
        $app = Yii::app();
        if (isset($_GET['lang'])) {
            $app->language = $_GET['lang'];
            $app->session['_lang'] = $app->language;
        } else
        if (isset($app->session['_lang'])) {
            $app->language = $app->session['_lang'];
        }
    }

}