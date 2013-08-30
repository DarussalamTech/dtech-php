<?php
/* @var $this ProductController */
/* @var $model Product */
/* @var $form CActiveForm */
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/form.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/packages/jui/js/jquery.js');
?>
<h1>Address <?php echo $address ?>
     <span id="result" style="margin-left:10px"></span>
</h1>
<div class="wide form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'htmlOptions' => array('enctype' => 'multipart/form-data',"id"=>"billing_shipping_form"),
        'method' => 'post',
        
    ));
    /**
     * setting for detucting prefix
     */
    $model_prefix = get_class($model) =="UserOrderBilling"?"billing":"shipping";
    $model_intitial = get_class($model) =="UserOrderBilling"?"b":"s";
    ?>

    <div class="row">
        <?php echo $form->labelEx($model, $model_prefix.'_prefix'); ?>
        <?php echo $form->textField($model, $model_prefix.'_prefix', array("style" => "width:350px")); ?>
        <?php echo $form->error($model, $model_prefix.'_prefix'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, $model_prefix.'_first_name'); ?>
        <?php echo $form->textField($model, $model_prefix.'_first_name', array("style" => "width:350px")); ?>
        <?php echo $form->error($model, $model_prefix.'_first_name'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, $model_prefix.'_last_name'); ?>
        <?php echo $form->textField($model, $model_prefix.'_last_name', array("style" => "width:350px")); ?>
        <?php echo $form->error($model, $model_prefix.'_last_name'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, $model_prefix.'_address1'); ?>
        <?php echo $form->textField($model, $model_prefix.'_address1', array("style" => "width:350px")); ?>
        <?php echo $form->error($model, $model_prefix.'_address1'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, $model_prefix.'_address2'); ?>
        <?php echo $form->textField($model, $model_prefix.'_address2', array("style" => "width:350px")); ?>
        <?php echo $form->error($model, $model_prefix.'_address2'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, $model_prefix.'_country'); ?>
        <?php
        echo $form->dropDownList($model,$model_prefix.'_country', $regionList, array(
            'empty' => 'Please Select Country',
            'ajax' => array(
                'type' => 'POST',
                'url' => $this->createUrl('/web/payment/'.$model_intitial.'statelist'),
                'update' => '#'.get_class($model).'_'.$model_prefix.'_state'
            )
        ));
       
        ?>
        <?php echo $form->error($model, $model_prefix.'_country'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, $model_prefix.'_state'); ?>
        <?php echo $form->dropDownList($model, $model_prefix.'_state', $model->_states); ?>
        <?php echo $form->error($model, $model_prefix.'_state'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, $model_prefix.'_city'); ?>
        <?php echo $form->textField($model, $model_prefix.'_city', array("style" => "width:350px")); ?>
        <?php echo $form->error($model, $model_prefix.'_city'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, $model_prefix.'_zip'); ?>
        <?php echo $form->textField($model, $model_prefix.'_zip', array("style" => "width:350px")); ?>
        <?php echo $form->error($model, $model_prefix.'_zip'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, $model_prefix.'_phone'); ?>
        <?php echo $form->textField($model, $model_prefix.'_phone', array("style" => "width:350px")); ?>
        <?php echo $form->error($model, $model_prefix.'_phone'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, $model_prefix.'_phone'); ?>
        <?php echo $form->textField($model, $model_prefix.'_phone', array("style" => "width:350px")); ?>
        <?php echo $form->error($model, $model_prefix.'_phone'); ?>
    </div>


    <div class="row buttons">
        <?php echo CHtml::Button('Save', array("class" => "btn",
                "onclick"=>'
                      jQuery("#result").html("Saving...");
                      $.ajax({
                            type: "POST",
                            url: jQuery("#billing_shipping_form").attr("action"),
                            data: jQuery("#billing_shipping_form").serialize(), 
                            success: function(data)
                            {
                                jQuery("#cboxLoadedContent").html(data);
                                jQuery("#result").html("");
                            }
                          })
            
                ')); ?>
       
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->