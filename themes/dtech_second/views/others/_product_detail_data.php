<div class="right_detail">
    <h1><?php echo $product->product_name; ?></h1>
    <h3 style="font-size: 14px; margin-top: 8px"><?php echo $product->product_overview; ?></h3>
    <p>
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
        echo "(" . round($rating_value) . ")";
        ?>
    </p>
    <h2>
        Price: 
        <span>
            <?php
            echo isset($product->educationToys[0]->price) ? round($product->productProfile[0]->price, 2) . ' ' . Yii::app()->session['currency'] : "";
            ?>

        </span>
    </h2>

    <article>
        <?php
        echo CHtml::textField('quantity', '1', array('onKeyUp' => 'javascript:totalPrice(this.value,"' . $product->productProfile[0]->price . '")', 'style' => 'width:40px', 'maxlength' => '3'));
        ?>
        <span id="status_available" style="display:none">
            <?php echo CHtml::image(Yii::app()->theme->baseUrl . '/images/yes.png'); ?>
            Available in this quantity
        </span>
        <span id="status_un_available" style="display:none">
            <?php echo CHtml::image(Yii::app()->theme->baseUrl . '/images/no.png'); ?>
            Not available in this quantity
        </span>
    </article>
    <div class="add_to_cart_button">

        <?php
        $total_in_cart = Cart::model()->getTotalCountProduct($product->productProfile[0]->id);
        $total_av = $product->productProfile[0]->quantity - $total_in_cart;
        if ($total_av > 0) {
            echo CHtml::button('Add to Cart', array('onclick' => '
                            jQuery("#loading").show();
                            jQuery.ajax({
                                type: "POST",
                                dataType: "json",
                                url: "' . $this->createUrl("/cart/addtocart", array("product_profile_id" => $product->productProfile[0]->id)) . '",
                                data: 
                                    { 
                                        quantity: jQuery("#quantity").val(),
                                    }
                                }).done(function( msg ) {
                               
                                jQuery("#loading").hide();
                                if(msg["total_available"]>0){
                                    jQuery("#status_available").show();  
                                    dtech.custom_alert("Item has added to cart" ,"Add to Cart");
                                }
                                else {
                                    jQuery("#status_un_available").show();    
                                    dtech.custom_alert("Item is out of stock" ,"Add to Cart");
                                }
                                dtech_new.loadCartAgain("' . $this->createUrl("/web/cart/loadCart") . '");
                               
                            });    
                      ', 'class' => 'add_to_cart_arrow'));
        } else {
            if(!empty(Yii::app()->user->id)){
                echo CHtml::button('Email me when available', array('onclick' => '
                                dtech_new.loadWaitmsg();
                               jQuery("#load_subpanel_div").toggle(); 
                               jQuery.ajax({
                                    type: "POST",
                                    dataType: "json",
                                    url: "' . $this->createUrl("/cart/emailtous", array("product_profile_id" => $product->productProfile[0]->id)) . '",
                                    data: 
                                        { 

                                        }
                                    }).done(function( msg ) {      
                                        jQuery("#load_subpanel_div").hide(); 
                                        dtech.custom_alert("Email send successfully" ,"Notification");
                                }); 
                          ', 'class' => 'add_to_cart_arrow email_cart_arrow'));
            }
            else {
                 echo CHtml::button('Email me when available', array(
                     'onclick' => '
                       window.open(
                        "'.$this->createUrl("/web/cart/emailtoAdmin",array("id"=> $product->productProfile[0]->id)).'", "" )     
                ','class'=>'add_to_cart_arrow email_cart_arrow'));
            }
        }
        ?>
        <?php
        echo CHtml::ajaxLink(' Add to wishlist', $this->createUrl('/cart/addtowishlist'), array('data' => array(
                'product_profile_id' => $product->productProfile[0]->id,
                'city_id' => !empty($_REQUEST['city_id']) ? $_REQUEST['city_id'] : Yii::app()->session['city_id'],
                'city' => !empty($_REQUEST['city_id']) ? $_REQUEST['city_id'] : Yii::app()->session['city_id'],
            ),
            'type' => 'POST',
            'dataType' => 'json',
            'success' => 'function(data){
                                           old_counter = jQuery.trim(jQuery("#wishlist_counter").html());
                                           jQuery("#wishlist_counter").html(data.wishlist_counter);
                                           if(old_counter < data.wishlist_counter){
                                                 dtech.custom_alert("Item has added to Wishlist","Add to Wishlist");
                                           }
                                           else {
                                                dtech.custom_alert("Already in Wishlist", "Add to Wishlist");
                                           }
                                      }',
                ), array('id' => 'add-wish-list' . uniqid(), 'class' => 'add_to_wish_list')
        );
        ?>

    </div>
</div>
<div class="product_detail">


    <section>
        Item Code:    <?php
        echo isset($product->educationToys[0]->item_code) ? $product->educationToys[0]->item_code : "";
        ?>
    </section>
    <section>Availability : 
        <?php
        if ($total_av > 0) {
            echo "Yes ";
            echo CHtml::image(Yii::app()->theme->baseUrl . '/images/yes.png');
        } else {
            echo "No ";
            echo CHtml::image(Yii::app()->theme->baseUrl . '/images/no.png');
        }
        ?>
    </section>
    <section>Category: <?php
        if (!empty($product->productCategories)) {
            $cat_count = 0;
            foreach ($product->productCategories as $cat) {
                if ($cat_count == 0) {
                    echo $cat->category->category_name;
                } else {
                    echo ' / ' . $cat->category->category_name;
                }
                $cat_count++;
            }
        }
        ?>
    </section>
    <section>
        <?php
        $profile_id = $product->productProfile[0]->id;
        $attributes = ProductAttributes::model()->ConfAttributes($profile_id);

        foreach ($attributes as $att) {
            echo $att->books_rel->title, ' : ';
            echo $att->attribute_value;
            echo '</br>';
        }
        ?>
    </section>
    <section>Price: <?php
        echo isset($product->educationToys[0]->price) ? round($product->educationToys[0]->price, 2) . ' ' . Yii::app()->session['currency'] : "";
        ?>
    </section>

</div>

<script>
    function totalPrice(quantity, price)
    {
        if (dtech.isNumber(quantity))
        {
            //total_price = quantity * price;
            //jQuery('#price').html('$ ' + total_price);
        }
        else
        {
            dtech.custom_alert('Quantity should be Numeric....!');
            jQuery('#quantity').val('1');
        }
    }
</script>