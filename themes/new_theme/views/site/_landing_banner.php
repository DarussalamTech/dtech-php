<div id="landing_banner">
    <div class="landing_logo_part">
        <div class="landing_logo">
            <?php echo CHtml::image(Yii::app()->theme->baseUrl . "/images/landing_page_logo_img_03.png", '') ?>
        </div>
        <div class="landing_logo_right">
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'country_selection_form',
                'action' => Yii::app()->createUrl('/site/countryLanding'),
                'enableClientValidation' => FALSE,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),
            ));
            ?>
            <div class="landing_arrow">
                <?php echo CHtml::image(Yii::app()->theme->baseUrl . "/images/right_arrow_img_03.png", '') ?>
            </div>
            <h1>Darussalam</h1>
            <span>Your authentic source of knowledge</span>

            <h2>Select Your Country</h2>
            <?php
            echo CHtml::dropDownList('country_id', '', CHtml::listData(Country::model()->findAll(), 'country_id', 'country_name'), array('prompt' => 'Select Your Country'));
            ?>
            <h3>Remember me</h3>
            <div class="onoffswitch">
                <?php
                echo CHtml::checkBox('onoffswitch', 'checked', array("class" => "onoffswitch-checkbox", "id" => "myonoffswitch"));
                ?>
                <label class="onoffswitch-label" for="myonoffswitch">
                    <div class="onoffswitch-inner"></div>
                    <div class="onoffswitch-switch"></div>
                </label>
            </div>

            <?php echo CHtml::submitButton("Enter", array("class" => "enter_button")) ?>
            <?php $this->endWidget(); ?>
        </div>
    </div>
    <div class="numbers">
        <span>15,008 Members Shopping</span>
        <span>235,875 Active Members</span>
    </div>
</div>