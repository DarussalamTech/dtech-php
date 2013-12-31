<?php
/* @var $this SectionController */
/* @var $model Section */
/* @var $form CActiveForm */
?>

<div class="form wide">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'currency-form',
        'enableAjaxValidation' => false,
    ));
    ?>
    <?php echo $form->hiddenField($model, 'city_id', array('value' => Yii::app()->session['city_id'])); ?>
    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <div class="row">
        <?php echo $form->labelEx($model, 'title'); ?>
        <?php echo $form->textField($model, 'title', array('size' => 255,)); ?>
        <?php echo $form->error($model, 'title'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'price_level'); ?>
        <?php echo $form->textField($model, 'price_level', array('size' => 20,)); ?>
        <?php echo $form->error($model, 'price_level'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'tax_rate'); ?>
        <?php echo $form->textField($model, 'tax_rate', array('size' => 20,)); ?>
        <?php echo $form->error($model, 'tax_rate'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'rate_type'); ?>
        <?php
        echo $form->dropDownList($model, 'rate_type', array(
            "flat" => "Flat",
            "percentage" => "Percentage",
                )
        );
        ?>
        <?php echo $form->error($model, 'rate_type'); ?>
    </div>


    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array("class" => "btn"));
        ?>
        <?php
         echo CHtml::link('Cancel', array('load', 'm' => "TaxRates"));
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->