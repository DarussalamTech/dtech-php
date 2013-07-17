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
        $criteria->order = " FIELD(t.category_name ,'Books') DESC ";
        $categories = Categories::model()->findAll($criteria);
        echo $form->dropDownList($model, 'parent_cateogry_id', array("" => "Select") + CHtml::listData($categories, "category_id", "category_name"), array(
            "onchange" => "dtech.showProductChildren(this)",
            "onclick" => "
                    dtech.preserveOldVal(this);
                       if( $('#Product_parent_cateogry_id option:selected').text()!='Books'){
                            $('#Product_authors').hide();
                        }
                        else {
                             $('#Product_authors').show();
                        }
                    "
                )
        );
        ?>
        <?php echo $form->error($model, 'parent_cateogry_id'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'product_overview'); ?>
        <?php echo $form->textArea($model, 'product_overview', array("rows" => 4, "cols" => 81, 'style' => 'resize: none; width:300px;height:80px')); ?>
        <?php echo $form->error($model, 'product_overview'); ?>
    </div>




    <div class="row">
        <?php echo $form->labelEx($model, 'product_description'); ?>
        <?php
        $this->widget('application.extensions.tinymce.ETinyMce', array(
            'editorTemplate' => 'full',
            'model' => $model,
            'attribute' => 'product_description',
            'options' => array('theme' => 'advanced')));
        ?>
        <?php //echo $form->textArea($model, 'product_description', array("rows" => 4, "cols" => 81, 'style' => 'resize: none; width:500px;')); ?>
        <?php echo $form->error($model, 'product_description'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'is_featured'); ?>
        <?php echo $form->dropDownList($model, 'is_featured', array('0' => 'No', '1' => 'Yes'), array('size' => 1, 'maxlength' => 1)); ?>
        <?php echo $form->error($model, 'is_featured'); ?>
    </div>

    <?php
    $this->renderPartial("/common/_city_field", array("form" => $form, "model" => $model, "cityList" => $cityList));
    $display = "";
    if(isset($model->parent_category) && $model->parent_category->category_name!="Books"){
        $display = "display:none";
    }
    ?>

    <div class="row" style="<?php echo $display ?>">
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
        <?php
        echo " or ";
        echo CHtml::link('Cancel', '#', array('onclick' => 'dtech.go_history()'));
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->