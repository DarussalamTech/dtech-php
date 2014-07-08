<?php
$this->widget('DtGridView', array(
    'id' => 'order-grid',
    'dataProvider' => $model->search(),
    'columns' => array(
         'create_time',
         'quantity',
         array(
                "name"=>"reverted_to_stock",
                'value'=>'($data->reverted_to_stock==1)?"Yes":($data->reverted_to_stock==0)?"No":"Yes"'
             ),
       
        
    ),
));
?>

