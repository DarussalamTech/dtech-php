<div class="pading-bottom-5">
    <div class="left_float">
        <h1>Mapping List</h1>
    </div>


</div>
<div class="clear"></div>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'shipping-class-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        array(
            'name' => 'file_name',
            'value' => '$data->file_name',
            'type' => 'raw'
        ),
        array(
            'header' => 'Percentage Completed',
            'value' => '$data->completed_steps!=0?$data->completed_steps * 100 / $data->total_steps:0',
            'type' => 'raw'
        ),
        array(
            'name' => 'total_steps',
            'value' => '$data->total_steps',
            'type' => 'raw'
        ),
        array(
            'name' => 'completed_steps',
            'value' => '$data->completed_steps',
            'type' => 'raw'
        ),
        array(
            'name' => 'sheet',
            'value' => '$data->sheet',
            'type' => 'raw'
        ),
        array(
            'name' => 'city',
            'value' => 'isset($data->city) ? $data->city->city_name : ""',
            'type' => 'raw'
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{view}',
            'buttons' => array(
                'view' => array(
                    'url' => 'Yii::app()->controller->createUrl("/import/status",array("id"=>$data->id))',
                ),
            )
        )
    ),
));
?>