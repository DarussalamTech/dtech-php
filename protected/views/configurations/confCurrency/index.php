<?php
/* @var $this SectionController */
/* @var $model Section */

$this->breadcrumbs = array(
    'Book' => array('index'),
    'Manage',
);
?>

<h1>Book Dimensions</h1>
<?php
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

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'conf-currency-grid',
    'dataProvider' => $provider,
    'columns' => array(
        'name','symbol',
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
                    'url' => 'Yii::app()->controller->createUrl("delete", array("m" => "' . $m . '", "id"=> $data->id,"type"=>""))',
                ),
    
            ),
        ),
    ),
));
?>
