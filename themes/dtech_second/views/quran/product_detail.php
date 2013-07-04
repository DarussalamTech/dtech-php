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
$this->widget('ext.lyiightbox.LyiightBox2', array(
));
?>

<div id="left_description">
    <div id="image_detail">
        <div class="left_detail" id="img_detail">
            <?php echo $this->renderPartial("//quran/_product_detail_image", array("product" => $product)) ?>
        </div>
        <div id="prod_detail">
            <?php
            echo $this->renderPartial("//quran/_product_detail_data", array("product" => $product, "rating_value" => $rating_value));
            ?>
        </div>

    </div>
</div>
<?php
if (count($product->productProfile) > 1) {
    echo CHtml::openTag('div', array('id' => 'right_description'));
    $this->renderPartial("//product/_profile_items", array("product" => $product));
    echo CHtml::closeTag('div');
}
?>
<?php $this->renderPartial("//product/_editorial_reviews", array("product" => $product, "rating_value" => $rating_value)); ?>   
<?php //$this->renderPartial("//product/_related_products", array("product" => $product, "rating_value" => $rating_value)); ?>
<?php $this->renderPartial("//product/_product_comments", array("product" => $product, "rating_value" => $rating_value)); ?>
