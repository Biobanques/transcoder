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
class CIMMASTERTest extends PHPUnit_Framework_TestCase
{
    var $cimmaster;

    public function setUp() {
        parent::setUp();

        $this->cimmaster = new CIMMASTER;
    }

    public function testGetCimMasters() {
        //$this->setUp();
        $cimmaster = $this->cimmaster;
        $this->assertTrue(is_array($cimmaster->getParents()));
        $this->assertTrue(count($cimmaster->getParents()) == 0);
        $crit = new CDbCriteria();
        $crit->compare('t.code', 'A02');
        $cimmaster = CIMMASTER::model()->find($crit);
        $this->assertTrue(count($cimmaster->getParents()) > 0);
    }

}