<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <link href="<?php echo Yii::app()->theme->baseUrl ?>/css/landing.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl ?>/packages/jui/js/jquery.js"></script>
        <script src="<?php echo Yii::app()->baseUrl; ?>/media/js/dtech.js"></script>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">


        <title>Landing Page</title>
    </head>
    <body>
        <div id="landing_page">
            <a href="#"><img src="<?php echo Yii::app()->theme->baseUrl ?>/images/darussalam_big_logo_03.png" /></a>
        </div>
        <div id="landing_banner">
            <div class="landing_banner_part">
                <div class="main_numbers">
                    <h1>15,008</h1>
                    <p>
                        <?php echo Yii::t('common', 'Members Shopping', array(), NULL, $this->currentLang); ?>
                    </p>
                </div>
                <div class="landing_logo_bg">
                    <div class="landing_logo_part">
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
                            <h2>
                                <?php echo Yii::t('common', 'Select Your Country', array(), NULL, $this->currentLang); ?>
                            </h2>
                            <div class="custom-select">
                                <?php
                                /*
                                *  selecting just status = 1
                                 * dats is enabled by user
                                */
                                $criteria = new CDbCriteria;
                                $criteria->addCondition("t.c_status = 1");
                                
                                echo $form->dropDownList($model, 'country', CHtml::listData(Country::model()->with(
                                                        array('cities' => array('join' => 'JOIN city ON city.country_id = t.country_id',))
                                                )->findAll($criteria), 'country_id', 'country_name'), array(
                                    'empty' => 'Please Select Country',
                                    'onchange' => ' 
                                jQuery(".enter_button").hide();
                                dtech.updateElementAjax("' . $this->createDTUrl('/CommonSystem/getCity') . '","cities","LandingModel_country")
                                jQuery(".enter_button").show();    
                                '));
                                ?>
                            </div>
                            <div class="custom-select">
                                <div id="cities">

                                </div>
                            </div>
                            <div class="status" style="color:red">
                              <?php 
                                    if(Yii::app()->user->hasFlash("error")):
                                        echo Yii::app()->user->getFlash("error");
                                    endif;
                               ?>
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
                </div>
                <div class="lamp">
                    <img src="<?php echo Yii::app()->theme->baseUrl ?>/images/lamp_img_02.png" />
                </div>
                <div class="numbers">
                    <h1>235,875</h1>
                    <p>
                        <?php echo Yii::t('common', 'Active Members', array(), NULL, $this->currentLang); ?>                        
                    </p>
                </div>
            </div>
        </div>
        <div class="landing_full_page">
            <div class="bottom_landing">
            </div>
        </div>
    </body>
</html>