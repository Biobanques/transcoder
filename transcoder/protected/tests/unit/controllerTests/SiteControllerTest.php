<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ADICAPTest
 *
 * @author matthieu
 */
class SiteControllerTest extends PHPUnit_Framework_TestCase
{
    public $fixtures = array(
        'post' => 'Post'
    );

    public function setUp() {
        // Import controller
        Yii::import('application.controllers.*');
    }

    public function testIndex() {
        $controller = new SiteController('SITE');

        $this->assertTrue($controller != null);
        $this->assertInstanceOf('SiteController', $controller);
        $controller->actionIndex();

        $this->assertEquals('index', $controller->viewId);
    }

    public function testApi() {
        $controller = new SiteController('SITE');

        $this->assertTrue($controller != null);
        $this->assertInstanceOf('SiteController', $controller);
        $controller->actionApi();

        $this->assertEquals('api', $controller->viewId);
    }

    public function testDocs() {
        $controller = new SiteController('SITE');

        $this->assertTrue($controller != null);
        $this->assertInstanceOf('SiteController', $controller);
        $controller->actionDocs();

        $this->assertEquals('docs', $controller->viewId);
        $_GET['file'] = 'Adicap_v5-03.pdf';
        $controller->actionDocs();

        $this->assertEquals('docs', $controller->viewId);
    }

    public function testContact() {
        $controller = new SiteController('SITE');

        $this->assertTrue($controller != null);
        $this->assertInstanceOf('SiteController', $controller);
        $controller->actionContact();

        $this->assertEquals('contact', $controller->viewId);
    }

    public function testThanks() {
        $controller = new SiteController('SITE');

        $this->assertTrue($controller != null);
        $this->assertInstanceOf('SiteController', $controller);
        $controller->actionThanks();

        $this->assertEquals('remerciements', $controller->viewId);
    }

}