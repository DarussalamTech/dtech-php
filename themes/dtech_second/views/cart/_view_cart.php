<div class="general_content">

    <?php
    if (empty($cart)) {
        ?>
        <div id="login_content" style="margin-top: -2px">
            <div class="payment_method_big_img">
                <?php
                echo CHtml::image(Yii::app()->theme->baseUrl . "/images/shopping_cart_img_03.png", '', array('class' => "payment_method_big_img"));
                ?>
            </div>
            <div class="secure_payment">
                <h2 style="font-size:17px; color:#003366; margin: 20px 0 0 15px;">Your Shoping Bag  is empty.....</h2>
            </div>
        </div>
        <?php
    } else {


            $config = array(
                'criteria' => array(
                    'condition' => 'cart_id=' . $prod->cart_id,
                )
            );
            $mName_provider = new CActiveDataProvider("Cart", $config);

            $this->widget('zii.widgets.grid.CGridView', array(
                'id' => 'product-grid',
                'dataProvider' => $cart,
                //'filter'=>false,
                'cssFile' => Yii::app()->theme->baseUrl . '/css/gridview.css',
                'columns' => array(
                    array(
                        'name' => 'Product Name',
                        'value' => '!empty($data->productProfile->product)?$data->productProfile->product->product_name:""',
                        "type" => "raw",
                    ),
                    array(
                        'name' => 'Price',
                        'value' => '!empty($data->productProfile)?$data->productProfile->price:""',
                        "type" => "raw",
                    ),
                    array(
                        'name' => 'Quantity',
                        'value' => '!empty($data->quantity)?$data->quantity:""',
                        "type" => "raw",
                    ),
                ),
            ));
  
    }
    ?>
</div>