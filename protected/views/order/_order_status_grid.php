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

$this->widget('DtGridView', array(
    'id' => 'OrderHistory-grid',
    'dataProvider' => $mName_provider,
    'columns' => array(

        array(
            'name' => 'create_time',
            'value' => '$data->create_time',
            "type" => "raw",
            'htmlOptions'=>array("width"=>"200")
        ),
        array(
            'name' => 'status',
            'value' => '$data->order_status->title',
            "type" => "raw",
        ),
        array(
            'name' => 'comment',
            'value' => '$data->comment',
            'htmlOptions'=>array("width"=>"200"),
            "type" => "raw",
        ),
        array(
            'name' => 'is_notify_customer',
            'value' => '$data->is_notify_customer ==1?"Yes":"No"',
            "type" => "raw",
        ),
        array(
            'name' => 'service_charges',
            'value' => '$data->service_charges',
            "type" => "raw",
        ),
    ),
));
?>

