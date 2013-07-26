<?php

$detail_img = $product->no_image;
if (!empty($product->other[0])) {
    if (!empty($product->other[0]->productImages[0])) {
        $detail_img = CHtml::image($product->other[0]->productImages[0]->image_url['image_large'], '', array("class" => "small_product_first", "id" => "large_image",'style' => 'width:124px; height:181px'));
        echo CHtml::link($detail_img, $product->other[0]->productImages[0]->image_url['image_large'], array("rel" => 'lightbox[_default]'));
    } else {
        $detail_img = CHtml::image($product->no_image);
        echo CHtml::link($detail_img, $product->no_image, array("rel" => 'lightbox[_default]'));
    }
?>
<?php

    }//end of parent if
?>