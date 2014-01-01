<h1>Tax Rates</h1>
<?php
$this->renderPartial("confTaxRates/_form", array("model" => $model));
?>
<?php
$config = array(
    'pagination' => array('pageSize' => 30),
    'sort' => array(
        'defaultOrder' => 'id ASC',
    ),
    'criteria' => array(
        'condition' => 'city_id = ' . Yii::app()->session['city_id']
    )
);
$provider = new CActiveDataProvider("ConfTaxRates", $config);

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'conf-currency-grid',
    'dataProvider' => $provider,
    'columns' => array(
        'title', 'price_level', 'tax_rate', '_calulated_rate', 'rate_type',
        array(
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',
            'buttons' => array
                (
                'update' => array
                    (
                    'label' => 'update',
                    'url' => 'Yii::app()->controller->createUrl("load", array("m" => "' . $m . '", "id"=> $data->id))',
                ),
                'delete' => array
                    (
                    'label' => 'delete',
                    'url' => 'Yii::app()->controller->createUrl("deleteOther", array("m" => "' . $m . '", "id"=> $data->id))',
                ),
            ),
        ),
    ),
));
?>
