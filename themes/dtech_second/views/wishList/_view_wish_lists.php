<div class="general_content">
    <?php
    if (empty($wishList)) {
        ?>
        <div id="login_content" style="margin-top: -2px">
            <div class="payment_method_big_img">
                <?php
                echo CHtml::image(Yii::app()->theme->baseUrl . "/images/shopping_cart_img_03.png", '', array('class' => "payment_method_big_img"));
                ?>
            </div>
            <div class="secure_payment">
                <h2 style="font-size:17px; color:#003366;margin: 20px 0 0 15px;">Your Wish List is empty.....</h2>
            </div>
        </div>
    <?php } else {
        ?>

        <div class="shipping_books_and_content">
            <div class="under_view_heading">
                <h2>Wishlist</h2>
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


        foreach ($wishList as $pro) {


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
                        <article>
                            <?php
                            echo CHtml::image(Yii::app()->theme->baseUrl . "/images/good_stars_img_03.png");
                            ?>
                            (7)
                        </article>
                        <section>Price   :<?php echo round($pro->productProfile->price, 2) . ' <b>' . Yii::app()->session['currency'] . '</b>'; ?>
                            <div class="clear"></div>
                            <div class="quantity_text">

                                <?php
                                echo CHtml::textField("cart_" . $pro->id, 1);
                                ?>
                            </div>
                            <div class="up_down">
                                <?php
                                echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/up_img_03.png", "", array("class" => "shipping_up_img")), 'javascript:void(0)', array(
                                    "onclick" => "
                                        dtech.increaseQuantity(this);
                                       
                                        "
                                ));
                                ?>
                                <?php
                                echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/down_img_03.png", "", array("class" => "shipping_down_img")), 'javascript:void(0)', array(
                                    "onclick" => "
                                            dtech.decreaseQuantity(this);
                                            
                                            "
                                ));
                                ?>
                            </div>
                        </section>
                        <div class="shipping_button">
                            <?php
                            /*
                              ajax button for for delete cart data / cart management /card edit
                             */
                            echo CHtml::ajaxButton('Remove from WishList', $this->createUrl("/web/wishList/editwishlist"), array(
                                "type" => "POST",
                                'dataType' => 'json',
                                "data" => array(
                                    "type" => 'delete_wishlist',
                                    "id" => $pro->id,
                                ),
                                "success" => "function(data) {
                                                    $('#loading').hide();
                                                    jQuery('#wishList_container').html(data._view_list); 
                                                    jQuery('#wishlist_counter').html(data.wish_list_count);
                                               }",
                                    ), array(
                                "onclick" => "
                                                if(confirm('Are you want to remove this item from wish list')){
                                                   $('#loading').show();
                                                 }
                                                 else {
                                                   return  false;
                                                 }
                                                "
                                , 'class' => 'remove_shipping')
                            );
                            ?>


                            <?php
                            echo CHtml::ajaxButton('Add to Cart', $this->createUrl('/cart/addtocart', array('product_profile_id' => $pro->product_profile_id)), array(
                                'data' => 'js:{quantity:jQuery("#cart_' . $pro->id . '").val()}',
                                'type' => 'POST',
                                'dataType' => 'json',
                                'success' => 'function(data){
                                                    dtech_new.loadCartAgain("' . $this->createUrl("/web/cart/loadCart") . '");
                                                    dtech.custom_alert("Item has added to cart" ,"Add to Cart");
                                                }',
                                    ), array('class' => 'add_shipping')
                            );
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }
    ?>
</div>