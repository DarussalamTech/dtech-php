<?php
if (empty($wishList)) {
    ?>
    <div id="shopping_cart" style="height:308px;text-align:center;  ">
        <div id="main_shopping_cart">
            <div class="left_right_cart">
                Your Wishlist IS empty
            </div>
        </div>                                        
    </div>
    <?php
} else {
    ?>

    <div id="shopping_cart">
        <div id="main_shopping_cart">
            <div class="top_cart">
                <h1>Wishlist</h1>
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
                    foreach ($wishList as $pro) {
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
                                //echo CHtml::image($image);
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
                                        ), $this->createUrl("/web/wishList/editwishlist"), array(
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
                                        )
                                );
                                ?>
                                <h2><?php echo $pro->productProfile->product->product_description; ?></h2>

                                <?php
                                if (isset($view_array[$parent_cat]['view'])) {
                                    $this->renderPartial($view_array[$parent_cat]['view'], array("pro" => $pro));
                                }
                                ?>
                                <table width="100%">
                                    <tr class="cart_tr">
                                        <td class="cart_left_td">Price</td>
                                        <td class="cart_right_td">
                                            $<?php echo round($pro->productProfile->price, 2); ?>
                                        </td>
                                    </tr>
                                    <tr class="cart_tr">
                                        <td></td>
                                        <td class="add_cart">
                                            <?php
                                            echo CHtml::image(Yii::app()->theme->baseUrl . '/images/add_to_cart_img.png');
                                            ?>

                                            <?php
                                            echo CHtml::ajaxButton('Add to Cart', $this->createUrl('/cart/addtocart'), array('data' => array(
                                                    'product_profile_id' => $pro->product_profile_id,
                                                    'city_id' => !empty($_REQUEST['city_id']) ? $_REQUEST['city_id'] : Yii::app()->session['city_id'],
                                                    'city' => !empty($_REQUEST['city_id']) ? $_REQUEST['city_id'] : Yii::app()->session['city_id'],
                                                    'quantity' => '1'
                                                ),
                                                'type' => 'POST',
                                                'dataType' => 'json',
                                                'success' => 'function(data){
                                                    jQuery("#cart_counter").html(data.cart_counter);
                                                    dtech.custom_alert("Item has added to cart" ,"Add to Cart");
                                                }',
                                                    ), array('class' => 'add_to_cart')
                                            );
                                            ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div><?php
}?>