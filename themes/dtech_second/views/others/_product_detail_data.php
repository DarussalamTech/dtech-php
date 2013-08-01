<div class="center_detail">

    <?php
    $profile_id = $product->productProfile[0]->id;
    $attributes = ProductAttributes::model()->ConfAttributes($profile_id);

    foreach ($attributes as $att) {
        echo CHtml::openTag('p');
        echo $att->books_rel->title, ' : ';
        echo $att->attribute_value;
        echo CHtml::closeTag('p');
    }
    ?>
    <?php $this->renderPartial("//product/_editorial_reviews", array("product" => $product, "rating_value" => $rating_value)); ?>
</div>
