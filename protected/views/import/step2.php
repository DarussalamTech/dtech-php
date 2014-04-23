<div class="pading-bottom-5">
    <div class="left_float">
        <h1>Step 2 Select City And Excel Sheet</h1>
    </div>


</div>
<div class="clear"></div>

<div class="form wide">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'language-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'city_id'); ?>
        <?php echo $form->dropDownList($model, 'city_id',
                CHtml::listData(City::model()->findAll(),"city_id","city_name"));
                   
                ?>
        <?php echo $form->error($model, 'city_id'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model, 'sheet'); ?>
        <?php echo $form->dropDownList($model, 'sheet',array(""=>"Select")+$sheets); ?>
        <?php echo $form->error($model, 'sheet'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Save', array("class" => "btn")); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->