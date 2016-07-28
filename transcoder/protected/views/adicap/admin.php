<?php
$this->pageTitle = Yii::app()->name;
/* @var $this AdicapController */
/* @var $modelForm codeForm */
?>

<h2>Traduction d'un code ADICAP</h2>

<div style='border-style: solid;border-width: 1px;border-color: blue;width:100%; margin : '>
    <h6>Entrez le code ADICAP à traduire.</h6>
    Le code obligatoire peut être composé de :<br>
    - 2 caractères : code organe. Exemple : FF .<br>
    - 4 caractères : code lesion. Exemple : 7730 .<br>
    - 6 caractères : code organe + code lesion. Exemple : FF7730 .<br>
    - 8 caractères : code complet Exemple : BHFF7730 .<br><br>
    Le code facultatif est composé de 7 caractères. En cas de caractères manquants, les remplacer par des *.
    Exemple : **LR*RP .


</div>


<div id="search-form" style="text-align: center;margin : 5px;">
    <?php
    $this->renderPartial('_searchWithAdicap', array(
        'modelForm' => $modelForm,
    ));
    ?>
</div><!-- search-form -->
<h3>Résultat de la traduction :</h3>


<?php
$completeTranslation = null;
$dataResume = array();
if (isset($datas)) {
    $completeTranslation = true;
    foreach ($datas as $data) {
        if (isset($data[1]))
            if (isset($data[1]->cIMMASTERs[0]) || isset($data[1]->cIMOMORPHOs[0])) {
                $dataResume[$data[0]] = array($data[1]->CODE,
                    isset($data[1]->cIMMASTERs[0]) ?
                            $data[1]->cIMMASTERs[0]->code : $data[1]->cIMOMORPHOs[0]->CODE,
                    isset($data[1]->cIMMASTERs[0]) ?
                            '(CIM-O-3 : topographie)' : '(CIM-O-3 : morphologie)');
            } else {
                // $completeTranslation = false;
            }
    }
    if (
            ($datas['organe'][1] != null) && (!isset($dataResume['organe'])) ||
            ($datas['tumPrim'][1] != null) && (!isset($dataResume['tumeur primitive'])) ||
            ($datas['topoComp'][1] != null) && (!isset($dataResume['topographie complémentaire'])) ||
            ($datas['lesion'][1] != null) && (!isset($dataResume['lesion']))
    )
        $completeTranslation = false;
}
if (!empty($dataResume) && $completeTranslation) {
    $codeTraduit = "";
    ?>

    <div class='result'>
        <div class='successSummary' >
    <?php
    echo "<h5>Le code fourni a été traduit en entier.</h5>"
    . "<h6>Traduction : </h6>";
    echo'<table>';
    while (list($name, $value) = each($dataResume)) {

        echo "<tr><td width='25%'>$name : </td><td width='25%'> $value[0]</td><td width='10%'>  =>  </td><td width='40%'>$value[1] $value[2]</td></tr><br>";
    }
    echo'</table>';
    ?>
        </div></div><?php
        } elseif (!empty($dataResume) && !$completeTranslation) {
            $codeTraduit = "";
            ?>

    <div class='result'>
        <div class='partialSummary' >
    <?php
    echo "<h5>Le code n'a pas pu être traduit en entier.</h5>"
    . "<h6>Traduction partielle : </h6>";
    echo'<table>';
    while (list($name, $value) = each($dataResume)) {

        echo "<tr><td width='25%'>$name : </td><td width='25%'> $value[0]</td><td width='10 %'>  =>  </td><td width='40%'>$value[1] $value[2]</td></tr><br>";
    }
    echo'</table>';
    ?>
        </div></div><?php
        } elseif (empty($dataResume)) {
            if (isset($modelForm->codeOblig) || isset($modelForm->codeFacult)) {
                if ($modelForm->codeOblig != null || $modelForm->codeFacult != null) {
                    ?>

            <div class='result'>
                <div class='errorSummary' >
            <?php
            echo "<h5>Le code fourni ne peut être traduit, même partiellement.</h5>";
            ?>
                </div></div><?php
                } else {
                    ?>

            <div class='result'>
                <div class='errorSummary' >
            <?php
            echo "<h5>Veuillez entrer un code à traduire.</h5>";
            ?>
                </div></div><?php
                }
            }
        }
        ?>
<br>
<div class='result'>
    <h3>Détail de la traduction :</h3>

<?php
if (isset($datas))
    foreach ($datas as $data) {

        $result['dataName'] = $data[0];
        $result['dataValue'] = $data[1];

        $this->renderPartial('_displayModelTraduction', $result);
    };
?>

</div>