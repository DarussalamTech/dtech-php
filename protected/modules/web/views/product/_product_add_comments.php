<?php
/**
 * product comments will be called from here
 * 
 */
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'login-form',
    'action' => $this->createUrl('/web/user/ProductReview'),
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
        ));
?>
<div class="comments">
    <div class="left_comments">
        <?php echo CHtml::image(Yii::app()->theme->baseUrl . "/images/talha_mujahid_img_03.png"); ?>
    </div>
    <div class="right_comments">
        <div>
            <?php echo CHtml::image(Yii::app()->theme->baseUrl . "/images/right_arrow_img_03.png", '', array("class" => "comment_arrow")); ?>
        </div>


        <?php
        $modelC = new ProductReviews;
        $pid = $product->product_id;
        if (Yii::app()->user->id != NUll) {
            echo $form->textArea($modelC, 'reviews', $htmlOptions = array('maxlength' => 300, 'rows' => '2', 'cols' => '59'));
        } else {
            echo $form->textArea($modelC, 'reviews', $htmlOptions = array('maxlength' => 300, 'rows' => '2', 'cols' => '59', 'readonly' => 'readonly'));
        }
        $this->widget('CStarRating', array(
            'name' => 'ratingUser',
            'minRating' => 1,
            'maxRating' => 5,
            'starCount' => 5,
            'value' => 3,
            'readOnly' => false,
        ));
        echo $form->hiddenField($modelC, 'product_id', array('value' => $pid));
        ?>

        <?php echo $form->checkBox($modelC, 'is_email', $htmlOptions = array('class' => 'comments_checkbox')); ?>
        <span>Send me an email for each new comment.</span>
        <?php
        if (Yii::app()->user->id != NUll) {
            echo CHtml::submitButton('Add Comments', array('class' => 'add_comment'));
        } else {
            echo CHtml::submitButton('Add Comments', $htmlOptions = array('class' => 'add_comment', 'disabled' => 'disabled'));
        }
        ?>
    </div>
</div>
<?php $this->endWidget(); ?>