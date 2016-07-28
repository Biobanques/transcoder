
<h1>Documents utiles</h1>
<h4>Vous pouvez à partir de cette section voir les différents documents ayant servi de base pour ce projet.</h4>

<ul>
    <?php
    $folder == null ? $path = Yii::app()->params->docsPath : $path = Yii::app()->params->docsPath . "/$folder";
    $listFiles = scandir($path);

    foreach ($listFiles as $file) {
        if ($file != '.' && $file != '..') {
            if (!is_dir(Yii::app()->params->docsPath . $file)) {

                echo '<li>' . CHtml::link($file, Yii::app()->createUrl('site/download', array('file' => $file))) . '</li>';
            } else {
                echo '<li>' . CHtml::link("&ltREP&gt  $file  &ltREP&gt", Yii::app()->createUrl('site/docs', array('file' => $file))) . '</li>';
            }
        }
    }
    ?>
</ul>