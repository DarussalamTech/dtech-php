<div class="bottom_detail">
    <h2>
        <?php echo Yii::t('product_detail', 'Most Recent Customer Reviews', array(), NULL, $this->currentLang) ?>
    </h2>
    <?php
    if (!empty($product->product_reviews)) {
        foreach ($product->product_reviews as $rev) {
            echo CHtml::openTag("div", array("class" => "under_bottom_detail"));
            echo CHtml::openTag("div", array('class' => 'left_bottom_detail'));
            if (!empty($rev->user->userProfiles)) {
                echo CHtml::image($rev->user->userProfiles->uploaded_img, "", array('style' => 'width:65px;height:75px;'));
            } else {

                echo CHtml::image(Yii::app()->baseUrl . "/images/noImage.png", "");
            }

            echo CHtml::closeTag("div");

            echo CHtml::openTag("div", array('class' => 'right_bottom_detail'));

            echo CHtml::openTag("p", array('style' => ' width: 178%;'));
            echo!empty($rev->reviews) ? $rev->reviews : "";
            echo CHtml::closeTag("p");
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
            echo CHtml::openTag("p");
            echo 'Published ' . $rev->calculateRemTime() . "ago by ";
//            echo!empty($rev->user->userProfiles->first_name) ? $rev->user->userProfiles->first_name : $rev->user->user_email;
//            echo!empty($rev->user->userProfiles->last_name) ? $rev->user->userProfiles->last_name : "";
            echo CHtml::openTag("span", array("style" => "color:#089AD4;"));
            if (!empty($rev->user->userProfiles->first_name)) {

                echo $rev->user->userProfiles->first_name.' ';
            }
            if (!empty($rev->user->userProfiles->last_name)) {

                echo $rev->user->userProfiles->last_name.' ';
            } else if (empty($rev->user->userProfiles->first_name) && empty($rev->user->userProfiles->last_name)) {
                echo $rev->user->user_email;
            }
            echo CHtml::closeTag("span");
            echo CHtml::closeTag("p");

            echo CHtml::closeTag("div");

            echo CHtml::closeTag("div");
        }
    } else {
        echo CHtml::openTag("div", array("class" => "right_bottom_detail"));
        echo CHtml::openTag("p");
        echo 'No Reviews Yet';
        echo CHtml::closeTag("p");
        echo CHtml::openTag("p");
        echo 'Be the first person to give the comment for this product';
        echo CHtml::closeTag("p");
        echo CHtml::closeTag("div");
    }
    ?>
    <div class="under_bottm_detail">
        <?php
        $this->renderPartial("//product/_product_add_comments", array("product" => $product));
        ?>
    </div>
</div>