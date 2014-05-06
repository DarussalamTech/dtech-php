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
    /**
     * if attributes are null then it wont be shown
     */
    if(empty($attributes)){
        echo "<style>";
            echo ".center_detail {display:none;}";
        echo "</style>";
    }
    ?>
   
</div>
