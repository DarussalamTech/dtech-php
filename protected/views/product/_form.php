<?php
/* @var $this ProductController */
/* @var $model Product */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/gridform.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/functions.js');
?>

<div class="form wide">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'product-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php
    echo $form->errorSummary($model);
    ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'product_name'); ?>
        <?php echo $form->textField($model, 'product_name', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'product_name'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'parent_cateogry_id'); ?>
        <?php
        $criteria = new CDbCriteria();
        $criteria->addCondition("parent_id = 0");
        $criteria->select = "category_id,category_name";
        $criteria->addCondition("city_id =" . Yii::app()->session['city_id']);
        $criteria->order = " FIELD(category_name ,'Books') DESC ";
        $categories = Categories::model()->findAll($criteria);
        echo $form->dropDownList($model, 'parent_cateogry_id', array(""=>"Select")+CHtml::listData($categories, "category_id", "category_name"), 
                array(
                        "onchange" => "dtech.showProductChildren(this)",
                        "onclick" =>"dtech.preserveOldVal(this)"
                        
                    )
        );
        ?>
        <?php echo $form->error($model, 'parent_cateogry_id'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'product_description'); ?>
        <?php echo $form->textArea($model, 'product_description', array('cols' => 81, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'product_description'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'is_featured'); ?>
        <?php echo $form->dropDownList($model, 'is_featured', array('1' => 'Yes', '0' => 'No'), array('size' => 1, 'maxlength' => 1)); ?>
        <?php echo $form->error($model, 'is_featured'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'city_id'); ?>
        <?php echo $form->dropDownList($model, 'city_id', $cityList, array('prompt' => 'Select city')); ?>
        <?php echo $form->error($model, 'city_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'authors'); ?>
        <?php echo $form->dropDownList($model, 'authors', $authorList, array('prompt' => 'Select Author')); ?>
        <?php echo $form->error($model, 'authors'); ?>
    </div>

    <?php
    if ($this->action->id != "update") {
        $this->renderPartial('educationToys/_container', array('model' => $model, "type" => "field"));
        $this->renderPartial('quranProfile/_container', array('model' => $model, "type" => "field"));
        $this->renderPartial('other/_container', array('model' => $model, "type" => "field"));
        $this->renderPartial('productProfile/_container', array('model' => $model, "type" => "field"));
        $this->renderPartial('productCategories/_container', array('model' => $model, "type" => "field"));
        $this->renderPartial('discount/_container', array('model' => $model, "type" => "field"));
    }
    ?>


    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array("class" => "btn")); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->