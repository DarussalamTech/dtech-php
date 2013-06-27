<h3 class="credit_card_fields">Credit Card</h3>
<div class="under_left_method credit_card_fields" >
    <p>We accept Master Card, Visa, Discover and American Express.</p>
    <p><span>*</span> First Name</p>

    <?php echo $form->textField($creditCardModel, 'first_name', array('class' => 'payment_text')); ?>
    <?php echo $form->error($creditCardModel, 'first_name'); ?>


    <p><span>*</span> Last Name</p>
    <?php echo $form->textField($creditCardModel, 'last_name', array('class' => 'payment_text')); ?>
    <?php echo $form->error($creditCardModel, 'last_name'); ?>

    <p><span>*</span>  Card Number <i>(the 16 digits on the front of the card)</i></p>
    <?php echo $form->textField($creditCardModel, 'card_number1', array('class' => 'small_text', 'max-length' => '4', 'error' => "Box one can't be blank")); ?>
    <?php echo $form->textField($creditCardModel, 'card_number2', array('class' => 'small_text')); ?>
    <?php echo $form->textField($creditCardModel, 'card_number3', array('class' => 'small_text')); ?>
    <?php echo $form->textField($creditCardModel, 'card_number4', array('class' => 'small_text')); ?>

    <?php echo $form->error($creditCardModel, 'card_number1'); ?>
    <?php echo $form->error($creditCardModel, 'card_number2'); ?>
    <?php echo $form->error($creditCardModel, 'card_number3'); ?>
    <?php echo $form->error($creditCardModel, 'card_number4'); ?>

    <div class="payment_small_img">
        <a href="#">
            <?php echo CHtml::image(Yii::app()->theme->baseUrl . '/images/visa_big_img_03.png', 'Visa', '', array("class" => "visa_img")) ?>
        </a>
        <a href="#">
            <?php echo CHtml::image(Yii::app()->theme->baseUrl . '/images/master_card_big_img_03.png', '', array("class" => "visa_img")) ?>
        </a>
        <a href="#">
            <?php echo CHtml::image(Yii::app()->theme->baseUrl . '/images/discover_big_img_03.png', '', array("class" => "visa_img")) ?>
        </a>
        <a href="#">
            <?php echo CHtml::image(Yii::app()->theme->baseUrl . '/images/americanexpress_big_img_03.png', 'American Express') ?>
        </a>
    </div>

    <p><span>*</span> CVS or CVS <i>(Last 3 digits on back of card, Amex: 4 gigit code on front)</i></p>

    <?php echo $form->textField($creditCardModel, 'cvc', array('class' => 'small2_text')); ?>
    <?php echo $form->error($creditCardModel, 'cvc'); ?>
    <?php echo CHtml::image(Yii::app()->theme->baseUrl . '/images/card_img_03.png', 'scratch card', array("class" => "card_img")) ?>
    <p><span>*</span> Expiration Date</p>
    <div class="payment_option">
        <p class="monthnyear"> Month </p>
        <?php
        $exp_months = array(
            '01' => '01',
            '02' => '02',
            '03' => '03',
            '04' => '04',
            '05' => '05',
            '06' => '06',
            '07' => '07',
            '08' => '08',
            '09' => '09',
            '10' => '10',
            '11' => '11',
            '12' => '12',
        );
        echo $form->dropDownList($creditCardModel, 'exp_month', $exp_months);
        ?>
        <span> Year </span>

        <?php
        $exp_years = array(
            '13' => '2013',
            '14' => '2014',
            '15' => '2015',
            '16' => '2016',
            '17' => '2017',
            '18' => '2018',
            '19' => '2019',
            '20' => '2020',
        );
        echo $form->dropDownList($creditCardModel, 'exp_year', $exp_years);
        ?>
    </div>
    <div class="clear"></div>
    <?php echo $form->error($creditCardModel, 'exp_month'); ?>
</div>