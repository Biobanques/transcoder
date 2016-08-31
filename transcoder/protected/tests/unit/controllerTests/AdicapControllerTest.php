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
class AdicapControllerTest extends PHPUnit_Framework_TestCase
{
    public $fixtures = array(
        'post' => 'Post'
    );

    public function setUp() {
        // Import controller
        Yii::import('application.controllers.*');
    }

    public function testAdmin() {
        $controller = new AdicapController('ADICAP');

        $this->assertTrue($controller != null);
        $this->assertInstanceOf('AdicapController', $controller);
        $this->assertTrue($controller->modelForm == null);
        $controller->actionAdmin();
        $this->assertTrue($controller->modelForm != null);
        $this->assertEquals('admin', $controller->viewId);
        $_POST['CodeForm'] = array('codeOblig' => null, 'codeFacult' => null);
        $controller->actionAdmin();
        $this->assertTrue($controller->modelForm != null);
        $this->assertEquals('admin', $controller->viewId);
        $this->assertTrue($controller->viewData != null);
    }

    public function testWsSearch() {
        $controller = new AdicapController('ADICAP');

        $this->assertTrue($controller != null);
        $this->assertInstanceOf('AdicapController', $controller);
        $this->assertTrue($controller->modelForm == null);
        $controller->actionWsSearch();
        $this->assertTrue($controller->modelForm != null);
        $_GET['CodeForm'] = array('codeOblig' => null, 'codeFacult' => null);
        $controller->actionWsSearch();
        $this->assertTrue($controller->modelForm != null);
        $this->assertTrue($controller->viewData == null);
    }

}