<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CodeFormTest
 *
 * @author matthieu
 */
class CodeFormTest extends PHPUnit_Framework_TestCase
{
//class CodeFormTest extends CTestCase {
    public $fixtures = array(
        'code' => 'code',
        'codeFac' => 'codeFac',
    );

    public function testNewCodeForm() {
        $codeForm = new CodeForm;
        $this->assertTrue(true);
        return $codeForm;
    }

    /**
     * @depends testNewCodeForm
     */
    public function testValidate($codeForm) {
        $codeForm->codeOblig = "BX";
        $codeForm->codeFacult = "";
        $this->assertTrue($codeForm->validate());
        $codeForm->codeOblig = "BXA";
        $codeForm->codeFacult = "A";
        $this->assertFalse($codeForm->validate());
    }

    /**
     * @depends testNewCodeForm
     */
    public function testSearchWithCode($codeForm) {
        $this->assertTrue(is_array($codeForm->searchWithCode(null, null)));
        $this->assertTrue(is_array($codeForm->searchWithCode('GX', null)));
        $this->assertTrue(is_string($codeForm->searchWithCode('GX', null)['organe'][0]));
        $this->assertTrue(is_a($codeForm->searchWithCode('GX', null)['organe'][1], 'ADICAP'));
        $this->assertTrue(is_array($codeForm->searchWithCode('G5', null)['organe'][1]));
        $this->assertTrue(is_string($codeForm->searchWithCode('A7A0', null)['lesion'][0]));
        $this->assertTrue(is_object($codeForm->searchWithCode('A7A0', null)['lesion'][1]));
        $this->assertTrue(is_string($codeForm->searchWithCode('BAA0P4', null)['codeLie'][0]));
        $this->assertTrue(is_object($codeForm->searchWithCode('BAA0P4', null)['codeLie'][1]));
        $this->assertTrue(is_string($codeForm->searchWithCode('OHBAA0P4', null)['codeLie'][0]));
        $this->assertTrue(is_object($codeForm->searchWithCode('OHBAA0P4', null)['codeLie'][1]));
        $this->assertTrue(is_string($codeForm->searchWithCode('OHBAA0P4', null)['modPrel'][0]));
        $this->assertTrue(is_object($codeForm->searchWithCode('OHBAA0P4', null)['modPrel'][1]));
        $this->assertTrue(is_string($codeForm->searchWithCode('OHBAA0P4', null)['typeTech'][0]));
        $this->assertTrue(is_object($codeForm->searchWithCode('OHBAA0P4', null)['typeTech'][1]));
        $this->assertTrue(is_object($codeForm->searchWithCode(null, '**LR*RP')['tumPrim'][1]));
        $this->assertTrue(is_object($codeForm->searchWithCode(null, '**LR*RP')['tumPrim'][1]));
        $this->assertTrue(is_string($codeForm->searchWithCode(null, '*****RP')['tumPrim'][0]));
        $this->assertTrue(is_string($codeForm->searchWithCode(null, '**LR***')['tumPrim'][0]));
        $this->assertTrue(is_array($codeForm->searchWithCode('FX', null)['organe'][1]));
    }

    /**
     * @depends testNewCodeForm
     */
    public function testSearchWithPartialCode($codeForm) {
        $this->assertEquals(null, $codeForm->searchWithPartialCode(null));
        $this->assertTrue(is_object($codeForm->searchWithPartialCode('GX')));
        $this->assertTrue(is_array($codeForm->searchWithPartialCode('FX')));
        $this->assertTrue(is_object($codeForm->searchWithPartialCode('A7A0')));
        $this->assertTrue(is_array($codeForm->searchWithPartialCode('A7AA')));
    }

    /**
     * @depends testNewCodeForm
     */
    public function testSearchFromForm($codeForm) {
        $this->code = null;
        $this->codeFac = null;
        $codeForm->attributes = $this->fixtures;
        $this->assertTrue(is_array($codeForm->searchFromForm()));
    }

    /**
     * @depends testNewCodeForm
     */
    public function testSearchApproch($codeForm) {

        $this->assertEquals(null, $codeForm->searchApproch(null));
        $this->assertTrue(is_array($codeForm->searchApproch('FX')));
    }

}