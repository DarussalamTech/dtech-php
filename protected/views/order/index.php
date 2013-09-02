<?php
/* @var $this OrderController */
/* @var $model Order */

$this->breadcrumbs = array(
    'Orders' => array('index'),
    'Manage',
);

if (!(Yii::app()->user->isGuest)) {
    $this->renderPartial("/common/_left_single_menu");
}

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#order-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Orders</h1>

<p>
    <b>Information:</b>
    <br/>
    If Order Status changes Completed to Declined = Then Quantity will be reverted to Products
    <br/>
    If Order Status changes process to Completed = Then Quantity will be decreased to Products
</p>

<?php

echo CHtml::openTag("div", array(
    "class" => "flash-success",
    "id" => 'flash-message',
    "style" => "display:none"
));

echo CHtml::closeTag("div");
?>

<?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$template = "";
if (isset($this->OpPermission[ucfirst($this->id) . ".View"]) && $this->OpPermission[ucfirst($this->id) . ".View"]) {
    $template.= "{view}";
}
if (isset($this->OpPermission[ucfirst($this->id) . ".Update"]) && $this->OpPermission[ucfirst($this->id) . ".Update"]) {
    $template.= "{update}";
}
if (isset($this->OpPermission[ucfirst($this->id) . ".Delete"]) && $this->OpPermission[ucfirst($this->id) . ".Delete"]) {
    //$template.= "{delete}";
}
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'order-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'order_id',
        array(
            'name' => 'user_id',
            'value' => '!empty($data->user->user_email)?$data->user->user_email:""',
        ),
        'transaction_id',
        'order_date',
        'update_time',
        array(
            'name' => 'payment_method_id',
            'value' => '!empty($data->paymentMethod->name)?$data->paymentMethod->name:""',
        ),
        array(
            'name' => 'status',
            'value' => '$data->listing_status',
            'type' => 'raw',
            'visible' => $this->OpPermission['Order.Update'] == true ? true : false,
        ),
        array(
            'header' => 'update Status',
            'value' => 'CHtml::checkBox("Order[notifyUser]").
                       CHtml::link("Notify User","javascript:void(0)",array("onclick"=>"dtech.updateNotifyCheckBox(this)"))." ".
                       CHtml::link("Update",
                                    Yii::app()->controller->createUrl("/order/update",array("id"=>$data->order_id)),array("onclick"=>"dtech.notifyUser(this);return false;"))',
            'type' => 'raw',
            'visible' => $this->OpPermission['Order.Update'] == true ? true : false,
            'htmlOptions' => array("width" => "100")
        ),
        array(
            'name' => 'total_price',
            'value' => 'Yii::app()->session["currency"]." ".$data->total_price',
            'htmlOptions' => array("width" => "60")
        ),
        array(
            'class' => 'CLinkColumn',
            'label' => 'View Detail',
            'header' => 'History',
            'urlExpression' => 'Yii::app()->controller->createUrl("/order/orderDetail",array("id"=>$data->order_id))',
            'linkHtmlOptions' => array(
                "onclick" => '
                    $("#loading").show();
                    ajax_url = $(this).attr("href");
                    user_name = $(this).parent().prev().prev().prev().prev().prev().prev().html();
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
        array(
            'class' => 'CButtonColumn',
            'template' => $template
        ),
    ),
));
?>
<div id="order_detail"></div>

