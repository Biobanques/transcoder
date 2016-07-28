<?php

/**

 */
class ExtendedArray extends CModel {

    public $arrayObj;

    public function behaviors() {
        return array(
            'EJsonBehavior' => array(
                'class' => 'application.behaviors.EJsonBehavior'
            ),
        );
    }

    public function __Construct() {
        $this->attachBehaviors($this->behaviors());
    }

    public function attributeNames() {

    }

}
