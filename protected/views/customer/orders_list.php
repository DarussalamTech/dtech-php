<?php
/* @var $this UserController */
/* @var $model User */

$user_id = Yii::app()->user->id;
//$this->layout='column2';
if (Yii::app()->user->isAdmin || Yii::app()->user->isSuperAdmin) {
    $this->renderPartial("/common/_left_single_menu");
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

<h1>Orders List of selected User</h1>


<?php
$this->widget('DtGridView', array(
    'id' => 'order-grid',
    'dataProvider' => $model->search(),
    //'filter' => $model,
    'columns' => array(
        array(
            'name' => 'order_date',
            'type' => 'Raw',
            //'value' => 'if($data->status_id="1")?Active:"Inactive"',
            'value' => '$data->order_date',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            )
        ),
        array(
            'name' => 'city_name',
            'type' => 'Raw',
            //'value' => 'if($data->status_id="1")?Active:"Inactive"',
            'value' => '$data->user->city->city_name',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            )
        ),
        array(
            'name' => 'user_name',
            'type' => 'Raw',
            'value' => '!empty($data->user_id)?$data->user->userProfiles->first_name." ".$data->user->userProfiles->last_name:""',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            )
        ),
        array(
            'name' => 'order_price',
            'type' => 'Raw',
            //'value' => 'if($data->status_id="1")?Active:"Inactive"',
            'value' => '"&dollar;".$data->total_price',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            )
        ),
        array(
            'class' => 'CLinkColumn',
            'label' => 'View Detail',
            'header' => 'Purchase History',
            'urlExpression' => 'Yii::app()->controller->createUrl("/customer/orderDetail",array("id"=>$data->order_id))',
            'linkHtmlOptions' => array(
                "onclick" => '
                    $("#loading").show();
                    ajax_url = $(this).attr("href");
                    user_name = $(this).parent().prev().prev().html();
                    $.ajax({
                        type: "POST",
                        url: ajax_url,
                        data: { username: user_name }
                    }).done(function( msg ) {
                        $("#order_detail").html(msg);
                        $("#loading").hide();
                    });
                    return false;
                    '
            ),
        ),
    ),
));
?>
<div id="order_detail"></div>
