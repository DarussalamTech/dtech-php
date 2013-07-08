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
                            'label' => '[ Delete ]',
                            'url' => 'Yii::app()->controller->createUrl("/web/cart/deleteCart",array("id"=>$data->cart_id))',
                            'imageUrl' => '',
                        ),
                        'update' => array(
                            'label' => '[ Update ]',
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