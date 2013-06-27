<?php

/**
 * rendering all products listing
 */

 $this->renderPartial('//product/product_listing', array(
    'products' => $products,
    'dataProvider'=>$dataProvider,
    'allCate' => $allCate)
);

?>
<?php 
    /**
     * for checking ajax based link
     */
    $page = 1 ;
    if(isset($_REQUEST['Product_page'])){
        $page = $_REQUEST['Product_page'];
    }
    Yii::app()->clientScript->registerScript('change_cat_script', '
        dtech.loadallPrdoucts_Cat("'.$this->createUrl("/web/product/allproducts",array("Product_page"=>$page)).'");
    ', CClientScript::POS_READY);
?>
