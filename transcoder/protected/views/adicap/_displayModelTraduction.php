


<?php
if (isset($dataValue)) {
    ?><div class='data' style='width: 100%;float:left'><!--Affichage data--><?php
    if (!is_array($dataValue)) {
        if ($dataName == 'organe' || $dataName == 'lesion' || $dataName == 'tumeur primitive' || $dataName == 'topographie complémentaire') {
            ?>
                <h4>Traduction de la partie <b><?php echo $dataName ?></b> du code</h4>
                <table id="<?php echo $dataName ?>">
                    <thead>
                        <tr>
                            <th style="width:50%;text-align: center">
                                Code ADICAP
                            </th>
                            <th style="width:50%;text-align: center">
                                Code CIM-O-3 correspondant
                            </th>
                        </tr>
                    </thead>

                    <?php
                } else {
                    ?>            <h4>Détail de la partie <b><?php echo $dataName ?></b> du code</h4>
                    <table id="<?php echo $dataName ?>">
                        <thead>
                            <tr>
                                <th style="width:100%;text-align: center">
                                    Code ADICAP
                                </th>

                            </tr>
                        </thead>
                        <?php
                    }
                    ?>
                    <tbody>
                        <tr>
                            <td>
                                <?php
                                $attributesAdicap = array(
                                    'CODE',
                                    'LIBELLE',
                                );
                                if (isset($dataValue->aDICAPGROUPE)) {
                                    $attributesAdicap[] = array('label' => "Groupe ADICAP",
                                        'value' => $dataValue->aDICAPGROUPE->NOM);
                                };
                                if (isset($dataValue->aDICAPPARENT)) {
                                    $attributesAdicap[] = array('label' => 'Parent ADICAP',
                                        'value' => 'Code : ' . $dataValue->aDICAPPARENT->CODE . ' - Libellé : ' . $dataValue->aDICAPPARENT->LIBELLE);
                                }

                                $this->widget('zii.widgets.CDetailView', array(
                                    'data' => $dataValue,
                                    'attributes' => $attributesAdicap,));
                                ?>
                            </td>
                            <td>
                                <?php
                                $attributesCim = array();
                                if (isset($dataValue->cIMMASTERs[0])) {
                                    $attributesCim[] = array('label' => 'Code CIM-O-3', 'type' => 'raw', 'value' => CHtml::link($dataValue->cIMMASTERs[0]->code, $this->createUrl($this->route), array('onclick' => '$("#detailsPopup' . $dataValue->cIMMASTERs[0]->SID . '").dialog("open");return false;')));
                                    $attributesCim[] = array('label' => 'Libelle CIM-O-3', 'value' => $dataValue->cIMMASTERs[0]->LIBELLE);
                                    $widgetProperties = array(
                                        'id' => $dataValue->cIMMASTERs[0]->getPrimaryKey(),
                                        'model' => $dataValue->cIMMASTERs[0],
                                        'modelType' => 'cimmaster'
                                    );
                                }
                                if ($dataValue->MORPHO != null) {

                                    $attributesCim[] = array(
                                        'label' => 'Morphologie',
                                        'type' => 'raw',
                                        'value' => CHtml::link($dataValue->cIMOMORPHOs[0]->CODE . ' : ' . $dataValue->cIMOMORPHOs[0]->LIBELLE, $this->createUrl($this->route), array('onclick' => '$("#detailsPopup' . $dataValue->cIMOMORPHOs[0]->CIMO_MORPHO_ID . '").dialog("open");return false;'))
                                    );
                                    $widgetProperties = array(
                                        'id' => $dataValue->cIMOMORPHOs[0]->getPrimaryKey(),
                                        'model' => $dataValue->cIMOMORPHOs[0],
                                        'modelType' => 'cimmorpho'
                                    );
                                }
                                if (count($attributesCim) != 0) {
                                    $this->widget('zii.widgets.CDetailView', array(
                                        'data' => $dataValue,
//
                                        'attributes' => $attributesCim,));

                                    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
                                        'id' => 'detailsPopup' . $widgetProperties['id'],
                                        'options' => array(
                                            'autoOpen' => false,
                                            'width' => '800px',
                                            'title' => 'Détail du code ' . ($widgetProperties['modelType'] == 'cimmaster' ? 'CIM-O-3 ' . $widgetProperties['model']->code : 'CIM-O-3 morpho ' . $widgetProperties['model']->CODE),
                                        )
                                    ));
                                    if ($widgetProperties['modelType'] == 'cimmaster')
                                        $this->renderPartial('cimView', array('model' => $widgetProperties['model'], 'withParents' => true));
                                    elseif ($widgetProperties['modelType'] == 'cimmorpho')
                                        $this->renderPartial('morphoView', array('model' => $widgetProperties['model']));

                                    $this->endWidget('zii.widgets.jui.CJuiDialog');
                                } else {
                                    ?>
                                    <div style="text-align:right">
                                        <h5>
                                            <?php
                                            if ($dataName == 'organe' || $dataName == 'lesion' || $dataName == 'tumeur primitive' || $dataName == 'topographie complémentaire')
                                                echo "Pas de correspondance trouvée";
                                            ?></h5></div>
                                <?php }
                                ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <?php
            } elseif (is_array($dataValue) && !empty($dataValue)) {
                ?>
                <h4>Traduction de la partie <b><?php echo $dataName ?></b> du code</h4>
                Aucun résultat trouvé avec le code fourni. Résultats approchants :
                <?php
                $dataProvider = new CArrayDataProvider($dataValue, array(
                    'keyField' => 'CODE',
                    'pagination' => array(
                        'pageSize' => count($dataValue))
                ));

                $this->widget('zii.widgets.grid.CGridView', array(
                    'id' => 'aboutResults',
                    'dataProvider' => $dataProvider,
                    'columns' => array(
                        'CODE',
                        'LIBELLE',
                    ),
                ));
            } else { {
                    ?>
                    <h4>Traduction de la partie <b><?php echo $dataName ?></b> du code</h4>
                    Aucun résultat trouvé avec le code fourni. Aucun résultat approchant.
                    <?php
                }
            }
            ?> </div><?php }
        ?>

<!--Fin Affichage data-->
<!---------------------------------------------------->