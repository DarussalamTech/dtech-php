<div class="pagingdiv">
    <?php
    $this->widget('DTPager', array(
        'pages' => $dataProvider->pagination,
        'ajax' => true,
        'append_param' => (!empty($_REQUEST['serach_field'])) ? "serach_field=" . $_REQUEST['serach_field'] : "",
        'jsMethod' => 'dtech.updatePaginationFilter(this);return false;',
            )
    );
    ?>
</div>
<div class="clear"></div>
<?php
foreach ($products as $product) {
    $name = $product['product_name'];

    $image = $product['no_image'];
    if (isset($product['image'][0]['image_small'])) {
        $image = $product['image'][0]['image_small'];
    }
    echo CHtml::openTag("div", array("class" => "featured_books", 'style' => 'padding:28px 50px'));
    
    if (Yii::app()->controller->action->id == "getSearch") {
        echo CHtml::link(CHtml::image($image, 'image', array('title' => $product['product_name'],"class"=>"detail_image")), Yii::app()->createUrl('/web/search/searchDetail', array('country' => $product['country_short'], 'city' => $product['city_short'], 'city_id' => $product['city_id'], 'product_id' => $product['product_id'])));
    } else {
        echo CHtml::link(CHtml::image($image, 'image', array('title' => $product['product_name'],"class"=>"detail_image")), $this->createUrl('/web/product/productDetail', array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'], 'product_id' => $product['product_id'])), array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'], 'product_id' => $product['product_id']));
    }
    //echo CHtml::link(CHtml::image($image, $name, array('style' => '', 'title' => $product['product_name'])), $this->createUrl('/web/product/productDetail', array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'], 'product_id' => $product['product_id'])), array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'], 'product_id' => $product['product_id']));

    echo CHtml::openTag("h3");
    echo implode(' ', array_slice(explode(' ', $name), 0, 4));
    echo CHtml::closeTag("h3");
    echo CHtml::openTag("p");
    echo $featured['product_description'];
    echo CHtml::closeTag("p");
    /*
     * 
     * temprary rendering ajax data work will be done here
     * because each product has its own data /image so with
     * ajax pass of product id will return to popup page with all data...
     */


    //$this->renderPartial('//product/_popup_product', array('image' => $image));
    ?>

    <div class = "loader"></div>
    <div id = "backgroundPopup"></div>
    <?php
    echo CHtml::closeTag("div");
}

if (empty($products)) {
    echo '<center><tt>';
    echo "Sorry Your searched  did not Matched.Try again";
    echo '</tt></center>';
}
?>
<div class="clear"></div>    
<div class="pagingdiv">

    <?php
    $this->widget('DTPager', array(
        'pages' => $dataProvider->pagination,
        'ajax' => true,
        'append_param' => (!empty($_REQUEST['serach_field'])) ? "serach_field=" . $_REQUEST['serach_field'] : "",
        'jsMethod' => 'dtech.updatePaginationFilter(this);return false;',
            )
    );
    ?>  
</div>
<div class="clear"></div>  
<div class="clear"></div>  
