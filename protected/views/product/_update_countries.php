<?php
/**
 * register script jquery ui
 */
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/packages/jui/css/base/jquery-ui.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/packages/jui/js/jquery-ui.min.js', CClientScript::POS_END);
/**
 * register script for multiselect
 */
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/media/multiselect/ui.multiselect.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/media/multiselect/ui.multiselect.js');
?>
<script type="text/javascript">
    jQuery(function() {

        jQuery(".multiselect").multiselect();

    });
</script>
<div class="form wide" >

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'product-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    ));
    echo $form->hiddenField($model, 'product_id');
    ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'shippable_countries'); ?>

        <?php echo $form->error($model, 'shippable_countries'); ?>
    </div>
    <div class="row">

        <?php
        $criteria = new CDbCriteria;
        $criteria->select = "name";
        $countries = CHtml::listData(Region::model()->findAll($criteria), "name", "name");
        echo $form->dropDownList($model, 'shippable_countries', $countries, array("class" => "multiselect", "multiple" => "multiple"));
        ?>


    </div>
    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array("class" => "btn")); ?>
        <?php
        echo " or ";
        echo CHtml::link('Cancel', '#', array('onclick' => 'dtech.go_history()'));
        ?>
    </div>

    <?php $this->endWidget(); ?>




</div><!-- form -->