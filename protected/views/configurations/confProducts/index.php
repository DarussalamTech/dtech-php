<?php
/* @var $this SectionController */
/* @var $model Section */

$this->breadcrumbs = array(
    'Book' => array('index'),
    'Manage',
);
?>
<div class="pading-bottom-5">
    <div class="left_float">
        <h1>[Product Or Book] <?php echo isset($_GET['type'])?$_GET['type']:""; ?></h1>
    </div>

    <?php /* Convert to Monitoring Log Buttons */ ?>
    <div class = "right_float">

    </div>
</div>
<div class="clear"></div>
<?php
if (Yii::app()->user->hasFlash('success')) {
    echo CHtml::openTag("div", array("class" => "flash-success"));
    echo Yii::app()->user->getFlash("success");
    echo CHtml::closeTag("div");
}
echo '<div class="clear"></div>';
if (Yii::app()->user->hasFlash('errorIntegrity')) {
    echo CHtml::openTag("div", array("class" => "flash-error"));
    echo Yii::app()->user->getFlash("errorIntegrity");
    echo CHtml::closeTag("div");
}
echo '<div class="clear"></div>';

$this->renderPartial("confProducts/_form", array("model" => $model));
?>
<?php

$config = array(
    'pagination' => array('pageSize' => 30),
    'sort' => array(
        'defaultOrder' => 'id ASC',
    ),
    'criteria' => array(
        'condition' => 'type="' . $_GET['type'].'"',
    )
);
$provider = new CActiveDataProvider("ConfProducts", $config);

$this->widget('DtGridView', array(
    'id' => 'conf-products-grid',
    'dataProvider' => $provider,
    'columns' => array(
        'title',
        array(
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',
            'buttons' => array
                (
               'update' => array
                    (
                    'label' => 'update',
                    'url' => 'Yii::app()->controller->createUrl("load", array("m" => "' . $m . '", "id"=> $data->id,"type"=>$data->type))',
                ),
               'delete' => array
                    (
                    'label' => 'update',
                    'url' => 'Yii::app()->controller->createUrl("deleteOther", array("m" => "' . $m . '", "id"=> $data->id,"type"=>$data->type))',
                ),
    
            ),
        ),
    ),
));
?>
