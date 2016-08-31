<?php
$this->pageTitle = Yii::app()->name;
/* @var $this AdicapController */
/* @var $modelForm codeForm */
?>

<h2><?php echo Yii::t('common', 'thanks') ?></h2>
<?php
$cont = Contributors::getContributors();
echo '<ul>';
foreach ($cont as $val)
    echo '<li class = "contrib_name">'
    . $val['name'] .
    '<div class = "contrib_function">' .
    $val['function'] . '</div></li><br>';

echo '</ul>';
?>