<?php
/* @var $this ProductController */
/* @var $model Product */
/* @var $form CActiveForm */
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/form.css');
?>
<h1>Make Slider</h1>
<div class="wide form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
        'method' => 'post',
    ));
    ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'title'); ?>
        <?php echo $form->textField($model, 'title', array("style" => "width:350px")); ?>
        <?php echo $form->error($model, 'title'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'image'); ?>
        <?php echo $form->fileField($model, 'image'); ?>
        image Size 222X332
        <?php echo $form->error($model, 'image'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'product_id'); ?>
        <?php echo $form->textField($model, 'product_name'); ?>
        <?php echo $form->error($model, 'product_id'); ?>
    </div>

    <?php echo $form->hiddenField($model, 'product_id'); ?>
    <?php
    $this->renderPartial("/common/_city_field", array("form" => $form, "model" => $model, "cityList" => $cityList));
    ?>

    <div class="row">
        <label>&nbsp;</label>
        <?php
        if (!empty($model->title)) {
            echo $model->title;
        }
        ?>
    </div>
    <div class="row">
        <label>&nbsp;</label>
        <?php
        if (!empty($model->image)) {
            echo CHtml::image(Yii::app()->baseUrl . "/uploads/slider/" . $model->id . "/" . $model->image);
        }
        ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Save', array("class" => "btn")); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->