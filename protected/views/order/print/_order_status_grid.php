<?php

$config = array(
    'criteria' => array(
        'condition' => 'order_id=' . $model->order_id,
        'order'=>'id desc'
    ),
    'pagination' => array(
                'pageSize' => 200,
            ),
);

$mName_provider = new CActiveDataProvider('OrderHistory', $config);

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'OrderHistory-grid',
    'dataProvider' => $mName_provider,
    
    'columns' => array(

        array(
            'name' => 'create_time',
            'value' => '$data->create_time',
            "type" => "raw",
            'htmlOptions'=>array("width"=>"200"),
            'sortable'=>false,
        ),
        array(
            'name' => 'status',
            'value' => '$data->order_status->title',
            "type" => "raw",
            'sortable'=>false,
        ),
        array(
            'name' => 'comment',
            'value' => '$data->comment',
            'htmlOptions'=>array("width"=>"200"),
            "type" => "raw",
            'sortable'=>false,
        ),
        array(
            'name' => 'is_notify_customer',
            'value' => '$data->is_notify_customer ==1?"Yes":"No"',
            "type" => "raw",
            'sortable'=>false,
        ),
    ),
));
?>

