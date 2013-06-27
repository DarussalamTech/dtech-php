<h2>Search Result</h2>
<?php
if (empty($data)) {
    echo "No Result Found";
} else {
    foreach ($data as $product) {
       echo CHtml::link($product['product_name'], Yii::app()->createUrl('/web/search/searchDetail', array('country' => $product['short_name'], 'city' => $product['city_short'], 'city_id' => $product['city_id'], 'product_id' => $product['product_id'])));
       echo "<div class='clear'></div>";
       
    }
}
?>