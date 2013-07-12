<h1>BROWSE BY CATEGORY</h1>

<div class="browse">
    <?php
    foreach ($segments_footer_cats as $cats) :
        ?>
        <div class="section_list">
            <ul>
                <?php
                foreach ($cats as $cat_id => $cat) {
                    echo CHtml::openTag("li");
                    echo CHtml::link($cat, $this->createUrl('/web/product/allproducts') . "#cat=" . $cat_id);
                    echo CHtml::closeTag("li");
                }
                ?>

            </ul>
        </div>
        <?php
    endforeach;
    ?>


</div>    
<div id="left_books">

    <h2>FEATURED PRODUCTS <span><?php echo CHtml::link('( VIEW ALL )', array('/web/product/featuredProducts', 'country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id']), array('class' => 'blue-title-link')); ?></span></h2>

    <?php
    foreach ($featured_products as $featured) {
        $name = $featured['product_name'];

        $image = $featured['no_image'];
        if (isset($featured['image'][0]['image_small'])) {
            $image = $featured['image'][0]['image_small'];
        }
        echo CHtml::openTag("div", array("class" => "books", 'style' => 'width:150px'));
        echo CHtml::link(CHtml::image($image, $name), $this->createUrl('/web/product/productDetail', array('product_id' => $featured['product_id'])), array('title' => $name));
        echo CHtml::openTag("p");
        echo CHtml::link(implode(' ', array_slice(explode(' ', $name), 0, 4)), $this->createUrl('/web/product/productDetail'));
        echo CHtml::closeTag("p");
        echo CHtml::closeTag("div");
    }
    ?>
</div>
<div id="right_books">
    <h2>BEST SELLING BOOKS <span><?php echo CHtml::link('( VIEW ALL )', array('/web/product/bestSellings', 'country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id']), array('class' => 'blue-title-link')); ?></h2>

    <?php
    $order_detail = new OrderDetail;
    $dataProvider = $order_detail->bestSellings(5);
    $best_sellings = $order_detail->getBestSelling($dataProvider);

    
    foreach ($best_sellings as $bests) {
        $pro_name = $bests['product_name'];
        $orders = $bests['totalOrder'];
        $image = $bests['no_image'];

        if (isset($bests['image'][0]['image_small'])) {
            $image = $bests['image'][0]['image_small'];
        }
        echo CHtml::openTag("div", array("class" => "books", 'style' => 'width:150px'));
        echo CHtml::link(CHtml::image($image, $pro_name), $this->createUrl('/web/product/productDetail', array('product_id' => $bests['product_id'])), array('title' => $pro_name));
        echo CHtml::openTag("p");
        echo CHtml::link(implode(' ', array_slice(explode(' ', $pro_name), 0, 4)), $this->createUrl('/web/product/productDetail'));
        echo CHtml::closeTag("p");
        echo CHtml::closeTag("div");
    }
    ?>
</div>
