<?php
$relationName = "productProfilelangs";
$mName = "ProductProfileLang";
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
        <?php echo CHtml::activeLabelEx($model, 'title'); ?>
        <?php
        echo CHtml::activeTextField($model, 'title')
        ?>
        <?php echo CHtml::error($model, 'title'); ?>
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
            'condition' => 'product_profile_id=' . $id." AND lang_id <>'en'",
        )
    );

    $mNameobj = new $mName;
    $mName_provider = new CActiveDataProvider($mName, $config);
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => $mName . '-grid',
        'dataProvider' => $mName_provider,
        'columns' => array(
            array(
                'name' => 'title',
                'value' => '$data->title',
                "type" => "raw",
            ),
            array(
                'name' => 'lang_id',
                'value' => '$data->lang_id',
                "type" => "raw",
            ),
 
            array
                (
                'class' => 'CButtonColumn',
                'template' => '{update} {delete} ',
                'buttons'=>array(
                    'update'=>array(
                        'url'=>'Yii::app()->controller->createUrl("/product/profileLanguage",array("id"=>$data->product_profile_id,"lang_id"=>$data->id))'
                    ),
                    'delete'=>array(
                        'url'=>'Yii::app()->controller->createUrl("/product/profileLanguageDelete",array("id"=>$data->id))'
                    ),
                )
            ),
        ),
    ));
    ?>
</div>
<div class="clear"></div>

