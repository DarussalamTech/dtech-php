<div class="clear"></div>

<div class="comments">
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
    <div class="left_comments">
        <?php echo CHtml::image(Yii::app()->baseUrl . "/images/noImage.png"); ?>
    </div>
    <div class="right_comments">



        <?php
        $modelC = new ProductReviews;
        $pid = $product->product_id;
        if (Yii::app()->user->id != NUll) {
            echo $form->textArea($modelC, 'reviews', $htmlOptions = array('maxlength' => 300, 'rows' => '2', 'cols' => '59'));
        } else {
            echo $form->textArea($modelC, 'reviews', $htmlOptions = array('maxlength' => 300, 'rows' => '2', 'cols' => '59', 'readonly' => 'readonly'));
        }

        echo $form->hiddenField($modelC, 'product_id', array('value' => $pid));
        ?>

        <div class="clear"></div>
        <div>
            <?php
            if (Yii::app()->user->id != NUll) {
                echo CHtml::submitButton('Add Comments', array('class' => 'add_comment'));
            } else {
                echo CHtml::submitButton('Add Comments', $htmlOptions = array('class' => 'add_comment', 'disabled' => 'disabled'));
            }
            ?>
        </div>
        <div>
            <?php
            $this->widget('CStarRating', array(
                'name' => 'ratingUser',
                'minRating' => 1,
                'maxRating' => 5,
                'starCount' => 5,
                'value' => 3,
                'readOnly' => false,
            ));
            ?>
        </div>


    </div><br></br><br></br><br></br>
    <?php $this->endWidget(); ?>

</div>


