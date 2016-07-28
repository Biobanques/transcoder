<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$this->widget('zii.widget.CDetailView', array(
    'id' => $model->getPrimaryKey(),
    'data' => $model,
));

