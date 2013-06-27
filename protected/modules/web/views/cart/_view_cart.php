<?php
if (empty($cart)) {
    ?>
    <div id="shopping_cart" style="height:308px;text-align:center;  ">
        <div id="main_shopping_cart">
            <div class="left_right_cart">
                Your Cart IS empty
            </div>
        </div>                                        
    </div>
    <?php
} else {
    ?>

    <div id="shopping_cart">
        <div id="main_shopping_cart">
            <div class="top_cart">
                <?php //echo CHtml::image(Yii::app()->theme->baseUrl . "/images/shopping_cart_img_03.png") ?>
            </div>
            <div id="cart">
                <div class="left_cart">
                    <?php
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
                            "controller" => "educationToys",
                            "view" => "_quran/_quran_info"
                        ),
                        "Others" => array(
                            "controller" => "others",
                        ),
                    );

                    $grand_total = 0;
                    $total_quantity = 0;
                    $description = '';

                    foreach ($cart as $pro) {
                        $grand_total = $grand_total + ($pro->quantity * $pro->productProfile->price);
                        $total_quantity+=$pro->quantity;
                        $description.=$pro->productProfile->product->product_name . ' , ';

                        /**
                         * setting parent category
                         */
                        $parent_cat = "Books";
                        if (!empty($pro->productProfile->product->parent_category->category_name)) {
                            $parent_cat = $pro->productProfile->product->parent_category->category_name;
                        }
                        ?>

                        <div class="upper_cart">
                            <div class="left_left_cart">
                                <?php
                                $images = $pro->productProfile->getImage();
                                $image = $pro->productProfile->product['no_image'];
                                if (isset($images[0]['image_small'])) {
                                    $image = $images[0]['image_small'];
                                }

                                echo CHtml::link(CHtml::image($image, 'image', array('title' => $pro->productProfile->product->product_name)), $this->createUrl('/web/' . $view_array[$parent_cat]['controller'] . '/productDetail', array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'], 'product_id' => $pro->productProfile->product->product_id)), array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'], 'product_id' => $pro->productProfile->product->product_id));
                                
                                ?>
                            </div>
                            <div class="left_right_cart">
                                <h1><?php
                                    echo CHtml::link($pro->productProfile->product->product_name, $this->createUrl('/web/' . $view_array[$parent_cat]['controller'] . '/productDetail', array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'], 'product_id' => $pro->productProfile->product->product_id)), array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'], 'product_id' => $pro->productProfile->product->product_id));
                                    ?></h1>

                                <?php
                                /*
                                  ajax link for for delete cart data / cart management /card edit
                                 */
                                echo CHtml::ajaxLink(
                                        CHtml::image(
                                                Yii::app()->theme->baseUrl . "/images/close_img_03.png", "Publish", array("title" => "Delete",
                                            "class" => "close_img",
                                                )
                                        ), $this->createUrl("/web/cart/editcart"), array(
                                    "type" => "POST",
                                    'dataType' => 'json',
                                    "data" => array(
                                        "type" => 'delete_cart',
                                        "cart_id" => $pro->cart_id,
                                    ),
                                    "success" => "function(data) {
                                                jQuery('#loading').hide();
                                                jQuery('#cart_container').html(data._view_cart);
                                                jQuery('#cart_counter').html(data.cart_list_count.cart_total);
                                          }",
                                        ), array(
                                    "onclick" => "
                                        if(confirm('Are you want to remove this item from cart')){

                                           jQuery('#loading').show();
                                         }
                                         else {
                                           return  false;
                                         }
                                    "
                                        )
                                );
                                ?>
                                <h2><?php echo $pro->productProfile->product->product_description; ?></h2>
                               
                                <div class="quantity_cart">
                                    <p>$<?php echo round($pro->productProfile->price, 2); ?></p>
                                    <span>Quantity</span> 
                                    <?php
                                    $quantities = array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10');
                                    echo CHtml::dropDownList('quantity' . $pro->cart_id, '', $quantities, array(
                                        'options' => array($pro->quantity => array('selected' => true)),
                                        'ajax' => array(
                                            'type' => 'POST',
                                            'url' => $this->createUrl('/web/cart/editcart'),
                                            'data' => array('quantity' => 'js:jQuery(this).val()', 'type' => 'update_quantity', 'cart_id' => $pro->cart_id),
                                            'dataType' => 'json',
                                            'success' => 'function(data) {
                                                   
                                                    $("#loading").hide();
                                                    $("#cart_container").html(data._view_cart);
                                                    $("#cart_counter").html(data.cart_list_count.cart_total);
                                                }',
                                        ))
                                    );
                                    ?>
                                    <h3>$<?php echo round($pro->quantity * $pro->productProfile->price, 2); ?></h3>
                                </div>
                            </div>
                        </div>
                    <?php } ?>


                </div>
                <div class="right_right_cart">
                    <div class="right_top_cart">
                        <h1>Your Order</h1>
                        <table width="100%">
                            <tr class="right_cart_tr">
                                <td class="left_cart_td">Order Subtotal</td>
                                <td class="right_cart_td">$<?php echo $grand_total; ?></td>
                            </tr>
                            <tr class="right_cart_tr">
                                <td class="left_cart_td">Shipping</td>
                                <td class="right_cart_td">FREE</td>
                            </tr>
                            <tr class="right_cart_tr">
                                <td class="left_left_cart_td">Total</td>
                                <td class="right_right_cart_td">$<?php echo $grand_total; ?></td>
                            </tr>
                        </table>
                        <?php
                        /**
                         * Pcm temporary save session
                         */
                        $this->setTotalAmountSession($grand_total, $total_quantity, $description);
                        ?>
                        <a href="<?php echo $this->createUrl('/web/payment/paymentmethod'); ?>">
                            <?php echo CHtml::submitButton('Checkout', array('class' => 'check_out')); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div><?php }
                        ?>
