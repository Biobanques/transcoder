<?php

class SiteController extends Controller
{
    /**
     * Declares class-based actions.
     */

    /**      @codeCoverageIgnore     */
    public function actions() {
        return array(
// captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
// They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
// renders the view file 'protected/views/site/index.php'
// using the default layout 'protected/views/layouts/main.php'
        $this->render('index');
    }

    /**
     * page de présentation de lapi pour les développeurs.
     */
    public function actionApi() {
        $this->render('api');
    }

    /**
     * page de téléchargements des différents docs utiles
     */
    public function actionDocs() {
        if (isset($_GET['file'])) {
            $this->render('docs', array('folder' => $_GET['file']));
        } else
            $this->render('docs', array('folder' => null));
    }

    /**
     * fonction de téléchargements des différents docs utiles
     *          @codeCoverageIgnore    */
    public function actionDownload() {
        if (isset($_GET['file'])) {
            $file = $_GET['file'];
//            try {
            Yii::app()->getRequest()->sendFile($file, file_get_contents(Yii::app()->params->docsPath . $file), null, true);
//            } catch (Exception $ex) {
//
//                Yii::log($ex->getMessage(), CLogger::LEVEL_ERROR);
//            }
        }
    }

    /**
     * This is the action to handle external exceptions.
     */

    /**      @codeCoverageIgnore     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact() {
        $model = new ContactForm;
        //@codeCoverageIgnoreStart

        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                        "Reply-To: {$model->email}\r\n" .
                        "MIME-Version: 1.0\r\n" .
                        "Content-Type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        //@codeCoverageIgnoreEnd
        $this->render('contact', array('model' => $model));
    }

    /**
     * Page de remerciements
     */
    public function actionThanks() {
        $this->render('remerciements');
    }

}