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
        ob_start();
        $controller->actionWsSearch();
        ob_end_clean();
        $this->assertTrue($controller->modelForm != null);
        $_GET['CodeForm'] = array('code' => null, 'codeFac' => null);
        ob_start();
        $controller->actionWsSearch();
        $output = ob_get_clean();
        $this->assertTrue($controller->modelForm != null);
        $this->assertTrue($controller->viewData == null);
        $this->assertJson($output);
        $_GET['CodeForm'] = array('code' => 'BHFF7730', 'codeFac' => null);
        ob_start();
        $controller->actionWsSearch();
        $output = ob_get_clean();
        $this->assertTrue($controller->modelForm != null);
        $this->assertTrue($controller->viewData == null);
        $this->assertJson($output);
        $_GET['CodeForm'] = array('code' => 'BHFF7730', 'codeFac' => '**LR*RP');
        ob_start();
        $controller->actionWsSearch();
        $output = ob_get_clean();
        $this->assertTrue($controller->modelForm != null);
        $this->assertTrue($controller->viewData == null);
        $this->assertJson($output);
    }

}