<?php
/* @var $this UserController */
/* @var $model User */


$user_id = Yii::app()->user->id;
//$this->layout='column2';
if (Yii::app()->user->isAdmin || Yii::app()->user->isSuperAdmin) {
    $this->renderPartial("/common/_left_menu");
}

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Customers</h1>

<p>
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'user-grid',
    'dataProvider' => $model->searchCustomer(),
    'filter' => $model,
    'columns' => array(
        array(
            'name' => 'user_email',
            'type' => 'Raw',
            'value' => '$data->user_email',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            )
        ),
        array(
            'name' => 'status_id',
            'type' => 'Raw',
            'value' => '($data->status_id==1)?$data->status->title:"Inactive"',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            )
        ),
        array(
            'name' => 'city_id',
            'type' => 'Raw',
            'value' => '!empty($data->city)?$data->city->city_name:""',
            //'value' => '$data->city_id',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            )
        ),
        /*
          'activation_key',
          'is_active',
          'site_id',
         */
        array(
            'class' => 'CLinkColumn',
            'label' => 'view',
            'urlExpression' => 'Yii::app()->createUrl("/customer/ordersList",array("id"=>$data->user_id,"country" => Yii::app()->session["country_short_name"], "city" => Yii::app()->session["city_short_name"], "city_id" => Yii::app()->session["city_id"]))',
            'header' => 'Purchase History',
        ),
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
?>
