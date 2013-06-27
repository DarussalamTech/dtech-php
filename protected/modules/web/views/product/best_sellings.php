<?php echo $this->renderPartial('product_listing', 
        array(
            'products' => $products, 
            'dataProvider' => $dataProvider,
            'allCate' => $allCate)); 
?>