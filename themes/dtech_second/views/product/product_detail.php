
<?php
$this->widget('ext.lyiightbox.LyiightBox2', array(
));
/**
 * product preview
 */
if ($this->action->id == "productPreview") {
    Yii::app()->clientScript->registerScript('disabled', "
            dtech.disabledPrview();
        ", CClientScript::POS_READY);
}

Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/detail.css');
$this->widget('ext.lyiightbox.LyiightBox2', array(
));
?>
<div id="main_features_part">
    <div id="book_detail">

        <div class="upper_detail">
            <div class="left_upper_part">
                <?php echo $this->renderPartial("//product/_product_detail_image", array("product" => $product)) ?>
            </div>
            <div class="right_upper_part">
                <?php
                echo $this->renderPartial("//product/_product_add_to_cart", array("product" => $product, "rating_value" => $rating_value));
                ?>
            </div>

        </div>

        <div id="detail_data">
            <div class="center_detail">
                <?php
                echo $this->renderPartial("//product/_product_detail_data", array("product" => $product, "rating_value" => $rating_value));
                ?>
            </div>
            <div class='clear'></div>
            <div id='gridd'>
                <?php
                if (count($product->productProfile) > 1) {
                    echo CHtml::openTag('div', array('id' => 'right_description'));
                    $this->renderPartial("//product/_profile_items", array("product" => $product));
                    echo CHtml::closeTag('div');
                }
                ?>
            </div>
            <?php $this->renderPartial("//product/_product_comments", array("product" => $product, "rating_value" => $rating_value)); ?>    
        </div>

    </div>
</div>


