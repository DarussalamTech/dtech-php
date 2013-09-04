<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'order-grid',
    'dataProvider' => $model->search(),
    'columns' => array(
         'create_time',
         'quantity',
         array(
                "name"=>"reverted_to_stock",
                'value'=>'($data->reverted_to_stock==1)?"Yes":"No"'
             ),
       
        
    ),
));
?>

