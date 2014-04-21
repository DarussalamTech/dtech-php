

<div class="under_bottm_detail">
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
    <div class="left_bottom_detail">
        <?php
        if (isset(UserProfile::model()->findByPk(Yii::app()->user->id)->avatar)) {
            echo CHtml::image(UserProfile::model()->findByPk(Yii::app()->user->id)->uploaded_img, "", array('style' => 'width:65px;height:75px;'));
        } else {
            echo CHtml::image(Yii::app()->baseUrl . "/images/noImage.png", "");
        }
        ?>
    </div>
    <div class="right_bottom_detail">



        <?php
        $modelC = new ProductReviews;
        $pid = $product->product_id;
        if (Yii::app()->user->id != NUll) {
            echo $form->textArea($modelC, 'reviews', $htmlOptions = array('rows' => '4', 'cols' => '55'));
        } else {
            echo $form->textArea($modelC, 'reviews', $htmlOptions = array('rows' => '4', 'cols' => '55', 'readonly' => 'readonly'));
        }

        echo $form->hiddenField($modelC, 'product_id', array('value' => $pid));
        echo CHtml::openTag('br');
        ?>

        <?php
        $this->widget('CStarRating', array(
            'name' => 'ratingUser',
            'minRating' => 1,
            'maxRating' => 5,
            'starCount' => 5,
            'value' => 3,
            'readOnly' => false,
        ));
        echo CHtml::openTag('br');
        ?>
        <?php
        if (Yii::app()->user->id != NUll) {
            echo CHtml::submitButton(Yii::t('common', 'Add Comments', array(), NULL, $this->currentLang),array('class'=>'submit_comment'));
        } else {
            echo CHtml::submitButton(Yii::t('common', 'Add Comments', array(), NULL, $this->currentLang), array('disabled' => 'disabled','class'=>'submit_comment'));
        }
        ?>
    </div>
    <?php $this->endWidget(); ?>

</div>


