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
$this->widget('ext.lyiightbox.LyiightBox2', array(
));
/**
 * product preview
 */
if($this->action->id == "productPreview"){
        Yii::app()->clientScript->registerScript('disabled', "
            dtech.disabledPrview();
        ", CClientScript::POS_READY);
}
?>
<div id="left_description">
    <div id="image_detail">
        <div class="left_detail" id="img_detail">
            <?php echo $this->renderPartial("//product/_product_detail_image", array("product" => $product)) ?>
        </div>
        <div id="prod_detail">
            <?php
            echo $this->renderPartial("//product/_product_detail_data", array("product" => $product, "rating_value" => $rating_value));
            ?>
        </div>

    </div>
</div>
<?php $this->renderPartial("//product/_editorial_reviews", array("product" => $product, "rating_value" => $rating_value)); ?>   
<?php //$this->renderPartial("//product/_related_products", array("product" => $product, "rating_value" => $rating_value)); ?>
<?php $this->renderPartial("//product/_product_comments", array("product" => $product, "rating_value" => $rating_value)); ?>

