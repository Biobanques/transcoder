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

    public function getWebDriver() {
        return $this->webDriver;
    }

    public function setWebDriver(RemoteWebDriver $webDriver) {
        $this->webDriver = $webDriver;
    }

    protected $url = 'http://transcoder.local';

    public function setUp() {
        echo "\n" . 'Début des tests' . "\n";
        chdir(Yii::app()->basePath . '/data/apps');
        shell_exec('java -Dwebdriver.chrome.driver=chromedriver -jar selenium-server-standalone-2.53.1.jar >/dev/null 2>/dev/null & sleep 1 &');
        $host = 'http://localhost:4444/wd/hub';
        $this->setWebDriver(RemoteWebDriver::create($host, DesiredCapabilities::chrome()));
    }

    public function tearDown() {


        echo "\n" . 'Quitte le webdriver' . "\n";
        $this->webDriver->quit();

        echo "\n" . 'Arret de selenium' . "\n";
        $this->webDriver->get('http://localhost:4444/selenium-server/driver?cmd=shutDownSeleniumServer');
    }

}