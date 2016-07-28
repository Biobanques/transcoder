<?php
/* @var $this AdicapController */
/* @var $modelForm CodeForm */
/* @var $form CActiveForm */
?>
<div class="form" style="text-align: center">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => $this->createUrl('adicap/admin'),
    ));
    ?>
    <div class="row"><?php
        echo $form->error($modelForm, 'codeObligLength');
         echo $form->error($modelForm, 'codeFacultLength');?>
        <div style="width:48%;float:left;text-align: right">
            <div style="float:right;">
                <?php
                
                echo $form->labelEx($modelForm, 'codeOblig',array("style"=>"text-align:center"));
                echo $form->textField($modelForm, 'codeOblig', array('size' => 8, 'maxlength' => 8));
                ?>  
            </div>    
        </div>              
        <div style="width:48%;float:right;text-align: left">

<div style="float:left;">

            <?php
            echo $form->labelEx($modelForm, 'codeFacult',array("style"=>"text-align:center"));
            echo $form->textField($modelForm, 'codeFacult', array('size' => 8, 'maxlength' => 7));
            ?></div>
             </div>  
    </div>


<div style="width: 100%">
    <?php echo CHtml::SubmitButton('Traduire'); ?>

</div>
<?php $this->endWidget(); ?>
</div><!-- search-form -->