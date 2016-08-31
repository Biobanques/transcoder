<?php

return CMap::mergeArray(
                require(dirname(__FILE__) . '/main.php'), array(
            'components' => array(
                'fixture' => array(
                    'class' => 'system.test.CDbFixtureManager',
                ),
                'db' => array(
                    'connectionString' => CommonProperties::$CONNECTIONSTRING,
                    'emulatePrepare' => true,
                    'username' => CommonProperties::$CONNECTIONUSER,
                    'password' => CommonProperties::$CONNECTIONPASSWORD,
                    'charset' => 'utf8',
                ),
            ),
            'params' => array(
                // this is used in contact page
                'adminEmail' => 'nicolas.malservet@inserm.fr',
                'docsPath' => '../../protected/data/',
            ),
        ));
