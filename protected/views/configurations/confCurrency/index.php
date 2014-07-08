<h1>Currency Rates</h1>

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

$this->renderPartial("confCurrency/_form", array("model" => $model));
?>
<?php
$config = array(
    'pagination' => array('pageSize' => 30),
    'sort' => array(
        'defaultOrder' => 'id ASC',
    ),
    'criteria' => array(
    )
);
$provider = new CActiveDataProvider("ConfCurrency", $config);

$this->widget('DtGridView', array(
    'id' => 'conf-currency-grid',
    'dataProvider' => $provider,
    'columns' => array(
        'name', 'symbol',
        array(
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',
            'buttons' => array
                (
                'update' => array
                    (
                    'label' => 'update',
                    'url' => 'Yii::app()->controller->createUrl("load", array("m" => "' . $m . '", "id"=> $data->id,"type"=>""))',
                ),
                'delete' => array
                    (
                    'label' => 'delete',
                    'url' => 'Yii::app()->controller->createUrl("deleteGeneral", array("m" => "' . $m . '", "id"=> $data->id,"type"=>""))',
                ),
            ),
        ),
    ),
));
?>
