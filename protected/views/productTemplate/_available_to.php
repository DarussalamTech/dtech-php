<div class="pading-bottom-5">
    <div class="left_float">
        <h1>Available To City [<?php echo City::model()->findFromPrimerkey($model->to_city)->city_name; ?>]</h1>
    </div>

    <?php /* Convert to Monitoring Log Buttons */ ?>
    <div class = "right_float">

    </div>
</div>
<?php
echo '<div class="clear"></div>';
if (Yii::app()->user->hasFlash('status')) {
    echo CHtml::openTag("div", array("class" => "flash-success"));
    echo Yii::app()->user->getFlash("status");
    echo CHtml::closeTag("div");
}
echo '<div class="clear"></div>';
?>
<div class="form wide color-box-width">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'product-available-form',
        'enableAjaxValidation' => false,
    ));
    ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'message'); ?>
        <?php echo $form->textArea($model, 'message',array("style"=>"width:60%")); ?>
        <?php echo $form->error($model, 'message'); ?>
    </div>
    <div class="row buttons">
        <?php
        echo CHtml::submitButton('Available To', array(
            "class" => "btn",
            "onclick" => '
                                 jQuery.ajax({
                                    type: "POST",
                                    url: jQuery("#product-available-form").attr("action"),
                                    data: jQuery("#product-available-form").serialize(), 
                                    success: function(data)
                                    {
                                        jQuery("#cboxLoadedContent").html(data);
                                        setTimeout(function() {
                                            if(jQuery("#cboxLoadedContent .flash-success").length!=0){
                                                location.reload();
                                            }
                                        }, 1500);
                                       
                                    }
                                  });
                                  
                                  return false;
                            '
        ));
        ?>
    </div>
    <?php $this->endWidget(); ?>
</div>