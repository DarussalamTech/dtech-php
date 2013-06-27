<?php
$this->webPcmWidget['filter'] = array('name' => 'DtechSecondSidebar',
    'attributes' => array(
        'cObj' => $this,
        'cssFile' => Yii::app()->theme->baseUrl . "/css/side_bar.css",
        'is_cat_filter' => 1,
        ));
?>
<?php
$this->webPcmWidget['best'] = array('name' => 'DtechBestSelling',
    'attributes' => array(
        'cObj' => $this,
        'cssFile' => Yii::app()->theme->baseUrl . "/css/side_bar.css",
        'is_cat_filter' => 0,
        ));
?>

<?php

/**
 * rendering all products listing
 */
echo $this->renderPartial('//quran/product_listing', array(
    'products' => $products,
    'dataProvider'=>$dataProvider,
    'allCate' => $allCate)
);

?>


<?php
/**
 * for checking ajax based link
 */
$page = 1;
if (isset($_REQUEST['Product_page'])) {
    $page = $_REQUEST['Product_page'];
}
Yii::app()->clientScript->registerScript('change_cat_script', '
dtech.loadallPrdoucts_Cat("' . $this->createUrl("/web/quran/index", array("Product_page" => $page)) . '");
', CClientScript::POS_READY);
?>
