<?php
/* @var $this ProductController */
/* @var $model Product */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'post',
    ));
    ?>

   <div class="row">
        <?php echo $form->labelEx($model, 'title'); ?>
        <?php echo $form->textField($model, 'title'); ?>
        <?php echo $form->error($model, 'title'); ?>
    </div>
    
   <div class="row">
        <?php echo $form->labelEx($model, 'image'); ?>
        <?php echo $form->textField($model, 'image'); ?>
        <?php echo $form->error($model, 'image'); ?>
    </div>
    
     <?php echo $form->hiddenField($model, 'product_id'); ?>
     <?php 
     
         $this->renderPartial("/common/_city_field", array("form" => $form, "model" => $model, "cityList" => $cityList));
     ?>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Save', array("class" => "btn")); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->