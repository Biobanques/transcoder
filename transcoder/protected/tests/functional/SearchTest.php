<?php

class SearchTest extends WebTestCase
{

    protected function setUp() {
        parent::setUp();
        $this->setBrowser("*firefox");
    }

    public function testAdmin() {


        $this->open("/transcoder/transcoder/index.php?r=adicap/admin");
        $this->click("link=Traduire un code ADICAP en CIM-O-3");
        $this->waitForPageToLoad("30000");

        //recherche sans code
        $this->click("name=yt0");
        $this->waitForPageToLoad("30000");
        $this->assertEquals("Veuillez entrer un code à traduire.", $this->getText("css=div.errorSummary > h5"));

        $this->assertTrue($this->resultTranslated('GX', 'C53.8'));
        $this->assertTrue($this->resultTranslated('A7A0', 'M-8140/3'));
        $this->assertTrue($this->resultTranslated('A0C4', 'M-8440/0'));
        $this->assertTrue($this->resultTranslated('B0A0', 'M-8090/1'));
        $this->assertTrue($this->resultTranslated('G0A6', 'M-9014/0'));
        $this->assertTrue($this->resultNotTranslated('K7F6', 'M-9650/3'));
        $this->assertTrue($this->resultTranslated('X4A1', 'M-8000/1'));

        $this->assertTrue($this->resultNotTranslated('XX'));
        $this->assertTrue($this->resultNotTranslated('XX6001'));
        $this->assertTrue($this->resultTranslated('OHHPA7A2', 'M-8140/3'));
        $this->assertTrue($this->resultPartialTranslated('GX6001'));
    }

    /**
     * Recherche avec un code trouvé et entierement traduit
     * @param type $code
     * @param type $codeTranslated
     */
    private function resultTranslated($code, $codeTranslated) {
        try {
            $this->type("id=CodeForm_codeOblig", $code);
            $this->click("name=yt0");
            $this->waitForPageToLoad("30000");

            if ($this->assertEquals("Le code fourni a été traduit en entier.", $this->getText("css=div.successSummary > h5")))
                $this->assertStringStartsWith($codeTranslated, $this->getText("//div[@id='content']/div[3]/div/table/tbody/tr/td[4]"));
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }

    /**
     * Recherche avec un code trouvé mais non traduit
     * @param type $code
     */
    private function resultNotTranslated($code) {
        try {
            $this->type("id=CodeForm_codeOblig", $code);
            $this->click("name=yt0");
            $this->waitForPageToLoad("30000");
            $this->assertEquals("Le code fourni ne peut être traduit, même partiellement.", $this->getText("css=div.errorSummary > h5"));
            return true;
        } catch (Exception $ex) {

        }
    }

    /**
     * Recherche avec un code trouvé mais non traduit
     * @param type $code
     */
    private function resultPartialTranslated($code) {
        try {
            $this->type("id=CodeForm_codeOblig", $code);
            $this->click("name=yt0");
            $this->waitForPageToLoad("30000");
            $this->assertEquals("Le code n'a pas pu être traduit en entier.", $this->getText("css=div.partialSummary > h5"));
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }

}