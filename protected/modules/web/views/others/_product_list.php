<?php
/**
 *  this code is resposible for rendering product list view
 *  against categories
 * 
 */
?>

<?php
foreach ($products as $product) {
    ?>
    <div class="condition" style="text-align: center">
        <?php
        $image = $product['no_image'];
        if (isset($product['image'][0]['image_small'])) {
            $image = $product['image'][0]['image_small'];
        }
        if (Yii::app()->controller->action->id == "getSearch") {
            echo CHtml::link(CHtml::image($image, 'image', array('title' => $product['product_name'])), Yii::app()->createUrl('/web/search/searchDetail', array('country' => $product['country_short'], 'city' => $product['city_short'], 'city_id' => $product['city_id'], 'product_id' => $product['product_id'])));
        } else {
            echo CHtml::link(CHtml::image($image, 'image', array('title' => $product['product_name'])), $this->createUrl('/web/others/productDetail', array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'], 'product_id' => $product['product_id'])), array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'], 'product_id' => $product['product_id']));
        }
        ?>
        <h3>
            <?php
            /**
             * in case search is global 
             * thats y all cities record
             */
            if (Yii::app()->controller->action->id == "getSearch") {
                echo CHtml::link($product['product_name'], Yii::app()->createUrl('/web/search/searchDetail', array('country' => $product['country_short'], 'city' => $product['city_short'], 'city_id' => $product['city_id'], 'product_id' => $product['product_id'])));
            } else {
                echo CHtml::link(implode(' ', array_slice(explode(' ', $product['product_name']), 0, 4)), $this->createUrl('/web/others/productDetail', array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'], 'product_id' => $product['product_id'])), array('title' => $product['product_name']));
            }
            ?>
        </h3>
        <p>
            <?php
            echo $product['product_author'];
            ?>
        </p>
        <article>&dollar;<?php echo round($product['product_price'], 2); ?></article>
    </div>
    <?php
}
if(empty($products)){
    echo "No Record Found";
}
echo CHtml::openTag("div", array("style" => "clear:both"));
echo CHtml::closeTag("div");
/**
 * pagination
 */
$this->widget('DTPager', array(
    'pages' => $dataProvider->pagination,
    'ajax'=>true,
    'append_param'=> (!empty($_REQUEST['serach_field']))?"serach_field=".$_REQUEST['serach_field']:"",
    'jsMethod' =>'dtech.updatePaginationFilter(this);return false;',
   )
);
?>
