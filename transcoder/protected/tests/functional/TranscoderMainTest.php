<?php

use Facebook\WebDriver\WebDriverBy;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**

 *
 * @author matthieu
 */
class TranscoderMainTest extends FunctionalAbstractClass
{

    /**
     * @test
     */
    public function testTranscoderHome() {
        echo "Test des éléments de l'interface\n";
        $this->webDriver->get($this->url . "/index.php?r=adicap/admin");
        // checking that page title contains word 'GitHub'
        $this->assertContains('BiobanquesTranscoder', $this->webDriver->getTitle());


        try {
            $element = WebDriverBy::linkText("Traduire un code ADICAP en CIM-O-3");
            $this->assertNotNull($this->webDriver->findElement($element));
        } catch (PHPUnit_Framework_AssertionFailedError $e) {
            array_push($this->verificationErrors, $e->toString());
        }
        try {
            $element = WebDriverBy::linkText("API pour développeurs");
            $this->assertNotNull($this->webDriver->findElement($element));
        } catch (PHPUnit_Framework_AssertionFailedError $e) {
            array_push($this->verificationErrors, $e->toString());
        }
        try {
            $element = WebDriverBy::linkText("Groupe de travail");
            $this->assertNotNull($this->webDriver->findElement($element));
        } catch (PHPUnit_Framework_AssertionFailedError $e) {
            array_push($this->verificationErrors, $e->toString());
        }
        try {
            $element = WebDriverBy::linkText("Documents utiles");
            $this->assertNotNull($this->webDriver->findElement($element));
        } catch (PHPUnit_Framework_AssertionFailedError $e) {
            array_push($this->verificationErrors, $e->toString());
        }
        try {
            $element = WebDriverBy::linkText("Nous contacter");
            $this->assertNotNull($this->webDriver->findElement($element));
        } catch (PHPUnit_Framework_AssertionFailedError $e) {
            array_push($this->verificationErrors, $e->toString());
        }

        try {
            $element = WebDriverBy::id("CodeForm_codeOblig");
            $this->assertNotNull($this->webDriver->findElement($element));
        } catch (PHPUnit_Framework_AssertionFailedError $e) {
            array_push($this->verificationErrors, $e->toString());
        }
        try {
            $element = WebDriverBy::id("CodeForm_codeFacult");
            $this->assertNotNull($this->webDriver->findElement($element));
        } catch (PHPUnit_Framework_AssertionFailedError $e) {
            array_push($this->verificationErrors, $e->toString());
        }
    }

    /**
     * Test du transcodage
     */
    public function testTranslation() {

        echo "\nTest du transcodage\n";

        $this->webDriver->get($this->url . "/index.php?r=adicap/admin");
        $codeOblig_element = WebDriverBy::id("CodeForm_codeOblig");
        $codeFacult_element = WebDriverBy::id("CodeForm_codeFacult");
        $submit = WebDriverBy::name('yt0');
        $this->webDriver->findElement($codeOblig_element)->clear();
        $this->webDriver->findElement($codeOblig_element)->sendKeys('FF');
        $this->webDriver->findElement($codeFacult_element)->sendKeys('');
        $this->webDriver->findElement($submit)->click();
        $element = WebDriverBy::cssSelector('.result h5');
        $this->assertContains('Le code fourni a été traduit en entier.', $this->webDriver->findElement($element)->getText());



        $this->webDriver->findElement($codeOblig_element)->clear();
        $this->webDriver->findElement($codeOblig_element)->sendKeys('7730');
        $this->webDriver->findElement($codeFacult_element)->sendKeys('');

        $this->webDriver->findElement($submit)->click();
        $message = $this->webDriver->findElement($element)->getText();
        $this->assertContains('Le code fourni ne peut être traduit, même partiellement.', $this->webDriver->findElement($element)->getText());

        $this->webDriver->findElement($codeOblig_element)->clear();
        $this->webDriver->findElement($codeOblig_element)->sendKeys('FF7730');
        $this->webDriver->findElement($codeFacult_element)->sendKeys('');

        $this->webDriver->findElement($submit)->click();
        $this->assertContains('Le code n\'a pas pu être traduit en entier.', $this->webDriver->findElement($element)->getText());
        $this->webDriver->findElement($codeOblig_element)->clear();
        $this->webDriver->findElement($codeOblig_element)->sendKeys('BHFF7730');
        $this->webDriver->findElement($codeFacult_element)->sendKeys('');

        $this->webDriver->findElement($submit)->click();
        $this->assertContains('Le code n\'a pas pu être traduit en entier.', $this->webDriver->findElement($element)->getText());
    }

    public function testApi() {
        echo 'Test de la page "API"';
        $this->webDriver->get($this->url . "/index.php?r=adicap/admin");
        $link = WebDriverBy::partialLinkText("API");
        $this->webDriver->findElement($link)->click();
        $element = WebDriverBy::cssSelector('#content>h1');
        $this->assertContains('API', $this->webDriver->findElement($element)->getText());
        $this->assertNotNull($this->webDriver->findElement(Facebook\WebDriver\WebDriverBy::cssSelector('.hljs')));
    }

    public function testRemerciements() {
        echo 'Test de la page "Remerciements"';
        $this->webDriver->get($this->url . "/index.php?r=adicap/admin");
        $link = WebDriverBy::partialLinkText("Groupe de travail");
        $this->webDriver->findElement($link)->click();
        $element = WebDriverBy::cssSelector('#content>h1');
        $this->assertContains('Remerciements', $this->webDriver->findElement($element)->getText());
    }

    public function testDocsUtiles() {
        echo 'Test de la page "Documents utiles"';
        $this->webDriver->get($this->url . "/index.php?r=adicap/admin");
        $link = WebDriverBy::partialLinkText("Documents");
        $this->webDriver->findElement($link)->click();
        $element = WebDriverBy::cssSelector('#content>h1');
        $this->assertContains('Documents utiles', $this->webDriver->findElement($element)->getText());
    }

    public function testContact() {
        echo 'Test de la page "Contact"';
        $this->webDriver->get($this->url . "/index.php?r=adicap/admin");
        $link = WebDriverBy::partialLinkText("contact");
        $this->webDriver->findElement($link)->click();
        $element = WebDriverBy::cssSelector('#content>h1');
        $this->assertContains('Contactez nous', $this->webDriver->findElement($element)->getText());
    }

}