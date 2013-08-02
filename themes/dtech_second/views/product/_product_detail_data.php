<div class="center_detail">
    <p>Title:
        <?php
        if (!empty($product->productProfile[0]->title)) {
            echo $product->productProfile[0]->title;
        }
        ?>
    </p>
    <p>Available Languages: 
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
                                
                                
                                jQuery(".left_upper_part").html(msg["image_data"]);
                                jQuery(".right_upper_part").html(msg["upper_detail_data"]);
                                jQuery(".center_detail").html(msg["lower_detail_data"]);
                            });'));
        } else {

            echo $product->productProfile[0]->language_name;
        }
        ?>
    </p>
    <p>Availability : 
        <?php
//        $total_in_cart = Cart::model()->getTotalCountProduct($product->productProfile[0]->id);
//        $total_av = $product->productProfile[0]->quantity - $total_in_cart;
//        if ($total_av > 1) {
//            echo "Yes ";
//            echo CHtml::image(Yii::app()->theme->baseUrl . '/images/tick_03.jpg');
//        } else {
//            echo "No ";
//            echo CHtml::image(Yii::app()->theme->baseUrl . '/images/no.png');
//        }
        ?>
    </p>
    <p>Item Code: 
        <?php
        echo isset($product->productProfile[0]->item_code) ? $product->productProfile[0]->item_code : "";
        ?>
    </p>
    </p>
    <p>ISBN : 
        <?php
        echo isset($product->productProfile[0]->isbn) ? $product->productProfile[0]->isbn : "";
        ?>
    </p>
    <p>Category: 
        <?php
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
    </p>
    <?php
    if (!empty($product->productProfile[0]->translator_rel->name)):
        ?>
        <p>Translator: 
            <?php
            echo $product->productProfile[0]->translator_rel->name;
            ?>
        </p>
        <?php
    endif;
    ?>
    <?php
    if (!empty($product->productProfile[0]->compiler_rel->name)):
        ?>
        <p>Compiler: 
            <?php
            echo $product->productProfile[0]->compiler_rel->name;
            ?>
        </p>
        <?php
    endif;
    ?>
    <?php
    if (!empty($product->productProfile[0]->dimension_rel->title)):
        ?>
        <p>Dimension: 
            <?php
            echo $product->productProfile[0]->dimension_rel->title;
            ?>
        </p>
        <?php
    endif;
    ?>
    <?php
    if (!empty($product->productProfile[0]->binding_rel->title)):
        ?>
        <p>Binding: 
            <?php
            echo $product->productProfile[0]->binding_rel->title;
            ?>
        </p>
        <?php
    endif;
    ?>
    <?php
    if (!empty($product->productProfile[0]->printing_rel->title)):
        ?>
        <p>Printing: 
            <?php
            echo $product->productProfile[0]->printing_rel->title;
            ?>
        </p>
        <?php
    endif;
    ?>
    <?php
    if (!empty($product->productProfile[0]->paper_rel->title)):
        ?>
        <p>Paper Type: 
            <?php
            echo $product->productProfile[0]->paper_rel->title;
            ?>
        </p>
        <?php
    endif;
    ?>
    <?php
    if (!empty($product->productProfile[0]->no_of_pages)):
        ?>
        <p>No Of Pages: 
            <?php
            echo $product->productProfile[0]->no_of_pages;
            ?>
        </p>
        <?php
    endif;
    ?>
    <?php
    if (!empty($product->productProfile[0]->edition)):
        ?>
        <p>Edition: 
            <?php
            echo $product->productProfile[0]->edition;
            ?>
        </p>
        <?php
    endif;
    ?>
    <?php
    if (!empty($product->productProfile[0]->edition)):
        ?>
        <p>Edition: 
            <?php
            echo $product->productProfile[0]->edition;
            ?>
        </p>
        <?php
    endif;
    ?>
    <?php
    $profile_id = $product->productProfile[0]->id;
    $attributes = ProductAttributes::model()->ConfAttributes($profile_id);

    foreach ($attributes as $att) {
        echo CHtml::openTag('p');
        echo $att->books_rel->title, ' : ';
        echo $att->attribute_value;
        echo CHtml::closeTag('p');
    }
    ?>
    <?php $this->renderPartial("//product/_editorial_reviews", array("product" => $product, "rating_value" => $rating_value)); ?>
</div>
