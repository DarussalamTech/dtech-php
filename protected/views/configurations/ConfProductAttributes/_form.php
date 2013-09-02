<?php
/* @var $this SectionController */
/* @var $model Section */
/* @var $form CActiveForm */
?>

<div class="form wide">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'product-conf-form',
        'enableAjaxValidation' => false,
            ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <div class="row">
        <?php echo $form->labelEx($model, 'title'); ?>
        <?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 1000)); ?>
        <?php echo $form->error($model, 'title'); ?>
    </div>
    
    <?php
        echo $form->hiddenField($model, "type",array("value"=>isset($_GET['type'])?$_GET['type']:""));
    ?>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array("class" => "btn"));
        ?>
        <?php
        echo CHtml::link("Cancel", array("load","m"=>"ProductAttributes"));
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->