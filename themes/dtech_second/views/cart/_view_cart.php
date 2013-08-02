<div class="general_content">
    <span id="status_available" style="display:none">
        <?php echo CHtml::image(Yii::app()->theme->baseUrl . '/images/yes.png'); ?>
        Available in this quantity
    </span>
    <span id="status_un_available" style="display:none">
        <?php echo CHtml::image(Yii::app()->theme->baseUrl . '/images/no.png'); ?>
        Not available in this quantity
    </span>
    <?php
    if ($cart->getItemCount() == 0) {
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/wishlist.css');
        ?>
        <div class="shipping_books_and_content"  style="height: 303px;">
            <div class="under_view_heading">
                <h2>Shoppin Cart</h2>
                <?php
                echo CHtml::image(Yii::app()->theme->baseUrl . "/images/under_heading_07.png");
                ?>
            </div>
            <div class="shipping_books_and_content">
                <div class="shipping_book">
                    <h2 style="font-size:17px; color:#003366;margin: 6px 0 0 -88px;">Your Shopping Cart is empty.....</h2>
                </div>
            </div>
        </div>
        <?php
    } else {
        /**
         * to handle the views 
         * links becasue every category may have different things
         * so 
         */
        $view_array = array(
            "Books" => array(
                "controller" => "product",
                "view" => "_books/_book_info"
            ),
            "Educational Toys" => array(
                "controller" => "educationToys",
            ),
            "Quran" => array(
                "controller" => "quran",
                "view" => "_quran/_quran_info"
            ),
            "Others" => array(
                "controller" => "others",
            ),
        );


        $this->widget('DtGridView', array(
            'id' => 'cart-grid',
            'dataProvider' => $cart,
            //'filter'=>false,
            'summaryText' => '{count} records(s) found.',
            'cssFile' => Yii::app()->theme->baseUrl . '/css/cart_gridview.css',
            'afterAjaxUpdate' => "function(id,data){
                console.log(jQuery('#cart-grid table tbody tr td.empty').length);
                if(jQuery('#cart-grid table tbody tr td.empty').length!=0){
                    jQuery('.check_out_cart').hide();
                }
                else {
                    jQuery('.check_out_cart').show();
                }
                
                return true;
            }",
            'columns' => array(
                array(
                    'name' => 'Product Name',
                    'value' => '$data->image_link',
                    "type" => "raw",
                    "htmlOptions" => array("class" => "cart-product-name")
                ),
                array(
                    'name' => 'Product Name',
                    'value' => '$data->link',
                    "type" => "raw",
                    "htmlOptions" => array("class" => "cart-product-name")
                ),
                array(
                    'name' => 'unit_price',
                    'value' => '$data->productProfile->price',
                    "type" => "raw",
                    "htmlOptions" => array("class" => "cart-product-name")
                ),
                array(
                    'header' => CHtml::activeLabel($cart->model, 'price'),
                    'columnName' => 'price',
                    'class' => 'DtGridCountColumn',
                    'decimal' => true,
                    "htmlOptions" => array("class" => 'cart-ourprice'),
                    'currencySymbol' => Yii::app()->session['currency'],
                    'footer' => ''
                ),
                array(
                    'name' => 'Quantity',
                    'value' => '
                                CHtml::textField("dd",$data->quantity,array("maxlength"=>"3","style"=>"width:40px")).CHtml::Tag("span",array("class"=>"icon"))
                                
                                ',
                    "type" => "raw",
                ),
                array(
                    'class' => 'CButtonColumn',
                    'template' => '{update}{delete}',
                    'buttons' => array(
                        'delete' => array(
                            'label' => ' Delete ',
                            'url' => 'Yii::app()->controller->createUrl("/web/cart/deleteCart",array("id"=>$data->cart_id))',
                            'imageUrl' => '',
                        ),
                        'update' => array(
                            'label' => ' Update ',
                            'url' => 'Yii::app()->controller->createUrl("/web/cart/editcart",array("cart_id"=>$data->cart_id))',
                            'imageUrl' => '',
                            'click' => "function(event){
                                event.preventDefault();
                                q_obj = $(this).parent().prev().children().eq(0);
                                quantity = q_obj.val();
                                if (dtech.isNumber(quantity)){
                                       
                                       $.ajax({
                                        url: $(this).attr('href'),
                                        data : {quantity:quantity},
                                        dataType: 'json',
                                        success:function(msg){
                                          
                                            if(msg['available'] == false){
                                                $(q_obj).next().html($('#status_un_available').html());
                                            }
                                            else {
                                                $(q_obj).next().html($('#status_available').html());
                                            }
                                            
                                            setTimeout(function(){
                                                  $('#cart-grid').yiiGridView.update('cart-grid');
                                                  
                                            },1000);

                                        }
                                    });   
                                }
                                else{
                                    return false;
                                }
                              
                                
                              }",
                        ),
                    )
                )
            ),
        ));
    }
    ?>
</div>
<?php
$cart_data = $cart->getData();

if (!empty($cart_data)) {
    echo CHtml::button("CHECKOUT", array(
        "class" => "check_out_cart",
        "onclick" => "window.location = '" . $this->createUrl('/web/payment/paymentmethod') . "'"));
} else {
    
}
?>