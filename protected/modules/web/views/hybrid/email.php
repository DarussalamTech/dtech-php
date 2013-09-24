<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - Social Email';
$this->breadcrumbs = array(
    'Email',
);
?>

<div id="book_content">
    <div id="book_main_content">
        <div class="left_book_main_content">
            <?php
            echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/darussalam-inner-logo.png"), $this->createUrl('/site/storehome', array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'])));
            ?>
        </div>
        <div class="search_box">
            <input type="text" placeholder="Search keywords or image ids..." value="" class="search_text" />
            <input type="button" name="" value="" class="search_btn" />
            <?php echo CHtml::image(Yii::app()->theme->baseUrl . "/images/searching_img_03.jpg", '', array('class' => 'searching_img')) ?>
        </div>
        <nav>
            <ul>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Contact Us</a></li>
                <li><a href="#">Help</a></li>
            </ul>
        </nav>
    </div>
</div>
<div id="user_login">
    <div id="main_user_login">
       
        <?php //echo $this->renderPartial('_sign_up', array('model'=>$model)); ?>
        <?php echo $this->renderPartial('_email', array('model' => $model)); ?>
    </div>
</div>