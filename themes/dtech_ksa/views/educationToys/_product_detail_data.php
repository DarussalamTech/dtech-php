<div class="center_detail">
    <p> <?php
        echo Yii::t('model_labels', 'Title', array(), NULL, $this->currentLang) . ":";
        ?>
        <?php echo $product->product_name; ?>

    </p>

    <p>  
        <?php
        echo Yii::t('model_labels', 'Availability', array(), NULL, $this->currentLang) . ":";
        ?> 
        <?php
        $total_in_cart = Cart::model()->getTotalCountProduct($product->productProfile[0]->id);
        $total_av = $product->productProfile[0]->quantity - $total_in_cart;
        if ($total_av > 1) {
            echo "Yes ";
            echo CHtml::image(Yii::app()->theme->baseUrl . '/images/tick_03.jpg');
        } else {
            echo "No ";
            echo CHtml::image(Yii::app()->theme->baseUrl . '/images/no.png');
        }
        ?>
    </p>
    <p>
        <?php
        echo Yii::t('model_labels', 'Item Code', array(), NULL, $this->currentLang) . ":";
        ?>
        <?php
        echo isset($product->productProfile[0]->isbn) ? $product->productProfile[0]->isbn : "";
        ?>
    </p>
    <p>
        <?php
        echo Yii::t('model_labels', 'Category', array(), NULL, $this->currentLang) . ":";
        ?>
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
        <p> 
            <?php
            echo Yii::t('model_labels', 'Translator', array(), NULL, $this->currentLang) . ":";
            ?>
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
        <p>
            <?php
            echo Yii::t('model_labels', 'Compiler', array(), NULL, $this->currentLang) . ":";
            ?>
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
        <p>
            <?php
            echo Yii::t('model_labels', 'Dimension', array(), NULL, $this->currentLang) . ":";
            ?>
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
        <p> 
            <?php
            echo Yii::t('model_labels', 'Binding', array(), NULL, $this->currentLang) . ":";
            ?>
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
        <p> 
            <?php
            echo Yii::t('model_labels', 'Printing', array(), NULL, $this->currentLang) . ":";
            ?>
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
        <p>
            <?php
            echo Yii::t('model_labels', 'Paper Type', array(), NULL, $this->currentLang) . ":";
            ?>
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
        <p>
            <?php
            echo Yii::t('model_labels', 'No Of Pages', array(), NULL, $this->currentLang) . ":";
            ?>
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
        <p>
            <?php
            echo Yii::t('model_labels', 'Edition', array(), NULL, $this->currentLang) . ":";
            ?>
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
