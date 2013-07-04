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
        ?>
        <div class="shopping_bag">
            <h1>My Shopping Bag</h1>

            <div class="shopping_scroller">
                <?php
                $grand_total = 0;
                $total_quantity = 0;
                foreach ($cart as $pro) {
                    $grand_total = $grand_total + ($pro->quantity * $pro->productProfile->price);
                    $total_quantity+=$pro->quantity;
                    ?>
                    <div class="my_shopping">
                        <div class="left_shopping">
                            <section>

                                <div class="clear"></div>
                                <div class="quantity_text">

                                    <?php
                                    echo CHtml::textField("cart_bag_" . $pro->cart_id, $pro->quantity, array("readOnly" => "readOnly"));
                                    ?>
                                </div>

                                <span><?php echo substr($pro->productProfile->product->product_name, 0, 10) . ".."; ?></span>
                            </section>
                        </div>
                        <div class="right_shopping"><?php echo round($pro->productProfile->price, 2) . ' <b>' . Yii::app()->session['currency']; ?>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <div class="total">
                <?php
                echo CHtml::image(Yii::app()->theme->baseUrl . "/images/total_little_img_03.png");
                ?>
                <h3>TOTAL:</h3>
                <h4>
                    <span class="grand_total_bag">
                        <?php
                        $grand_total = 0;
                        $total_quantity = 0;
                        foreach ($cart as $pro) {
                            $grand_total = $grand_total + ($pro->quantity * $pro->productProfile->price);
                            $total_quantity+=$pro->quantity;
                        }
                        echo $grand_total . ' <b>' . Yii::app()->session['currency'] . '</b>';

                        /**
                         * Pcm temporary save session
                         */
                        $this->setTotalAmountSession($grand_total, $total_quantity, "");
                        ?>
                    </span>   

                </h4>
            </div>
            <div id="cart_check">
            </div>
            <?php
            if (!empty($cart)) {
                echo CHtml::button("CHECKOUT", array(
                    "class" => "check_out",
                    "onclick" => "window.location = '" . $this->createUrl('/web/payment/paymentmethod') . "'"));
            } else {
                echo CHtml::button("CHECKOUT", array(
                    "class" => "check_out",
                    "onclick" => "window.location = '" . $this->createUrl('/web/cart/viewcart') . "'"));
            }
            ?>
        </div>
        <div class="shipping_books_and_content">
            <div class="under_view_heading">
                <h3>Shopping Cart</h3>
                <?php
                echo CHtml::image(Yii::app()->theme->baseUrl . "/images/under_heading_07.png");
                ?>
            </div>
        </div>

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
                "controller" => "quran",
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

            $images = $pro->productProfile->getImage();
            $image = $pro->productProfile->product['no_image'];
            if (isset($images[0]['image_small'])) {
                $image = $images[0]['image_small'];
            }
            ?>



            <div class="shipping_books_and_content">

                <div class="shipping_books">
                    <div class="shipping_book">
                        <?php
                        //echo CHtml::image(Yii::app()->theme->baseUrl . "/images/friendship_img_03.png");
                        echo CHtml::link(CHtml::image($image, 'image', array('title' => $pro->productProfile->product->product_name)), $this->createUrl('/web/' . $view_array[$parent_cat]['controller'] . '/productDetail', array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'], 'product_id' => $pro->productProfile->product->product_id)), array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'], 'product_id' => $pro->productProfile->product->product_id));
                        ?>
                    </div>
                    <div class="shipping_content">

                        <h4>
                            <?php
                            echo $pro->productProfile->product->product_name;
                            ?>
                        </h4>
                        <p>Item Code: 
                            <span>
                                <?php echo isset($pro->productProfile->item_code) ? $pro->productProfile->item_code : ""; ?>
                            </span>
                        </p>

                        <?php
                        /**
                         * when no ajax
                         */
                        if (!isset($available)  || $available) :
                            ?>

                            <p>More Available: 
                                <?php
                                /**
                                 * get particular product counter in cart
                                 */
                                $criteria = new CDbCriteria();
                                $criteria->select = "quantity";
                                $product_pf = ProductProfile::model()->findByPk($pro->product_profile_id, $criteria);
                                $total_in_cart = Cart::model()->getTotalCountProduct($pro->product_profile_id);

                                $total_available = $product_pf->quantity - $total_in_cart;
                                ?>
                                <?php
                                if ($total_available > 0) {
                                    echo "Yes ";
                                    echo CHtml::image(Yii::app()->theme->baseUrl . '/images/yes.png');
                                } else {
                                    echo "No ";
                                    echo CHtml::image(Yii::app()->theme->baseUrl . '/images/no.png');
                                }
                            endif;
                            ?>

                        </p>
                        <article>

                        </article>
                        <section>Price   :<?php echo round($pro->productProfile->price, 2) . '  ' . Yii::app()->session['currency']; ?> 
                            <div class="clear"></div>
                            <div class="quantity_text">
                                <?php
                                echo CHtml::textField("cart_list_" . $pro->cart_id, $pro->quantity, array(
                                    "maxlength" => "3",
                                    "onKeyUp" => "
                                        var txt_obj = jQuery(this);
                                        if(!dtech.isNumber(txt_obj.val())){
                                             dtech.custom_alert('Quantity should be Numeric....!');
                                        }
                                        else {
                                                dtech_new.updateCart('" . $this->createUrl('/web/cart/editcart') . "',txt_obj,'" . $pro->cart_id . "');
                                                dtech_new.updateMainCartPage('" . $this->createUrl('/web/cart/editcart') . "',txt_obj,'" . $pro->cart_id . "');
                                            }
                                        "
                                ));
                                ?>

                            </div>
                            <div class="up_down">
                                <?php
                                // if total avaialble is greater then zero then 
                                // it wont be possible to 
                                if ($total_available > 0) {
                                    echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/up_img_03.png", "", array("class" => "shipping_up_img")), 'javascript:void(0)', array(
                                        "onclick" => "
                                        dtech.increaseQuantity(this);
                                        var txt_obj = jQuery(this).parent().prev().children().eq(0);
                                        dtech_new.updateCart('" . $this->createUrl('/web/cart/editcart') . "',txt_obj,'" . $pro->cart_id . "');
                                        dtech_new.updateMainCartPage('" . $this->createUrl('/web/cart/editcart') . "',txt_obj,'" . $pro->cart_id . "');
                                           
                                        ",
                                    ));
                                } else {
                                    echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/up_img_03.png", "", array("class" => "shipping_up_img")), 'javascript:void(0)', array(
                                        "onclick" => "
                                            void(0);
                                        ", "disabled" => "disabled"
                                    ));
                                }
                                ?>
                                <?php
                                echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/down_img_03.png", "", array("class" => "shipping_down_img")), 'javascript:void(0)', array(
                                    "onclick" => "
                                            dtech.decreaseQuantity(this);
                                            var txt_obj = jQuery(this).parent().prev().children().eq(0);
                                            dtech_new.updateCart('" . $this->createUrl('/web/cart/editcart') . "',txt_obj,'" . $pro->cart_id . "');
                                            dtech_new.updateMainCartPage('" . $this->createUrl('/web/cart/editcart') . "',txt_obj,'" . $pro->cart_id . "');
                                            "
                                ));
                                ?>
                            </div>

                            <span>

                                <?php
                                /**
                                 * after ajax action
                                 */
                                if (isset($available) && !$available) {
                                    echo "Not Available in this quantity " .'"'.$request_quantity.'" ';
                                    echo CHtml::image(Yii::app()->theme->baseUrl . '/images/no.png');
                                }
                                ?>
                            </span>

                        </section>

                        <?php
                        /*
                          ajax link for for delete cart data / cart management /card edit
                         */
                        echo CHtml::ajaxButton("Remove"
                                , $this->createUrl("/web/cart/editcart"), array(
                            "type" => "POST",
                            'dataType' => 'json',
                            "data" => array(
                                "type" => 'delete_cart',
                                "cart_id" => $pro->cart_id,
                            ),
                            "success" => "function(data) {
                                                jQuery('#loading').hide();
                                                jQuery('#cart_container').html(data._view_cart);
                                                dtech_new.loadCartAgain('" . $this->createUrl("/web/cart/loadCart") . "');
                                                
                                          }",
                                ), array(
                            "onclick" => "
                                        if(confirm('Are you want to remove this item from cart')){

                                           jQuery('#loading').show();
                                           
                                         }
                                         else {
                                           return  false;
                                         }
                                    ", "class" => 'remove_shipping'
                                )
                        );
                        ?>
                    </div>
                </div>
            </div>
            <?php
        }
    }
    ?>
</div>