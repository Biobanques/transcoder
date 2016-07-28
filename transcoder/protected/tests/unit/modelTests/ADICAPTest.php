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
class ADICAPTest extends PHPUnit_Framework_TestCase
{
    var $adicap;

    public function setUp() {
        parent::setUp();

        $this->adicap = new ADICAP;
    }

    public function testGetCimMasters() {
        //$this->setUp();
        $adicap = $this->adicap;
        $this->assertEquals("", $adicap->getCimMasters());
        $crit = new CDbCriteria();
        $crit->compare('t.CODE', 'BZ');
        $adicap = ADICAP::model()->find($crit);
        $this->assertNotEquals("", $adicap->getCimMasters());
    }

    public function testGetCimLibelles() {
        //$this->setUp();
        $adicap = $this->adicap;
        $this->assertEquals("", $adicap->getCimLibelles());
        $crit = new CDbCriteria();
        $crit->compare('t.CODE', 'BZ');
        $adicap = ADICAP::model()->find($crit);
        $this->assertNotEquals("", $adicap->getCimLibelles());
    }

}