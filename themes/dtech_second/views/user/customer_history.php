<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/cart_gridview.css');
if ($cart->getItemCount() <= 0) {
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
    //CVarDumper::dump($cart,20,TRUE);die;
    $config = array(
        'criteria' => array(
        //'condition' => 'order_id=' . $cart->order_id,
        )
    );
    $mName_provider = new CActiveDataProvider("Order");

    $this->widget('DtGridView', array(
        'id' => 'history-grid',
        'dataProvider' => $cart,
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
                'value' => '!empty($data->status)?$data->status:""',
                "type" => "raw",
            ),
            array(
                'class' => 'CLinkColumn',
                'label' => 'View Detail',
                'header' => 'View Order Detail',
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
        ),
    ));
}
?>
<style>
    .grid-view .link-column a {
        width: 90px;
    }
</style>
<div id="order_detail"></div>