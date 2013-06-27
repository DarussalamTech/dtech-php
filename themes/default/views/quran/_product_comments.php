<?php
/**
 * Get all product comments
 */
foreach ($product->product_reviews as $rev) {
    ?>
    <div class="comments">
        <div class="left_comments">
            <?php
            if (isset($rev->user->userProfiles)) {
                echo CHtml::image($rev->user->userProfiles->uploaded_img, "", array("class" => "avtar_image_comment"));
            } else {
                echo CHtml::image(Yii::app()->theme->baseUrl . "/images/talha_mujahid_img_03.png", "", array("class" => "avtar_image_comment"));
            }
            ?>

            <h3>
                <?php
                echo!empty($rev->user->userProfiles->last_name) ? $rev->user->userProfiles->last_name : $rev->user->user_email;
                ?>
            </h3>
        </div>

        <div class="right_comments">
            <?php echo CHtml::image(Yii::app()->theme->baseUrl . "/images/right_arrow_img_03.png", '', array("class" => "comment_arrow")) ?>
            <p>
                <?php echo!empty($rev->reviews) ? $rev->reviews : ""; ?>
            </p>
            <h4>
                <?php
                echo $rev->calculateRemTime();
                echo "ago";
                echo CHtml::link("- Report as inappropriate", "#");
                ?>                  
            </h4>
            <div class="bottom_border">
                <?php
                $this->widget('CStarRating', array(
                    'name' => 'rating' . $rev->reviews_id,
                    'minRating' => 1,
                    'maxRating' => 5,
                    'starCount' => 5,
                    'value' => $rev->rating,
                    'readOnly' => TRUE,
                ));
                ?>
            </div>
        </div>
    </div>
<?php } ?>