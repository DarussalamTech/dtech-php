<!DOCTYPE html>
<html>
    <head>
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl ?>/packages/jui/js/jquery.js"></script>
        <title>Darussalam</title>
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl ?>/css/style.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl ?>/css/popup_style.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl ?>/css/footer_style.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl ?>/css/login_style.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl ?>/css/msdropdown/dd.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl ?>/css/msdropdown/flags.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl ?>/css/customStyle.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl ?>/media/css/overlay.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl ?>/css/cart_view.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl ?>/css/page.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl ?>/js/dtech_new.js"></script>
        <script src="<?php echo Yii::app()->baseUrl; ?>/media/js/dtech.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl ?>/js/msdropdown/jquery.dd.min.js"></script>
        <script>
            var yii_base_url = "<?php echo Yii::app()->baseUrl; ?>";
            var yii_base_theme_url = "<?php echo Yii::app()->theme->baseUrl; ?>";
        </script>

        <script type="text/javascript">
            $(document).ready(function() {
                dtech_new.toggleLogin();
                dtech_new.toggleSideBar();
                dtech_new.footerToggle();

                dtech_new.registerCountryDropDown();
                jQuery("#LandingModel_country").msDropdown();
                jQuery("#countries").msDropdown();
                dtech_new.registerPopUp();

                if (jQuery("#LandingModel_city").attr("type") != "hidden") {
                    jQuery("#LandingModel_city").msDropdown();
                }

                dtech_new.changeBookImgHover();

            });
        </script>


    </head>
    <body>
        <div id="wraper">
            <header>
                <div id="left_header">
                    <?php
                    /**
                     * will perform the store change
                     * 
                     * 
                     */
                    $this->renderPartial("//layouts/_change_city");
                    ?>
                </div>
                <div id="right_header">
                    <?php
                    if (Yii::app()->user->isGuest) {
                        echo CHtml::openTag("span");
                        echo CHtml::link(Yii::t('header_footer', 'Sign Up', array(), NULL, $this->currentLang), $this->createUrl('/web/user/register'));
                        echo CHtml::closeTag("span");
                    }
                    ?>

                    <span>
                        <div id="login_contain">
                            <?php
                            if (!Yii::app()->user->isGuest) {
                                echo $this->renderPartial("//layouts/_logout_box");
                            } else {
                                $this->renderPartial("//layouts/_login_box");
                            }
                            ?>
                        </div>
                    </span>
                    <span>
                        <?php
                        echo CHtml::link(Yii::t('header_footer', 'Contact Us', array(), NULL, $this->currentLang), $this->createUrl('/site/contact'));
                        ?>
                    </span>
                    <span>
                        <?php echo CHtml::link(Yii::t('header_footer', 'Blog', array(), NULL, $this->currentLang), Yii::app()->createUrl('/?r=blog'), array("target" => "_blank")); ?>
                    </span>
                </div>
            </header>
            <div id="banner">
                <div id="upper_banner">
                    <div class="logo">
                        <?php
                        echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/logo_img_03.png", 'Logo'), $this->createUrl('/site/storeHome'));
                        ?>
                    </div>
                    <div class="search_with_box">
                        <div id="search-box">

                            <form id="search-form" method="post" 
                                  action="<?php echo $this->createUrl("/web/search/getSearch") ?>" target='_top'>

                                <a href="javascript:void(0)" onclick="dtech.doGloblSearch()" >
                                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/search_03.png" alt="search img" />
                                </a>

                                <?php
                                $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                                    'name' => 'serach_field',
                                    'source' => $this->createUrl("/web/search/dosearch"),
                                    // additional javascript options for the autocomplete plugin
                                    'options' => array(
                                        'minLength' => '1',
                                    ),
                                    'htmlOptions' => array(
                                        'id' => 'search-text',
                                        'value' => (isset($_POST['serach_field']) ? $_POST['serach_field'] : ""),
                                        'placeholder' => Yii::t('header_footer','type here',array(),NULL,$this->currentLang)
                                    ),
                                ));
                                ?>
                                <button id='search-button' type='submit' onclick="dtech.doGloblSearch()">
                                    <span>
                                        <?php echo Yii::t('header_footer','Search',array(),NULL,$this->currentLang) ?>
                                    </span>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="cart_part">
                        <div class="add_to_cart">
                            <ul>
                                <li>
                                    <?php
                                    $cart = Cart::model()->getCartLists();

                                    echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/shopping_cart_03.png"), $this->createUrl("/web/cart/viewcart"));
                                    echo "<div id='cart_control'>";
                                    $this->renderPartial("//cart/_cart", array("cart" => $cart));
                                    echo "</div>";
                                    ?>
                                </li>
                            </ul>
                        </div>
                        <div class="wishlist">
                            <?php
                            $this->renderPartial("//layouts/_wishlist");
                            ?>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <hr class="style-two">	
                </div>
                <div id="below_banner">
                    <div id="bar">
                        <div id="container">
                            <div id="sideBarContainer">

                                <?php
                                if (isset($this->webPcmWidget['filter'])) {

                                    $this->widget($this->webPcmWidget['filter']['name'], $this->webPcmWidget['filter']['attributes']);
                                }
                                ?>
                            </div>
                        </div>
                        <div class="best_seller">
                            <?php
                            if (isset($this->webPcmWidget['best'])) {

                                $this->widget($this->webPcmWidget['best']['name'], $this->webPcmWidget['best']['attributes']);
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
            <?php
            echo $content;
            ?>
    </body>

</html>
