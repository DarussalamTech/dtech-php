<?php
/* @var $this ShippingClassController */
/* @var $model ShippingClass */

$this->breadcrumbs = array(
    'Shipping Classes' => array('index'),
    $model->title,
);

if (!(Yii::app()->user->isGuest)) {
    $this->renderPartial("/common/_left_menu");
}
?>

<h1>View Shipping Class #<?php echo $model->id; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'source_city',
        'destination_city',
        'title',
        'fix_shipping_cost',
        'is_fix_shpping',
        'is_pirce_range',
        'start_price',
        'end_price',
        'min_weight_id',
        'max_weight_id',
        'categories',
        'class_status',
    ),
));
?>
