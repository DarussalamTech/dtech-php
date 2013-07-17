<?php
$relationName = "productlangs";
$mName = "ProductLang";
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/gridform.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/functions.js');
?>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'product-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
        ));
?>
<div class="form wide">

    <div class="row">
        <?php echo CHtml::activeLabelEx($model, 'product_name'); ?>
        <?php
        echo CHtml::activeTextField($model, 'product_name')
        ?>
        <?php echo CHtml::error($model, 'product_name'); ?>
    </div>

    <div class="clear"></div>


    <div class="row">
        <?php echo CHtml::activeLabelEx($model, 'product_overview'); ?>
        <?php
        echo CHtml::activeTextArea($model, 'product_overview')
        ?>
        <?php echo CHtml::error($model, 'product_overview'); ?>
    </div>

    <div class="clear"></div>

    <div class="row">
        <?php echo CHtml::activeLabelEx($model, 'lang_id'); ?>
        <?php
        echo CHtml::activeDropDownList($model, 'lang_id', array("ar" => "Arabic"));
        ?>
        <?php echo CHtml::error($model, 'lang_id'); ?>
    </div>

    <div class="clear"></div>
    <div class="row">
        <?php echo CHtml::activeLabelEx($model, 'product_description'); ?>
        <?php
        $this->widget('application.extensions.tinymce.ETinyMce', array(
            'editorTemplate' => 'full',
            'model' => $model,
            'attribute' => 'product_description',
            'options' => array('theme' => 'advanced')));
        ?>
        <?php echo CHtml::error($model, 'product_description'); ?>
    </div>
    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array("class" => "btn")); ?>
        <?php
        echo " or ";
        echo CHtml::link('Cancel', '#', array('onclick' => 'dtech.go_history()'));
        ?>
    </div>
</div>
<?php $this->endWidget(); ?>
<div class="block">
    <?php
    $config = array(
        'criteria' => array(
            'condition' => 'product_id=' . $id." AND lang_id <>'en'",
        )
    );

    $mNameobj = new $mName;
    $mName_provider = new CActiveDataProvider($mName, $config);
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => $mName . '-grid',
        'dataProvider' => $mName_provider,
        'columns' => array(
            array(
                'name' => 'product_name',
                'value' => '$data->product_name',
                "type" => "raw",
            ),
            array(
                'name' => 'lang_id',
                'value' => '$data->lang_id',
                "type" => "raw",
            ),
            array(
                'name' => 'product_overview',
                'value' => '$data->product_overview',
                "type" => "raw",
            ),
            array(
                'name' => 'product_description',
                'value' => '$data->product_description',
                "type" => "raw",
            ),
            array
                (
                'class' => 'CButtonColumn',
                'template' => '{update} {delete} ',
                'buttons'=>array(
                    'update'=>array(
                        'url'=>'Yii::app()->controller->createUrl("/product/language",array("id"=>$data->product_id,"lang_id"=>$data->id))'
                    ),
                    'delete'=>array(
                        'url'=>'Yii::app()->controller->createUrl("/product/languageDelete",array("id"=>$data->id))'
                    ),
                )
            ),
        ),
    ));
    ?>
</div>
<div class="clear"></div>

