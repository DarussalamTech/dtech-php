<?php
/* @var $this DtMessagesController */
/* @var $model DtMessages */
/* @var $this CategoriesController */
/* @var $model Categories */
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/gridform.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/functions.js');

$this->breadcrumbs = array(
    'Dt Messages' => array('index'),
    $model->id,
);

$this->renderPartial("/common/_left_menu");
?>

<h1>View  Messages #<?php echo $model->id; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'category',
        'message',
    ),
));

$this->renderPartial('messages/_container', array('model' => $model, "type" => "form"));
?>
