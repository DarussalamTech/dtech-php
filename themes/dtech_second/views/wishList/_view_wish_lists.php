<div class="general_content">
    <?php
    if (empty($wishList)) {
        ?>

        <div class="shipping_books_and_content"  style="height: 393px;">
            <div class="under_view_heading">
                <h2>Wishlist</h2>
                <?php
                echo CHtml::image(Yii::app()->theme->baseUrl . "/images/under_heading_07.png");
                ?>
            </div>
            <div class="shipping_books_and_content">
            <div class="shipping_book">
                <h2 style="font-size:17px; color:#003366;">Your Wish List is empty.....</h2>
            </div>
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
        foreach ($wishList as $pro) {

            $images = $pro->productProfile->getImage();
            $image = $pro->productProfile->product['no_image'];
            if (isset($images[0]['image_small'])) {
                $image = $images[0]['image_small'];
            }
            ?>
    <div class="shipping_books_and_content">
            <div class="wishlist_content_data">

                <div class="shipping_books">
                    <div class="shipping_book">
                        <?php
                        //echo CHtml::image(Yii::app()->theme->baseUrl . "/images/friendship_img_03.png");
                        //echo CHtml::link(CHtml::image($image, 'image', array('title' => $pro->productProfile->product->product_name)), $this->createUrl('/web/' . $view_array[$parent_cat]['controller'] . '/productDetail', array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'], 'product_id' => $pro->productProfile->product->product_id)), array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'], 'product_id' => $pro->productProfile->product->product_id));
                        echo CHtml::link(CHtml::image($image, 'image', array('style'=>'height:170px;width: 120px;')), $this->createUrl('/web/product/productDetail', array(
                                    'country' => Yii::app()->session['country_short_name'],
                                    'city' => Yii::app()->session['city_short_name'],
                                    'city_id' => Yii::app()->session['city_id'],
                                    "pcategory" => $pro->productProfile->product->parent_category->category_name,
                                    "slug" => $pro->productProfile->product->slag,
                                ))
                        );
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
                            <span id="status_available" style="display:none">
                                <?php echo CHtml::image(Yii::app()->theme->baseUrl . '/images/yes.png'); ?>
                                Available in this quantity
                            </span>
                            <span id="status_un_available" style="display:none">
                                <?php echo CHtml::image(Yii::app()->theme->baseUrl . '/images/no.png'); ?>
                                Not available in this quantity
                            </span>
                        </section>
                        <div class="clear"></div>
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
                                                    jQuery('.wishlist_counter span').html(data.wish_list_count);
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
                                                    jQuery("#status_available").hide();  
                                                    jQuery("#status_un_available").hide();  
                                                    dtech_new.loadCartAgain("' . $this->createUrl("/web/cart/loadCart") . '");
                                                   
                                                    if(data["total_available"]>0){
                                                        jQuery("#status_available").show();  
                                                        dtech.custom_alert("Item has added to cart" ,"Add to Cart");
                                                    }
                                                    else {
                                                        jQuery("#status_un_available").show();    
                                                        dtech.custom_alert("Item is out of stock" ,"Add to Cart");
                                                    }
                                                                    }',
                                    ), array('class' => 'add_shipping')
                            );
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <?php
        }
    }
    ?>
</div>