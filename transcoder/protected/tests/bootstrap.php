<?php

// change the following paths if necessary
$yiit = dirname(__FILE__) . '/../../yii-1.1.14/framework/yiit.php';
$config = dirname(__FILE__) . '/../config/test.php';
$htmlPurifier = dirname(__FILE__) . '/../../yii-1.1.14/framework/vendors/htmlpurifier/HTMLPurifier.standalone.php';
$commonProperties = dirname(__FILE__) . '/../../CommonProperties.php';

require_once($yiit);

include $commonProperties;

require_once ($htmlPurifier);
Yii::createWebApplication($config);
