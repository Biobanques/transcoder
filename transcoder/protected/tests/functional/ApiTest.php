<?php

//require 'vendor/autoload.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ap
 *
 * @author matthieu
 */
class ApiTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var RemoteWebDriver
     */
    protected $webDriver;
    protected $url = 'http://transcoder.local';

    public function setUp() {
        $old_path = getcwd();
        chdir(Yii::app()->basePath . '/data/apps');
//        $output = shell_exec('./launch_selenium.sh');
        shell_exec('java -Dwebdriver.chrome.driver=chromedriver -jar selenium-server-standalone-2.53.1.jar >/dev/null 2>/dev/null & sleep 5 &');

        $host = 'http://localhost:4444/wd/hub';

        $this->webDriver = RemoteWebDriver::create($host, DesiredCapabilities::chrome());
    }

    /**
     * @test
     */
    public function testTranscoderHome() {
        $this->webDriver->get($this->url);
        // checking that page title contains word 'GitHub'
        $this->assertContains('BiobanquesTranscoder', $this->webDriver->getTitle());
    }

    public function tearDown() {
        echo 'Fin des tests';
//        $this->webDriver->get('http://localhost:4444/selenium-server/driver?cmd=shutDownSeleniumServer');
//        $this->webDriver->quit();
        parent::tearDown();
    }

}