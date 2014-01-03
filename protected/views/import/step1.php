<div class="pading-bottom-5">
    <div class="left_float">
        <h1>Step 1 Upload File</h1>
    </div>


</div>
<div class="clear"></div>
<div class="form wide">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'import-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'upload_file'); ?>
        <?php echo $form->FileField($model, 'upload_file'); ?>
        <?php echo $form->error($model, 'upload_file'); ?>
    </div>


    <div class="row buttons">
        <?php echo CHtml::submitButton('Upload', array("class" => "btn")); ?>
        <?php
        echo " or ";
        echo CHtml::link('Cancel', '#', array('onclick' => 'dtech.go_history()'));
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->