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
    protected $webDriver;
    protected $verificationErrors = array();

    function getVerificationErrors() {
        return $this->verificationErrors;
    }

    function setVerificationErrors($verificationErrors) {
        $this->verificationErrors = $verificationErrors;
    }

    protected $url;

    public static function setUpBeforeClass() {
        parent::setUpBeforeClass();
        echo "\n" . 'Début des tests' . "\n";
        if (CommonProperties::$LAUNCHSELENIUM) {
            chdir(Yii::app()->basePath . '/data/apps');
            shell_exec('java -Dwebdriver.chrome.driver=chromedriver -jar selenium-server-standalone-2.53.1.jar >/dev/null 2>/dev/null & sleep 1 &');
        }
    }

    public function setUp() {
        $this->url = Yii::app()->baseUrl;
        echo "\n" . 'Création du webdriver' . "\n";
        $host = 'http://localhost:4444/wd/hub';
        try {
            $this->webDriver = RemoteWebDriver::create($host, DesiredCapabilities::chrome());
        } catch (Exception $ex) {
            echo 'Setting of webdriver fails : ' . $ex->getMessage() . $ex->getTraceAsString();
        }
    }

    public function tearDown() {


        echo "\n" . 'Quitte le webdriver' . "\n";
        $this->webDriver->quit();
    }

    public static function tearDownAfterClass() {
        echo "\n" . 'Arret de selenium' . "\n";
        if (CommonProperties::$LAUNCHSELENIUM)
            shell_exec('fuser -k -n tcp 4444');
        parent::tearDownAfterClass();
    }

}