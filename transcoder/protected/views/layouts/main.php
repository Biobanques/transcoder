<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />

        <!-- blueprint CSS framework -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
        <!--[if lt IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
        <![endif]-->

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/result.css" />


<!--   <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/js/highlight/styles/dark.css" />
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/highlight/highlight.pack.js" />
        -->
        <!-- avec CDN si besoin d upgrade -->
        <!--<link rel="stylesheet" href="http://yandex.st/highlightjs/8.0/styles/default.min.css">
            <script src="http://yandex.st/highlightjs/8.0/highlight.min.js"></script>-->

        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/js/highlight/default.min.css">
            <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/highlight/highlight.min.js"></script>
            <script>hljs.initHighlightingOnLoad();</script>
            <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>

    <body>

        <div class="container" id="page">

            <div id="header">
                <div style="height: 80px;margin: 2px">
                    <div style="float: left">
                        <a href="http://www.biobanques.eu" target="_blank"><?php echo CHtml::image(Yii::app()->request->baseUrl . '/images/logobb.png', 'logo', array('height' => 80, 'width' => 110));
?></a>
                    </div><div style="float: left">
                        <h1><font color="grey"><?php echo CHtml::encode(Yii::app()->name); ?></h1>
                        <h2> Outil de traduction de code Adicap vers CIM-O-3</h2><br>
                    </div>
                    <div style="float: right">
                        En collaboration avec <br>
                            <a href="http://tumorotek.chu-stlouis.fr" target="_blank"> <?php echo CHtml::image(Yii::app()->request->baseUrl . '/images/logoTumo.png', 'logoTumo', array('height' => 30)); ?></a>
                    </div>
                </div>


                <!--Bloc à decommenter pour afficher les flags de changement de langue-->
                <!--                <div style="float:right;padding-right:20px;padding-top:20px;">
                                    <div ><a href="./index.php?lang=fr">
                <?php //                        echo CHtml::image(Yii::app()->request->baseUrl . '/images/fr.png'); ?>
                </a>
                                        <a style="padding-left: 10px;" href="./index.php?lang=en">
                <?php
//                            echo CHtml::image(Yii::app()->request->baseUrl . '/images/gb.png');
                ?></a>
                                    </div>
                                </div> header -->
                <br>
                    <div id="mainmenu">
                        <?php
                        $this->widget('zii.widgets.CMenu', array(
                            'items' => array(
//
                                array('label' => 'Traduire un code ADICAP en CIM-O-3', 'url' => array('/adicap/admin')),
                                array('label' => 'API pour développeurs', 'url' => array('/site/api')),
                                array('label' => 'Groupe de travail', 'url' => array('/site/thanks')),
                                array('label' => 'Documents utiles', 'url' => array('/site/docs')),
                                array('label' => 'Nous contacter', 'url' => array('/site/contact')),
                            ),
                        ));
                        ?>
                    </div><!-- mainmenu -->
                    <?php if (isset($this->breadcrumbs)): ?>
                        <?php
                        $this->widget('zii.widgets.CBreadcrumbs', array(
                            'links' => $this->breadcrumbs,
                        ));
                        ?><!-- breadcrumbs -->
                    <?php endif ?>

                    <?php echo $content; ?>

                    <div class="clear"></div>

                    <div id="footer">
                        Copyright INSERM - Projet <a href='http://www.biobanques.eu'>Biobanques</a> &copy; <?php echo date('Y'); ?><br/>
                        version <?php include "numversion.txt" ?>
                    </div><!-- footer -->

            </div><!-- page -->

    </body>
</html>
