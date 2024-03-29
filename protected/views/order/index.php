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
$this->PcmWidget['filter'] = array('name' => 'ItstLeftFilter',
    'attributes' => array(
        'model' => $model,
        'filters' => $this->filters,
        'keyUrl' => true,
        'action' => Yii::app()->createUrl($this->route),
        'grid_id' => 'product-grid',
        ));
?>

<h1>Manage Orders</h1>
<div class="row-fluid">
    <div class="span12">
        <?php
            //get available citeis
            
            $criteria = new CDbCriteria;
            $criteria->addInCondition("LOWER(city_name)", array(strtolower("lahore"),strtolower("riyadh")));
            $city_stores = City::model()->getAll($criteria);
            $stor_city = !empty($_GET['store_city'])?$_GET['store_city']:1;
            $current_url = $this->createUrl("/order/index");
            echo "Switch Store : ";
            echo CHtml::dropDownList(
                    "city_select", $stor_city, 
                    CHtml::listData($city_stores,"city_id","city_name"),
                    array("onchange"=>"
                            current_city = jQuery(this).val();
                            window.location = '".$current_url."?store_city='+current_city;
                    ")
                );
           ?>
        
    </div>
</div>

<p>
    <b>Information:</b>
    <br/>
    If Order Status changes Shipped to Cancelled Or Refunded = Then Quantity will be reverted to Products
    <br/>
    If Order Status changes Pending or Process to Shipped = Then Quantity will be decreased to Products
    <br/>
    Completed , Declined or neutral

    <br/><br/>

    Pending > Shipped = Decrease in stock<br/>
    Pending >Process> Shipped = Decrease in stock<br/>
    Shipped > Refund = Increase in stock<br/>
    Shipped > Cancel = Increase in stock<br/>
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
$this->widget('DtGridView', array(
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
            'value' => '$data->order_status->title',
            'type' => 'raw',
        ),
        array(
            'name' => 'service_charges',
            'value' => '$data->service_charges',
            'type' => 'raw',
        ),
        array(
            'header' => 'Change',
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
            'name' => 'shipping_price',
            'value' => 'Yii::app()->session["currency"]." ".$data->shipping_price',
            'htmlOptions' => array("width" => "60")
        ),
        array(
            'name' => 'tax_amount',
            'value' => 'Yii::app()->session["currency"]." ".$data->tax_amount',
            'htmlOptions' => array("width" => "60")
        ),
        array(
            'name' => 'grand_price',
            'value' => 'Yii::app()->session["currency"]." ".$data->grand_price',
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

