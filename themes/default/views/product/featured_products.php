<?php

echo $this->renderPartial('product_listing', array(
    'dataProvider' => $dataProvider,
    'products' => $products,
    'allCate' => $allCate));
?>
