<?php
/* @var $this SectionController */
/* @var $model Section */

$this->breadcrumbs = array(
    'Book' => array('index'),
    'Manage',
);
?>

<h1>Attributes <?php echo $_GET['type']; ?></h1>
<?php
$this->renderPartial("ConfProductAttributes/_form", array("model" => $model));
?>
<?php
$config = array(
    'pagination' => array('pageSize' => 30),
    'sort' => array(
        'defaultOrder' => 'id ASC',
    ),
);
$provider = new CActiveDataProvider("ConfProductAttributes", $config);

$this->widget('zii.widgets.grid.CGridView', array(
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
