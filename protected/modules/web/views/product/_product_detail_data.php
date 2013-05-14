<table width="400">

    <div class="middle_book">
        <h1><?php echo $product->product_name; ?></h1>
        <div class="products_img">

            <div id="fb-root"></div>
            <div id="fb-root"></div>
            <script>
                (function(d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id))
                        return;
                    js = d.createElement(s);
                    js.id = id;
                    js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=<?php echo Yii::app()->params['fb_key']; ?>";
                    fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));
            </script>

            <div class="fly_product_hover">
            </div>
            <div class="f_product_hover">
            </div>
            <div class="t_product_hover">
            </div>
            <a href="#">
                <div class="fb-like" data-href="<?php echo Yii::app()->request->hostInfo . Yii::app()->request->requestUri; ?>" data-send="false" data-layout="button_count" data-width="200" data-show-faces="true"></div>

            </a>
        </div>
        <h2><?php echo $product->product_description; ?></h2>
    </div>
    <div class="prodcut_table">
        <tr class="product_tr">
            <td class="left_td">Author</td>
            <td class="right_td">
                <?php
                echo isset($product->author->author_name) ? $product->author->author_name : "";
                ?></td>
        </tr>
        <tr class="product_tr">
            <td class="left_td">Available Languages</td>
            <td class="right_td">
                <?php
                $languages = $product->getBookLanguages();
                
                if (count($languages) > 1) {

                    echo CHtml::dropDownList('language', $product->productProfile[0]->language_id, $languages, array(
                        'onchange' => '
                            jQuery("#loading").show();
                            jQuery.ajax({
                                type: "POST",
                                dataType: "json",
                                url: "' . $this->createUrl("/web/product/productDetailLang", array("id" => $product->product_id)) . '",
                                data: 
                                    { 
                                        lang_id: jQuery("#language").val() 
                                    }
                                }).done(function( msg ) {
                               
                                jQuery("#loading").hide();
                                jQuery(".left_book").html(msg["left_data"]);
                                jQuery(".book_data").html(msg["right_data"]);
                            });    
                      '));
                } else {

                    echo $product->productProfile[0]->language_name;
                }
                ?>
            </td>
        </tr>
        <tr class="product_tr">
            <td class="left_td">ISBN No</td>
            <td class="right_td">
                <?php
                echo isset($product->productProfile[0]->isbn) ? $product->productProfile[0]->isbn : "";
                ?>
            </td>
        </tr>
        <tr class="product_tr">
            <td class="left_td">Item Code</td>
            <td class="right_td">
                <?php
                echo isset($product->productProfile[0]->item_code) ? $product->productProfile[0]->item_code : "";
                ?>
            </td>
        </tr>
        <tr class="product_tr">
            <td class="left_td">Category</td>
            <td class="right_td"><?php
                $cat_count = 0;
                foreach ($product->productCategories as $cat) {
                    if ($cat_count == 0) {
                        echo $cat->category->category_name;
                    } else {
                        echo ' / ' . $cat->category->category_name;
                    }
                    $cat_count++;
                }
                ?></td>
        </tr>
        <tr class="product_tr">
            <td class="left_td">Availability</td>
            <td class="right_td">
                <?php
                echo CHtml::image(Yii::app()->theme->baseUrl . '/images/yes_product_img_03.jpg');
                ?>
                Yes
            </td>
        </tr>
        <tr class="product_tr">
            <td class="left_td">Product Rating</td>
            <td class="right_td">
                <?php
                /** rating value is comming from controller * */
                $this->widget('CStarRating', array(
                    'name' => 'ratings',
                    'minRating' => 1,
                    'maxRating' => 5,
                    'starCount' => 5,
                    'value' => round($rating_value),
                    'readOnly' => true,
                ));
                ?></td>
        </tr>
        <tr class="product_tr">
        </tr>
    </div>
    <div class="product_cart">
        <tr class="price_cart">
            <td class="price"  id="price">
                <?php
                echo isset($product->productProfile[0]->price) ? round($product->productProfile[0]->price, 2) : "";
                ?>

            </td>
            <td class="quantity">Quantity 
                <?php
                $quantities = array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10');
                echo CHtml::dropDownList('quantity', '', $quantities, array('onChange' => 'javascript:totalPrice(this.value,"' . $product->productProfile[0]->price . '")'), array());
                ?>
            </td>
            <td class="add_cart">
                <?php
                echo CHtml::image(Yii::app()->theme->baseUrl . '/images/add_to_cart_img.png');
                ?>

                <?php
                echo CHtml::ajaxButton('Add to Cart', $this->createUrl('/cart/addtocart'), array('data' => array(
                        'product_id' => $product->product_id,
                        'city_id' => !empty($_REQUEST['city_id']) ? $_REQUEST['city_id'] : Yii::app()->session['city_id'],
                        'city' => !empty($_REQUEST['city_id']) ? $_REQUEST['city_id'] : Yii::app()->session['city_id'],
                        'quantity' => 'js:jQuery(\'#quantity\').val()'
                    ),
                    'type' => 'POST',
                    'dataType' => 'json',
                    'success' => 'function(data){
                                           jQuery("#cart_counter").html(data.cart_counter);
                                      }',
                        ), array('class' => 'add_to_cart')
                );
                ?>
            </td>
            <td class="wishlist"><a href="#">
                    <?php
                    echo CHtml::image(Yii::app()->theme->baseUrl . '/images/heart_img_03.jpg');

                    echo CHtml::ajaxLink(' Add to wishlist', $this->createUrl('/cart/addtowishlist'), array('data' => array(
                            'product_id' => $product->product_id,
                            'city_id' => !empty($_REQUEST['city_id']) ? $_REQUEST['city_id'] : Yii::app()->session['city_id'],
                            'city' => !empty($_REQUEST['city_id']) ? $_REQUEST['city_id'] : Yii::app()->session['city_id'],
                        ),
                        'type' => 'POST',
                        'dataType' => 'json',
                        'success' => 'function(data){
                                           jQuery("#wishlist_counter").html(data.wishlist_counter);
                                      }',
                            )
                    );
                    ?>
                </a> </td>
        </tr>
    </div>
</div>
</table>
<div class="product_para">
    <p><?php echo $product->product_description; ?></p>
</div>