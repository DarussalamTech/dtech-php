<?php

foreach ($products as $product):
    $name = str_replace("_", " ", $product['product_name']);

    $image = $product['no_image'];
    if (isset($product['image'][0]['image_small'])) {
        $image = $product['image'][0]['image_small'];
    }
    ?>
    <div class="featured_cover">
        <div class="featured_cover_part">
           
            <?php
            echo CHtml::link(CHtml::image($image, ""), $this->createUrl('/web/product/productDetail', array('product_id' => $product['product_id'])), array('title' => $name));
            ?>
            <h2><?php echo $name ?></h2>
            <p>
                <?php
                if (!empty($product['product_overview'])) {
                    echo substr($product['product_overview'], 0, 20);
                } else {
                    echo "&nbsp;";
                }
                ?>
            </p>
        </div>
        <div class="featured_bottom">
            <span><?php  echo Yii::app()->session['currency']." ".$product['product_price']; ?></span>
            <div class="white_basket">
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/white_basket_03.jpg" />
            </div>
        </div>
    </div>

    <?php
endforeach;
?>
