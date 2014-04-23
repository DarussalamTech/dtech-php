<div class="pading-bottom-5">
    <div class="left_float">
        <h1>Create Folder</h1>
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
        'id' => 'notifcation-folder-form',
        'enableAjaxValidation' => false,
    ));
    ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name'); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>
    <div class="row buttons">
        <?php
        echo CHtml::submitButton($model->isNewRecord ? 'Save' : 'Save', array(
            "class" => "btn",
            "onclick" => '
                                 $.ajax({
                                    type: "POST",
                                    url: $("#notifcation-folder-form").attr("action"),
                                    data: $("#notifcation-folder-form").serialize(), 
                                    success: function(data)
                                    {
                                        $("#cboxLoadedContent").html(data);
                                        setTimeout(function() {
                                            if($("#cboxLoadedContent .flash-success").length!=0){
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