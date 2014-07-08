<h1>Misc</h1>
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
            <?php echo $form->labelEx($model, 'title'); ?>
            <?php echo $form->textField($model, 'title', array('maxlength' => 255)); ?>
            <?php echo $form->error($model, 'title'); ?>
        </div>

        <?php
        if ($model->isNewRecord) {
            ?>
            <div class="row">
                <?php echo $form->labelEx($model, 'param'); ?>
                <?php echo $form->textField($model, 'param', array('maxlength' => 255)); ?>
                <?php echo $form->error($model, 'param'); ?>
            </div>
            <?php
        }
        ?>
        <div class="row">
            <?php echo $form->labelEx($model, 'value'); ?>
            <?php
            /**
             * PCM: Make this code proper, because if there are multiple dropdowns
             * then we have to make array for each of it.
             */
            if ($model->field_type == "textArea") {
                echo $form->textArea($model, 'value');
            } else if ($model->field_type == "dropDown") {

                echo $form->dropDownList($model, 'value', $model->paramsOptions[$model->param]);
            } else {
                echo $form->textField($model, 'value');
            }
            ?>

            <?php echo $form->error($model, 'value'); ?>
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
$type = isset($_GET['type']) ? $_GET['type'] : "";
if ($type == "General") {
    $this->PcmWidget['filter'] = array('name' => 'ItstLeftFilter',
        'attributes' => array(
            'model' => ConfMisc::model(),
            'filters' => $this->filters,
            'keyUrl' => true,
            'action' => Yii::app()->createUrl($this->route),
            'grid_id' => 'misc-grid',
    ));
}
$config = array(
    'pagination' => array('pageSize' => 30),
    'sort' => array(
        'defaultOrder' => 'id,city_id ASC',
    ),
    'criteria' => array(
        'condition' => 'misc_type="' . $type . '"',
    )
);
/**
 * is only admin 
 */
if (Yii::app()->user->isAdmin) {
    $config['criteria']['condition'].= ' AND city_id = "' . Yii::app()->session['city_id'] . '"';
}
$provider = new CActiveDataProvider("ConfMisc", $config);
/* Show Grid */
$this->widget('DtGridView', array(
    'id' => 'misc-grid',
    'itemsCssClass' => 'table table-bordered',
    'dataProvider' => $provider, //ConfMisc::model()->search(),
    'columns' => array(
        //'id',
        array(
            'name' => 'title',
            'type' => 'Raw',
            'value' => '$data->title',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            ),
        ),
        array(
            'name' => 'value',
            'type' => 'Raw',
            'value' => 'strlen($data->value)>50?substr($data->value,0,70):$data->value',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            ),
        ),
        array(
            'name' => 'city_id',
            'type' => 'Raw',
            'value' => '!empty($data->city)?$data->city->city_name:""',
            'visible' => isset($_GET['type']) && $_GET['type'] == "general" ? false : true,
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            ),
        ),
        array(
            'name' => 'site_id',
            'type' => 'Raw',
            'value' => '!empty($data->site_id)?$data->site->site_name:""',
            'visible' => isset($_GET['type']) && $_GET['type'] == "general" ? true : false,
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
                    'url' => 'Yii::app()->controller->createUrl(isset( $_GET["type"]) &&  $_GET["type"] == "general"?"general":"load", array("m" => "' . $m . '", "id"=> $data->id,"type"=>$data->misc_type))',
                ),
            ),
        ),
    ),
));
?>
