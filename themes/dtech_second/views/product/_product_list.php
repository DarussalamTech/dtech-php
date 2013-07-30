<?php
foreach ($products as $product) {
    $name = $product['product_name'];

    $image = $product['no_image'];
    if (isset($product['image'][0]['image_small'])) {
        $image = $product['image'][0]['image_small'];
    }
    echo CHtml::openTag("div", array("class" => "featured_cover"));
    echo CHtml::openTag("div", array("class" => "featured_cover_part", 'style' => 'height: 232px;'));

    if (Yii::app()->controller->action->id == "getSearch") {
        echo CHtml::link(CHtml::image($image, 'image', array("title" => $name)), Yii::app()->createUrl('/web/search/searchDetail', array('country' => $product['country_short'], 'city' => $product['city_short'], 'city_id' => $product['city_id'], 'product_id' => $product['product_id'])));
    } else {

        echo CHtml::link(CHtml::image($image, 'image', array("title" => $name)), $this->createUrl('/web/product/productDetail', array(
                    'country' => Yii::app()->session['country_short_name'],
                    'city' => Yii::app()->session['city_short_name'],
                    'city_id' => Yii::app()->session['city_id'],
                    "pcategory" => $category,
                    "slug" => $product['slug'],
                ))
        );
    }
    echo CHtml::openTag("h2");
    echo substr($name, 0, 15) . '...';
    echo CHtml::closeTag("h2");
    echo CHtml::openTag("p");
    echo substr($product['product_overview'], 0, 35) . '...';
    echo CHtml::closeTag("p");
    echo CHtml::closeTag("div");
    echo CHtml::openTag("div", array("class" => "featured_bottom"));
    echo CHtml::openTag("span");
    echo round($product['product_price'], 2) . ' ' . Yii::app()->session['currency'];
    echo CHtml::closeTag("span");
    echo CHtml::openTag("div", array('class' => 'white_basket'));
    echo CHtml::image(Yii::app()->theme->baseUrl . '/images/white_basket_03.jpg');
    echo CHtml::closeTag("div");
    echo CHtml::closeTag("div");
    ?>
    <div class = "loader"></div>
    <div id = "backgroundPopup"></div>
    <?php
    echo CHtml::closeTag("div");
    /*
     * temprary rendering ajax data work will be done here
     * because each product has its own data /image so with
     * ajax pass of product id will return to popup page with all data...
     */
    //$this->renderPartial('//product/_popup_product', array('image' => $image));
}
if (empty($products)) {
    echo '<center><tt>';
    echo "Sorry Your searched  did not Matched.Try again";
    echo '</tt></center>';
}
?>
<div class="clear"></div>
<div class="pagingdiv" style="display: none" >
    <?php
    $this->widget('DTScroller', array(
        'pages' => $dataProvider->pagination,
        'ajax' => true,
        'append_param' => (!empty($_REQUEST['serach_field'])) ? "serach_field=" . $_REQUEST['serach_field'] : "",
        'jsMethod' => 'dtech.updateListingOnScrolling(this);return false;',
            )
    );
    ?>
</div>

