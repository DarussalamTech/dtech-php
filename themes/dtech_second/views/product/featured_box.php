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
            <img src="<?php echo $image; ?>" />
            <h2><?php echo $name ?></h2>
            <p>Lorem ipsum color sit bla bla thhm ipoum deona</p>
        </div>
        <div class="featured_bottom">
            <span>$185.99</span>
            <div class="white_basket">
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/white_basket_03.jpg" />
            </div>
        </div>
    </div>

    <?php
endforeach;
?>
