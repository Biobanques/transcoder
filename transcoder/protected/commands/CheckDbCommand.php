<?php

/**
 * Calcul des statistiques par biobanques pour le benchmarking.
 * Insertion des resultats dans la base de données
 *
 */
class CheckDbCommand extends CConsoleCommand
{

    public function run($args) {
        echo Yii::app()->db->connectionString . "\n";
        echo Yii::app()->db->username . "\n";
        echo Yii::app()->db->password . "\n";
        print_r(Yii::app()->db);
        Yii::app()->db->beginTransaction();
        echo Yii::app()->db->active;
    }

}
?>