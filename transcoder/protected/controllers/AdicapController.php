<?php

class AdicapController extends Controller
{
    public $modelForm = null;
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
//public $layout='//layouts/column2';

    /**
     * @return array action filters
     */

    /**      @codeCoverageIgnore     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */

    /**      @codeCoverageIgnore     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('admin', 'wsSearch'),
                'users' => array('*'),
            ),
        );
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $this->modelForm = new CodeForm('search');

        if (isset($_POST['CodeForm'])) {
            $this->modelForm->attributes = $_POST['CodeForm'];
        }
        $this->modelForm->validate();
        $this->render('admin', array(
            'modelForm' => $this->modelForm,
            'datas' => $this->modelForm->searchFromForm()
                )
        );
    }

    /**
     * WS API.
     * Used to return json representation of translation result
     */
    public function actionWsSearch() {
        $this->modelForm = new CodeForm('search');
        $result = new ExtendedArray();
        //print_r($result->behaviors());

        $code = isset($_GET['code']) ? $_GET['code'] : '';
        $codeFac = isset($_GET['codeFac']) ? $_GET['codeFac'] : '';
        try {
            header('Content-type: application/json');
        } catch (Exception $ex) {

        }
        $result->arrayObj = $this->modelForm->searchWithCode($code, $codeFac);
        echo $result->toJSON();
    }

}