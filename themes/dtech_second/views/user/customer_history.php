<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/cart_gridview.css');
if ($history->getItemCount() <= 0) {
    ?>
    <div class="no_orders">
        <div class="under_view_heading">
            <h2>Your Orders</h2>
            <?php
            echo CHtml::image(Yii::app()->theme->baseUrl . "/images/under_heading_07.png");
            ?>
        </div>
        <div class="shipping_books_and_content">
            <div class="shipping_book">
                <h2 style="font-size:17px; color:#003366;">You have placed NO orders Yet...</h2>
            </div>
        </div>
    </div>

    <?php
} else {
    ?>

    <div class="heading_cart">
        <h2>Your Orders</h2>
        <?php
        echo CHtml::image(Yii::app()->theme->baseUrl . "/images/under_heading_07.png");
        ?>
    </div>

    <?php


    $this->widget('DtGridView', array(
        'id' => 'history-grid',
        'dataProvider' => $history,
        //'filter'=>false,
        'cssFile' => Yii::app()->theme->baseUrl . '/css/cart_gridview.css',
        'columns' => array(
            array(
                'name' => 'order_date',
                'value' => '!empty($data->order_date)?$data->order_date:""',
                "type" => "raw",
            ),
            array(
                'name' => 'status',
                'value' => '!empty($data->status)?$data->order_status->title:""',
                "type" => "raw",
            ),
            array(
                'class' => 'CLinkColumn',
                'label' => 'View Products',
                'header' => 'View Product Detail',
                'urlExpression' => 'Yii::app()->controller->createUrl("user/orderDetail",array("id"=>$data->order_id))',
                'linkHtmlOptions' => array(
                    "onclick" => '
                    $("#loading").show();
                    ajax_url = $(this).attr("href");
                   
                    $.ajax({
                        type: "POST",
                        url: ajax_url,
                    }).done(function( msg ) {
                        $("#order_detail").html(msg);
                        $("#loading").hide();
                    });
                    return false;
                    '
                ),
            ),
            array(
                'class' => 'CLinkColumn',
                'label' => 'Full Detail',
                'header' => 'Full Detail',
                'urlExpression' => 'Yii::app()->controller->createUrl("/web/user/customerDetail",array("id"=>$data->order_id))',
            ),
        ),
    ));
}
?>
<style>
    .grid-view .link-column a {
        width: 110px;
    }
</style>
<div id="order_detail"></div>