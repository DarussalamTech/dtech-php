<div id="landing_banner">
    <div class="landing_logo_part">
        <div class="landing_logo">
            <?php echo CHtml::image(Yii::app()->theme->baseUrl . "/images/landing_page_logo_img_03.png", '') ?>
        </div>
        <div class="landing_logo_right">
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'country_selection_form',
                'action' => Yii::app()->createUrl('/site/storeHome'),
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
            <span>
                <?php echo Yii::t('common', 'Your authentic source of knowledge', array(), NULL, $this->currentLang); ?>
            </span>

            <h2>
                <?php echo Yii::t('common', 'Select Your Country', array(), NULL, $this->currentLang); ?>
            </h2>
            <?php
            echo $form->dropDownList($model, 'country', CHtml::listData(Country::model()->with(
                                    array('cities' => array('join' => 'JOIN city ON city.country_id = t.country_id',))
                            )->findAll(), 'country_id', 'country_name'), array(
                'empty' => 'Please Select Country',
                'onchange' => ' 
                                jQuery(".enter_button").hide();
                                dtech.updateElementAjax("' . $this->createDTUrl('/CommonSystem/getCity') . '","cities","LandingModel_country")
                                jQuery(".enter_button").show();    
                                '));
            ?>
            <div id="cities">

            </div>
            <h3>
                <?php echo Yii::t('common', 'Remember me', array(), NULL, $this->currentLang); ?>
            </h3>
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
        <span>15,008 
            <?php echo Yii::t('common', 'Members Shopping', array(), NULL, $this->currentLang); ?>
        </span>
        <span>235,875 
            <?php echo Yii::t('common', 'Active Members', array(), NULL, $this->currentLang); ?>
        </span>
    </div>
</div>