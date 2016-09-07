<?php

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**

 *
 * @author matthieu
 */
abstract class FunctionalAbstractClass extends PHPUnit_Framework_TestCase
{
    /**
     * @var RemoteWebDriver
     */
    protected static $webDriver;

    public static function setUpBeforeClass() {
        parent::setUpBeforeClass();
        echo "\n" . 'Début des tests' . "\n";
        if (CommonProperties::$LAUNCHSELENIUM) {
            chdir(Yii::app()->basePath . '/data/apps');
            shell_exec('java -Dwebdriver.chrome.driver=chromedriver -jar selenium-server-standalone-2.53.1.jar >/dev/null 2>/dev/null & sleep 1 &');
        }

        echo "\n" . 'Création du webdriver' . "\n";
        $host = 'http://localhost:4444/wd/hub';

        try {

            switch (CommonProperties::$TESTBROWSER) {
                case 'chrome';
                    $desiredCapabilities = DesiredCapabilities::chrome();
                    break;
                case 'firefox';
                    $desiredCapabilities = DesiredCapabilities::firefox();
                    break;
                default: $desiredCapabilities = DesiredCapabilities::chrome();
            }
            FunctionalAbstractClass::$webDriver = RemoteWebDriver::create($host, $desiredCapabilities);
        } catch (Exception $ex) {
            echo 'Setting of webdriver fails : ' . $ex->getMessage() . $ex->getTraceAsString();
        }
    }

    public function setUp() {
//        $this->url = Yii::app()->baseUrl;
//        echo "\n" . 'Création du webdriver' . "\n";
//        $host = 'http://localhost:4444/wd/hub';
//
//        try {
//            $desiredCapabilities = DesiredCapabilities::chrome();
//            switch (CommonProperties::$TESTBROWSER) {
//                case 'chrome';
//                    $desiredCapabilities = DesiredCapabilities::chrome();
//                case 'firefox';
//                    $desiredCapabilities = DesiredCapabilities::firefox();
//            }
//            $this->webDriver = RemoteWebDriver::create($host, $desiredCapabilities);
//        } catch (Exception $ex) {
//            echo 'Setting of webdriver fails : ' . $ex->getMessage() . $ex->getTraceAsString();
//        }
    }

    public function tearDown() {


        echo "\n" . 'Quitte le webdriver' . "\n";
        //$this->webDriver->quit();
    }

    public static function tearDownAfterClass() {
        FunctionalAbstractClass::$webDriver->quit();
        echo "\n" . 'Arret de selenium' . "\n";
        if (CommonProperties::$LAUNCHSELENIUM)
            shell_exec('fuser -k -n tcp 4444');
        parent::tearDownAfterClass();
    }

}