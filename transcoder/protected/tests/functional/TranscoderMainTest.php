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

        parent::$webDriver->get(Yii::app()->createAbsoluteUrl('adicap/admin'));

        // checking that page title contains word 'BiobanquesTranscoder'
        $this->assertContains('BiobanquesTranscoder', parent::$webDriver->getTitle());

        $element = WebDriverBy::linkText("Traduire un code ADICAP en CIM-O-3");
        $this->assertNotNull(parent::$webDriver->findElement($element));

        $element = WebDriverBy::linkText("API pour développeurs");
        $this->assertNotNull(parent::$webDriver->findElement($element));

        $element = WebDriverBy::linkText("Groupe de travail");
        $this->assertNotNull(parent::$webDriver->findElement($element));

        $element = WebDriverBy::linkText("Documents utiles");
        $this->assertNotNull(parent::$webDriver->findElement($element));

        $element = WebDriverBy::linkText("Nous contacter");
        $this->assertNotNull(parent::$webDriver->findElement($element));

        $element = WebDriverBy::id("CodeForm_codeOblig");
        $this->assertNotNull(parent::$webDriver->findElement($element));

        $element = WebDriverBy::id("CodeForm_codeFacult");
        $this->assertNotNull(parent::$webDriver->findElement($element));
    }

    /**
     * Test du transcodage
     */
    public function testTranslation() {

        echo "\nTest du transcodage\n";

        parent::$webDriver->get(Yii::app()->createAbsoluteUrl('adicap/admin'));
        sleep(2);
        $codeOblig_element = WebDriverBy::id("CodeForm_codeOblig");
        $codeFacult_element = WebDriverBy::id("CodeForm_codeFacult");
        $submit = WebDriverBy::name('yt0');
        parent::$webDriver->findElement($codeOblig_element)->clear();
        parent::$webDriver->findElement($codeOblig_element)->sendKeys('FF');
        parent::$webDriver->findElement($codeFacult_element)->sendKeys('');
        parent::$webDriver->findElement($submit)->click();
        sleep(2);

        $element = WebDriverBy::cssSelector('.result h5');
        $this->assertContains('Le code fourni a été traduit en entier.', parent::$webDriver->findElement($element)->getText());



        parent::$webDriver->findElement($codeOblig_element)->clear();
        parent::$webDriver->findElement($codeOblig_element)->sendKeys('7730');
        parent::$webDriver->findElement($codeFacult_element)->sendKeys('');

        parent::$webDriver->findElement($submit)->click();
        sleep(2);
        $message = parent::$webDriver->findElement($element)->getText();
        $this->assertContains('Le code fourni ne peut être traduit, même partiellement.', parent::$webDriver->findElement($element)->getText());

        parent::$webDriver->findElement($codeOblig_element)->clear();
        parent::$webDriver->findElement($codeOblig_element)->sendKeys('FF7730');
        parent::$webDriver->findElement($codeFacult_element)->sendKeys('');

        parent::$webDriver->findElement($submit)->click();
        sleep(2);
        $this->assertContains('Le code n\'a pas pu être traduit en entier.', parent::$webDriver->findElement($element)->getText());
        parent::$webDriver->findElement($codeOblig_element)->clear();
        parent::$webDriver->findElement($codeOblig_element)->sendKeys('BHFF7730');
        parent::$webDriver->findElement($codeFacult_element)->sendKeys('');

        parent::$webDriver->findElement($submit)->click();
        sleep(2);
        $this->assertContains('Le code n\'a pas pu être traduit en entier.', parent::$webDriver->findElement($element)->getText());
    }

    public function testApi() {
        echo 'Test de la page "API"';
        parent::$webDriver->get(Yii::app()->createAbsoluteUrl('adicap/admin'));
        $link = WebDriverBy::partialLinkText("API");
        parent::$webDriver->findElement($link)->click();
        sleep(2);
        $element = WebDriverBy::cssSelector('#content>h1');
        $this->assertContains('API', parent::$webDriver->findElement($element)->getText());
        $this->assertNotNull(parent::$webDriver->findElement(WebDriverBy::cssSelector('.hljs')));
    }

    public function testRemerciements() {
        echo 'Test de la page "Remerciements"';
        parent::$webDriver->get(Yii::app()->createAbsoluteUrl('adicap/admin'));
        $link = WebDriverBy::linkText("Groupe de travail");
        parent::$webDriver->findElement($link)->click();
        sleep(2);
        $element = WebDriverBy::cssSelector('#content h1');
        $this->assertContains('Remerciements', parent::$webDriver->findElement($element)->getText());
    }

    public function testDocsUtiles() {
        echo 'Test de la page "Documents utiles"';
        parent::$webDriver->get(Yii::app()->createAbsoluteUrl('adicap/admin'));
        $link = WebDriverBy::partialLinkText("Documents");
        parent::$webDriver->findElement($link)->click();
        sleep(2);
        $element = WebDriverBy::cssSelector('#content>h1');
        $this->assertContains('Documents utiles', parent::$webDriver->findElement($element)->getText());
    }

    public function testContact() {
        echo 'Test de la page "Contact"';
        parent::$webDriver->get(Yii::app()->createAbsoluteUrl('adicap/admin'));
        $link = WebDriverBy::partialLinkText("contact");
        parent::$webDriver->findElement($link)->click();
        sleep(2);
        $element = WebDriverBy::cssSelector('#content>h1');
        $this->assertContains('Contactez nous', parent::$webDriver->findElement($element)->getText());
    }

}