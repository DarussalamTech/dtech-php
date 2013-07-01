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
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

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
if(isset($this->OpPermission[ucfirst($this->id).".View"]) && $this->OpPermission[ucfirst($this->id).".View"]){
    $template.= "{view}";
}
if(isset($this->OpPermission[ucfirst($this->id).".Update"]) && $this->OpPermission[ucfirst($this->id).".Update"]){
    $template.= "{update}";
}
if(isset($this->OpPermission[ucfirst($this->id).".Delete"]) && $this->OpPermission[ucfirst($this->id).".Delete"]){
    $template.= "{delete}";
}
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'order-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        array(
            'name' => 'user_id',
            'value' => '!empty($data->user->user_email)?$data->user->user_email:""',
        ),
        'total_price',
        'order_date',
        'status',
        'transaction_id',
        array(
            'name' => 'payment_method_id',
            'value' => '!empty($data->paymentMethod->name)?$data->paymentMethod->name:""',
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
            'template'=>$template
        ),
    ),
));
?>
<div id="order_detail"></div>

