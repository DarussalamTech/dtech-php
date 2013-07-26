<div id="description_content">
    <h4>Most Recent Customer Reviews</h4>
    <?php
    if (!empty($product->product_reviews)) {
        foreach ($product->product_reviews as $rev) {
            echo CHtml::openTag("div", array("class" => "stars_description"));
            echo CHtml::openTag("div", array('class' => 'left_comments'));
            echo CHtml::image(Yii::app()->baseUrl . "/images/noImage.png");
            echo CHtml::closeTag("div");

            echo CHtml::openTag("div", array('class' => 'right_comments'));
            echo CHtml::openTag("p");
            $this->widget('CStarRating', array(
                'name' => 'rating' . $rev->reviews_id,
                'minRating' => 1,
                'maxRating' => 5,
                'starCount' => 5,
                'value' => $rev->rating,
                'readOnly' => TRUE,
            ));

            echo $rev->reviewType($rev->rating);
            echo CHtml::closeTag("p");
            echo CHtml::openTag("article");
            echo!empty($rev->reviews) ? $rev->reviews : "";
            echo CHtml::closeTag("article");
            echo CHtml::openTag("section");
            echo 'Published ' . $rev->calculateRemTime() . "ago by ";
            echo!empty($rev->user->userProfiles->last_name) ? $rev->user->userProfiles->last_name : $rev->user->user_email;
            echo CHtml::closeTag("section");

            echo CHtml::closeTag("div");

            echo CHtml::closeTag("div");
            
            echo CHtml::Tag("div",array("class"=>"clear"));
        }
    } else {
        echo CHtml::openTag("div", array("class" => "stars_description"));
        echo CHtml::openTag("article");
        echo 'No Reviews Yet';
        echo CHtml::closeTag("article");
        echo CHtml::openTag("section");
        echo 'Be the first person to give the comment for this product';
        echo CHtml::closeTag("section");
        echo CHtml::closeTag("div");
    }
    ?>

</div>
<?php
$this->renderPartial("//educationToys/_product_add_comments", array("product" => $product));
?>
<div class="clear"></div>