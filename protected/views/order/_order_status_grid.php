<?php

$config = array(
    'criteria' => array(
        'condition' => 'order_id=' . $model->order_id,
        'order'=>'id desc'
    ),
    'pagination' => array(
                'pageSize' => 5,
            ),
);

$mName_provider = new CActiveDataProvider('OrderHistory', $config);

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'OrderHistory-grid',
    'dataProvider' => $mName_provider,
    'columns' => array(

        array(
            'name' => 'status',
            'value' => '$data->status',
            "type" => "raw",
        ),
        array(
            'name' => 'comment',
            'value' => '$data->comment',
            "type" => "raw",
        ),
        array(
            'name' => 'is_notify_customer',
            'value' => '$data->is_notify_customer',
            "type" => "raw",
        ),
    ),
));
?>

