<?php

/**
 * rendering all products listing
 */
echo $this->renderPartial('//product/product_listing', array(
    'products' => $products,
    'dataProvider' => $dataProvider,
    'category_product' => isset($category_product)?$category_product:"",
    'allCate' => $allCate)
);

?>
