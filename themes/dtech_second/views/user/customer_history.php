<?php
if (empty($cart)) {
    ?>
    <div id="shopping_cart" style="height:308px;text-align:center;  ">
        <div id="main_shopping_cart">
            <div class="left_right_cart">
                You are new to this site.....Place some orders
            </div>
        </div>                                        
    </div>
    <?php
} else {
    //CVarDumper::dump($cart->getData()->order_id,20,TRUE);die;
    $config = array(
        'criteria' => array(
        //'condition' => 'order_id=' . $cart->order_id,
        )
    );
    $mName_provider = new CActiveDataProvider("Order");

    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'hsi-grid',
        'dataProvider' => $cart,
        //'filter'=>false,
        'cssFile' => Yii::app()->theme->baseUrl . '/css/gridview.css',
        'columns' => array(
            array(
                'name' => 'Product Name',
                'value' => '!empty($data->orderDetails[0]->product_profile->product->product_name)?$data->orderDetails[0]->product_profile->product->product_name:""',
                "type" => "raw",
            ),
            array(
                'name' => 'Product Description',
                'value' => '!empty($data->orderDetails[0]->product_profile->product->product_description)?$data->orderDetails[0]->product_profile->product->product_description:""',
                "type" => "raw",
            ),
            array(
                'name' => 'Language',
                'value' => '!empty($data->orderDetails[0]->product_profile->productLanguage->language_name)?$data->orderDetails[0]->product_profile->productLanguage->language_name:""',
                "type" => "raw",
            ),
            array(
                'name' => 'Quantity',
                'value' => '!empty($data->orderDetails[0]->quantity)?$data->orderDetails[0]->quantity:""',
                "type" => "raw",
            ),
            array(
                'name' => 'Unit Price',
                'value' => '!empty($data->orderDetails[0]->product_price)?$data->orderDetails[0]->product_price:""',
                "type" => "raw",
            ),
            array(
                'name' => 'Sub Total',
                'value' => '!empty($data->orderDetails[0]->product_price)?$data->orderDetails[0]->quantity * $data->orderDetails[0]->product_price." ".Yii::app()->session[currency]:""',
                "type" => "raw",
            ),
        ),
    ));
}
?>