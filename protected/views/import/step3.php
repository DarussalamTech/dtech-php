<div class="pading-bottom-5">
    <div class="left_float">
        <h1>Step 3 Mapping Columns</h1>
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

    <?php
    echo $form->errorSummary($Import);
    ?>

    <div class="row">
        <label style="font-weight: bold;width: 202px">Import Files Columns</label>
        <label style="font-weight: bold;width: 202px">Database Columns</label>
    </div>
    <div class="clear"></div>
    <?php
    $index = 0;
    foreach ($headers as $header):
        ?>
        <div class="row">
            <?php echo $form->dropDownList($Impr_arr[$index], '[' . $index . ']header', array("" => "Select") + $headers); ?>
            <?php echo $form->dropDownList($Impr_arr[$index], '[' . $index . ']dbColumn', array("" => "Select") + $dbColumns); ?>
        </div>

        <?php
        $index++;
    endforeach;
    ?>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Next', array("class" => "btn")); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->