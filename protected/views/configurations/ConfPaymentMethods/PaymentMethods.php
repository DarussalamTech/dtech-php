<h1>Payment Methods</h1>
<?php
/*
 * Comment just below if, to enable creating it.
 */
if (!$model->isNewRecord) {
    ?>
    <div class="form wide">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'project-form',
//            'enableAjaxValidation' => true,
        ));
        ?>
        <div class="row">
            <?php echo $form->labelEx($model, 'name'); ?>
            <?php echo $form->textField($model, 'name', array('maxlength' => 255)); ?>
            <?php echo $form->error($model, 'name'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model, 'secret'); ?>
            <?php echo $form->textField($model, 'secret', array('maxlength' => 255)); ?>
            <?php echo $form->error($model, 'secret'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model, 'key'); ?>
            <?php echo $form->textField($model, 'key', array('maxlength' => 255)); ?>
            <?php echo $form->error($model, 'key'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model, 'signature'); ?>
            <?php echo $form->textField($model, 'signature', array('maxlength' => 255)); ?>
            <?php echo $form->error($model, 'signature'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model, 'status'); ?>

            <?php
            echo $form->dropDownList($model, 'status', array('Disable' => 'Disable', 'Enable' => 'Enable'));
            ?>
            <?php echo $form->error($model, 'status'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model, 'sandbox'); ?>

            <?php
            echo $form->dropDownList($model, 'sandbox', array('Disable' => 'Disable', 'Enable' => 'Enable'));
            ?>
            <?php echo $form->error($model, 'sandbox'); ?>
        </div>



        <div class="row buttons">
            <?php
            echo CHtml::submitButton($model->isNewRecord ? 'Create New' : 'Update Existing', array('class' => 'btn btn btn-primary'));
            echo " or ";
            echo CHtml::link('Cancel', array('load', 'm' => $m));
            ?>
        </div>
        <?php $this->endWidget(); ?>
    </div>
    <?php
}
?>
<?php
$config = array(
    'pagination' => array('pageSize' => 30),
    'sort' => array(
        'defaultOrder' => 'id ASC',
    )
);
$provider = new CActiveDataProvider("ConfPaymentMethods", $config);
/* Show Grid */
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'misc-grid',
    'itemsCssClass' => 'table table-bordered',
    'dataProvider' => $provider, //ConfMisc::model()->search(),
    'columns' => array(
        //'id',
        array(
            'name' => 'name',
            'type' => 'Raw',
            'value' => '$data->name',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            ),
        ),
        array(
            'name' => 'status',
            'type' => 'Raw',
            'value' => '$data->status',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            ),
        ),
        array(
            'name' => 'sandbox',
            'type' => 'Raw',
            'value' => '$data->sandbox',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            ),
        ),
        array(
            'name' => 'City',
            'type' => 'Raw',
            'value' => '$data->city_rel->city_name',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            ),
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{update}',
            'buttons' => array
                (
                'update' => array
                    (
                    'label' => 'update',
                    'url' => 'Yii::app()->controller->createUrl("load", array("m" => "' . $m . '", "id"=> $data->id,"type"=>""))',
                ),
            ),
        ),
    ),
));
?>