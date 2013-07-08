<?php
if ($cart->getItemCount() <= 0) {
    ?>
    <div id="shopping_cart" style="height:308px;text-align:center;  ">
        <div id="main_shopping_cart">
            <div class="left_right_cart">
                You have not place any Order Yet..... Please Place some orders
            </div>
        </div>                                        
    </div>
    <?php
} else {
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
                    user_name = $(this).parent().prev().prev().prev().prev().prev().prev().html();
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
<div id="order_detail"></div>