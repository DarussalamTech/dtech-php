<?php

/**
 * rendering all products listing
 */
echo $this->renderPartial('//product/product_listing', array(
    'products' => $products,
    'dataProvider' => $dataProvider,
    'allCate' => $allCate)
);

?>
