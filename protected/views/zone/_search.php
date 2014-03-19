<?php
/* @var $this ZoneController */
/* @var $model Zone */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    ));
    ?>



    <div class="row">
        <?php echo $form->label($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 255)); ?>
    </div>



    <div class="row buttons">
        <?php echo CHtml::submitButton('Search',array("class"=>"btn")); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->