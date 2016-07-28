<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$this->widget('zii.widget.CDetailView', array(
    'id' => $model->getPrimaryKey(),
    'data' => $model,
    'attributes' => array(
        'code',
        'LIBELLE',
    )
));

if (isset($model->cIMLIBELLEs) && !empty($model->cIMLIBELLEs)) {
    echo '<h4><u>Libellés et traductions disponibles</u></h4>';
    foreach ($model->cIMLIBELLEs as $libelle) {
        echo "<h5>Source : $libelle->source</h5>";
        $this->widget('zii.widget.CDetailView', array(
            'id' => $model->getPrimaryKey(),
            'data' => $libelle,
            'attributes' => array('libelle', 'FR_OMS', 'EN_OMS', 'GE_DIMDI', 'GE_AUTO', 'FR_CHRONOS')
                )
        );
    }
}

$parentsAttributes = array();

$parents = $model->getParents();

if (isset($parents) && !empty($parents)) {

    if (!isset($withoutParents)) {

        foreach ($parents as $parKey => $parValue) {
            $listComments = array();


            if (isset($parValue->cIMLIBELLEs) && !empty($parValue->cIMLIBELLEs)) {

                foreach ($parValue->cIMLIBELLEs as $libelle) {
                    $listComments[$libelle->LID] = array('Source' => $libelle->source, 'traductions' => array('libelle' => $libelle->libelle, 'FR OMS' => $libelle->FR_OMS, 'EN OMS' => $libelle->EN_OMS, 'GE DIMDI' => $libelle->GE_DIMDI, 'GE AUTO' => $libelle->GE_AUTO, 'FR CHRONOS' => $libelle->FR_CHRONOS));
                }
                $commentValue = "Libellés et traductions disponibles\n\n";
                foreach ($listComments as $comment) {
                    $commentValue.="Source : " . $comment['Source'] . "\n";
                    foreach ($comment['traductions'] as $traductionKey => $traductionValue) {
                        $commentValue.=$traductionKey . " : " . $traductionValue . "\n";
                    }
                }
            }


            $parentsAttributes[] = array('label' => 'Niveau ' . $parKey, 'type' => 'raw', 'value' => CHtml::link($parValue->code . ' : ' . $parValue->LIBELLE, $this->createUrl($this->route), array('onclick' => '$("#detailsParentPopup' . $model->SID . '").dialog("open");return false;', 'title' => $commentValue)));
        }
    } else {
        foreach ($parents as $parKey => $parValue) {
            $parentsAttributes[] = array('label' => 'Niveau ' . $parKey, 'value' => $parValue->code . ' : ' . $parValue->LIBELLE);
        }
    }


    echo '<br><u><h4>Codes parents : </u></h4><font size = 0.8em>Survolez pour avoir les traductions</font>';

    $this->widget('zii.widget.CDetailView', array(
        'id' => $model->getPrimaryKey(),
        'data' => $model,
        'attributes' => $parentsAttributes
    ));
}

if ($parents != null && !empty($parents) && !isset($withoutParents)) {
    foreach ($parents as $parent) {
        $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
            'id' => 'detailsParentPopup' . $parent->SID,
            'options' => array(
                'autoOpen' => false,
                'width' => '800px',
                'title' => 'Détail du code ' . $parent->code,
        )));
        $this->renderPartial('cimView', array('model' => $parent, 'withoutParents' => true));
        $this->endWidget('zii.widgets.jui.CJuiDialog');
    }
}
