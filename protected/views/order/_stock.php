<?php
/* @var $this ProductController */
/* @var $model Product */
/* @var $form CActiveForm */
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/form.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/packages/jui/js/jquery.js');
?>
<h1>Update Stock 
    <span id="result" style="margin-left:10px"></span>
</h1>
<div class="wide form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'htmlOptions' => array('enctype' => 'multipart/form-data', "id" =>
            "revert_stock_form"),
        'method' => 'post',
    ));
    ?>
    <div class="error_status">
        <?php
        ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'order_date'); ?>
        <?php echo $model->order->order_date; ?>

    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'product_name'); ?>
        <?php echo $model->product_profile->product->product_name; ?>
    </div>
    <?php
    $images = $model->product_profile->getImage();
    if (!empty($images[0]['image_small'])):
        ?>
        <div class="row">
            <?php echo $form->labelEx($model, 'product_image'); ?>
            <?php echo CHtml::image($images[0]['image_small']); ?>
        </div>
        <?php
    endif;
    ?>
    <div class="row">
        <?php echo $form->labelEx($sendBackForm, 'order_quantity'); ?>
        <b><?php echo $model->quantity; ?></b>
    </div>
    <div class="row">
        <?php echo $form->labelEx($sendBackForm, 'stock_quanity'); ?>
        <?php echo $form->textField($sendBackForm,'stock_quanity', array("style" => "width:100px")); ?>
        <?php echo $form->error($sendBackForm,'stock_quanity'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($sendBackForm, 'notify'); ?>
        <?php echo $form->checkBox($sendBackForm,'notify'); ?>
        <?php echo $form->error($sendBackForm,'notify'); ?>
    </div>

    <div class="row buttons">
        <?php
        echo CHtml::Button('Back to Stock', array("class" => "btn",
            "onclick" => '
                      if(confirm("Are you sure you want to do revert this line item to actual stock")){
                            jQuery("#loading").show();
                            jQuery("#result").html("Saving...");
                             $.ajax({
                                   type: "POST",
                                   url: jQuery("#revert_stock_form").attr("action"),
                                   jQuery("#revert_stock_form").serialize(), , 
                                   success: function(data)
                                   {
                                       jQuery("#cboxLoadedContent").html(data);
                                       jQuery("#loading").hide();
                                       
                                       if(jQuery.trim(jQuery(".error_status").html())==""){
                                           jQuery("#result").html("Stock has been updated.. plase wait your page has been redirected");
                                           setInterval(function() {
                                           location.reload();
                                           }, 10 * 1000);

                                       }
                                   }
                                 })
                      }
                   
            
                '));
        ?>

    </div>


<?php $this->endWidget(); ?>
</div>
