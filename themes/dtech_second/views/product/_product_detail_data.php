<div class="right_detail">
    <h1><?php echo $product->product_name; ?></h1>

    <h2>

        <?php
        echo isset($product->author->author_name) ? "Author:" . "<span>" . $product->author->author_name . "</span>" : "";
        ?>

    </h2>
    <h2>

        <?php
        echo isset($product->productProfile[0]->isbn) ? "ISBN:<span>" . $product->productProfile[0]->isbn . "</span>" : "";
        ?>       
    </h2>
    <h2>
        <?php
        echo isset($product->productProfile[0]->price) ? " Price: <span>" . round($product->productProfile[0]->price, 2) . ' ' . Yii::app()->session['currency'] . "</span>" : "";
        ?>
    </h2>
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

    <article>
        <?php
        echo CHtml::textField('quantity', '1', array('onKeyUp' => 'javascript:totalPrice(this.value,"' . $product->productProfile[0]->price . '")', 'style' => 'width:40px', 'maxlength' => '3'));
        ?>
    </article>
    <div class="add_to_cart_button">

        <?php
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
                                dtech.custom_alert("Item has added to cart" ,"Add to Cart");
                                dtech_new.loadCartAgain("' . $this->createUrl("/web/cart/loadCart") . '");
                               
                            });    
                      ', 'class' => 'add_to_cart_arrow'));
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


    <section class="section_1">
        <?php
        if (!empty($product->productProfile[0]->title)) {
            echo CHtml::openTag("section");
            echo 'Title  : ' . $product->productProfile[0]->title;
            echo CHtml::closeTag("section");
        }
        ?>
        Available Languages: 
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
                                
                                browser_string = "lang="+jQuery("#language option:selected").text();
                                dtech.updatehashBrowerUrl(browser_string);
                                
                                
                                jQuery("#img_detail").html(msg["left_data"]);
                                jQuery("#prod_detail").html(msg["right_data"]);
                            });    
                      '));
        } else {

            echo $product->productProfile[0]->language_name;
        }
        ?>
    </section>
    <?php
    if (!empty($product->productProfile[0]->translator_rel->name)):
        ?>
        <section>Translator: 
            <?php
            echo $product->productProfile[0]->translator_rel->name;
            ?>
        </section>
        <?php
    endif;
    ?>
    <?php
    if (!empty($product->productProfile[0]->compiler_rel->name)):
        ?>
        <section>Compiler: 
            <?php
            echo $product->productProfile[0]->compiler_rel->name;
            ?>
        </section>
        <?php
    endif;
    ?>
    <?php
    if (!empty($product->productProfile[0]->dimension_rel->title)):
        ?>
        <section>Dimension: 
            <?php
            echo $product->productProfile[0]->dimension_rel->title;
            ?>
        </section>
        <?php
    endif;
    ?>
    <?php
    if (!empty($product->productProfile[0]->binding_rel->title)):
        ?>
        <section>Binding: 
            <?php
            echo $product->productProfile[0]->binding_rel->title;
            ?>
        </section>
        <?php
    endif;
    ?>
    <?php
    if (!empty($product->productProfile[0]->printing_rel->title)):
        ?>
        <section>Printing: 
            <?php
            echo $product->productProfile[0]->printing_rel->title;
            ?>
        </section>
        <?php
    endif;
    ?>
    <?php
    if (!empty($product->productProfile[0]->paper_rel->title)):
        ?>
        <section>Paper Type: 
            <?php
            echo $product->productProfile[0]->paper_rel->title;
            ?>
        </section>
        <?php
    endif;
    ?>
    <?php
    if (!empty($product->productProfile[0]->no_of_pages)):
        ?>
        <section>No Of Pages: 
            <?php
            echo $product->productProfile[0]->no_of_pages;
            ?>
        </section>
        <?php
    endif;
    ?>
    <?php
    if (!empty($product->productProfile[0]->edition)):
        ?>
        <section>Edition: 
            <?php
            echo $product->productProfile[0]->edition;
            ?>
        </section>
        <?php
    endif;
    ?>
    <section>
        Item Code:    <?php
        echo isset($product->productProfile[0]->item_code) ? $product->productProfile[0]->item_code : "";
        ?>
    </section>
    <section>Category: <?php
        $cat_count = 0;
        foreach ($product->productCategories as $cat) {
            if ($cat_count == 0) {
                echo $cat->category->category_name;
            } else {
                echo ' / ' . $cat->category->category_name;
            }
            $cat_count++;
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