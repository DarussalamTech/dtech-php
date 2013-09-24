<!DOCTYPE html>
<html>
    <head>
        <title>Darussalam Blog</title>
        <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/sign_in2.js"></script>
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/msdropdown/dd.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/msdropdown/flags.css" />
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/sign_in.js"></script>
        <script src="<?php echo Yii::app()->baseUrl; ?>/media/js/dtech.js"></script>

        <script>
            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id))
                    return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=<?php echo Yii::app()->params['fb_key']; ?>";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
    </head>

    <body>
        <div id="wraper">
            <header>
                <div id="logo_img">
                    <?php
                    echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . '/images/logo_img_03.jpg', "logo image"), Yii::app()->createUrl('../?r=blog'));
                    ?>
                </div>
                <div class="right_middle">
                    <div id="text">
                        <?php if (!Yii::app()->user->isGuest) {
                            ?>
                            <?php
                            echo CHtml::link('Sign Out', Yii::app()->createUrl('/site/logout'), array("class" => "button", "style" => "margin-top: -7px;"));
                        } else {
                            ?>
                            <div class="example2">
                                <h1>Sign In</h1>
                                <p>
                                    <?php
                                    $login_model = new LoginForm;
                                    echo $login_model->getAttributeLabel('username');
                                    echo CHtml::beginForm(Yii::app()->controller->createUrl('/site/login'),'post',array("id"=>"login-form"));
                                    ?>
                                </p>
                                <?php echo CHtml::activeTextField($login_model, 'username', $htmlOptions = array("class" => "second")); ?>
                                <p>
                                    <?php
                                    echo $login_model->getAttributeLabel('password');
                                    ?>
                                </p>
                                <?php echo CHtml::activePasswordField($login_model, 'password', $htmlOptions = array("class" => "second")); ?>
                                <?php echo CHtml::activeCheckBox($login_model, 'rememberMe', $htmlOptions = array("class" => "check")); ?>
                                <span>
                                    <?php
                                    echo $login_model->getAttributeLabel('rememberMe');
                                    echo CHtml::activeHiddenField($login_model,'route',array("value"=>Yii::app()->request->getUrl()));
                                    ?>
                                </span>
                                <?php
                                echo CHtml::link('Forgot Password', Yii::app()->controller->createUrl('/web/user/forgot', array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'])), array('class' => 'forgot'));
                                ?>
                                <div class="sign_in_button">
                                    <?php echo CHtml::submitButton("Sign In", array("class" => "btn")); ?>
                                </div>
                                <?php echo CHtml::endForm(); ?>
                                <h2 class="signinp">Sign in with</h2>
                                <div class="sign_in">
                                    <?php
                                    echo CHtml::link(
                                            CHtml::image(Yii::app()->theme->baseUrl . '/images/facebook_img_03.jpg').CHtml::button('Facebook', array("class" => "f_img")), Yii::app()->controller->createUrl('/web/hybrid/login/', array("provider" => "Facebook")),
                                            array("onclick"=>"dtech.doSocial('login-form',this);return false;")
                                            );
                                  
                                    ?>
                                </div>
                                <div class="sign_in">
                                    <?php
                                    echo CHtml::link(
                                            CHtml::image(Yii::app()->theme->baseUrl . '/images/linkedin_img_03.jpg').CHtml::button('Linkedin', array("class" => "l_img")), Yii::app()->controller->createUrl('/web/hybrid/login/', array("provider" => "Linkedin")),
                                            array("onclick"=>"dtech.doSocial('login-form',this);return false;")
                                            );
                                    
                                    ?>
                                </div>
                                <div class="sign_in">
                                    <?php
                                    echo CHtml::link(
                                            CHtml::image(Yii::app()->theme->baseUrl . '/images/twitter_img_03.jpg').CHtml::button('Twitter', array("class" => "t_img")), Yii::app()->controller->createUrl('/web/hybrid/login/', array("provider" => "twitter")),
                                            array("onclick"=>"dtech.doSocial('login-form',this);return false;")
                                            );
                                   
                                    ?>
                                </div>
                                <div class="sign_in">
                                    <?php
                                    echo CHtml::link(
                                            CHtml::image(Yii::app()->theme->baseUrl . '/images/google_img_03.jpg').CHtml::button('Google', array("class" => "g_img")), Yii::app()->controller->createUrl('/web/hybrid/login/', array("provider" => "Google")),
                                            array("onclick"=>"dtech.doSocial('login-form',this);return false;")
                                            );
                                    
                                    ?>
                                </div>
                                <h3 class="dont">Don't have account?</h3>
                                <div class="sign_up_button">

                                    <?php
                                    echo CHtml::link(CHtml::button('Sign Up', array("class" => "btn")), Yii::app()->controller->createUrl('/web/user/register', array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'])));
                                    ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </header>
        </div>

