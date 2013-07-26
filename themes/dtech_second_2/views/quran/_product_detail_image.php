<?php

$detail_img = $product->no_image;
if (!empty($product->productProfile[0])) {
    if (!empty($product->productProfile[0]->productImages[0])) {
        $detail_img = CHtml::image($product->productProfile[0]->productImages[0]->image_url['image_large'], '', array("id" => "large_image", 'style' => 'width:124px; height:181px'));
        echo CHtml::link($detail_img, $product->productProfile[0]->productImages[0]->image_url['image_large'], array("rel" => 'lightbox[_default]',));
    } else {
        $detail_img = CHtml::image($product->no_image);
        echo CHtml::link($detail_img, $product->no_image, array("rel" => 'lightbox[_default]','style' => 'width:124px; height:181px'));
    }
    ?>

    <?php
    /*
     * For future design
    foreach ($product->productProfile[0]->productImages as $img) {

        echo CHtml::image($img->image_url['image_small'], '', array("width" => "66px", "height" => "95px", "large_image" => $img->image_url['image_large']));
    }    
     */
}
?>