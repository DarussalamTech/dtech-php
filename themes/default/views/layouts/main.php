<!DOCTYPE html>
<html>
    <head>
		<script type="text/javascript" src="<?php echo Yii::app()->baseUrl ?>/packages/jui/js/jquery.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/custom-style.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/gumby.css" />
        

        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/msdropdown/dd.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/accordion.core.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/core.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/msdropdown/flags.css" />
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/sign_in.js"></script>
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/media/css/overlay.css" />
        <script src="<?php echo Yii::app()->baseUrl; ?>/media/js/dtech.js"></script>
        <link href='<?php echo Yii::app()->theme->baseUrl; ?>/images/favicon.ico' rel='icon' type='image/x-icon'/>
        <title>Dar-us-Salam Publications</title>
        <script>
            var yii_base_url = "<?php echo Yii::app()->baseUrl; ?>";
        </script>
    </head>
    <body>
        <div id="loading" align="center" style="display: none;"> Please Wait </div>
        <header>
            <div id="main_header">
                <div class="pretty navbar" gumby-fixed="top" id="nav3">
                    <nav class="row">
                        <a class="toggle" gumby-trigger="#nav3 > .row > ul" href="#"><i class="icon-menu"></i></a>
                        <ul class="eight columns">
                            <?php
                            echo CHtml::openTag('li');
                            echo CHtml::link('BOOKS', $this->createUrl('/web/product/allproducts', array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'])));
                            echo CHtml::closeTag('li');

                            echo CHtml::openTag('li');
                            echo CHtml::link('Quran', $this->createUrl('/web/quran/index', array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'])));
                            echo CHtml::closeTag('li');

                            echo CHtml::openTag('li');
                            echo CHtml::link('EDUCATIONAL TOYS', $this->createUrl('/web/educationToys/index', array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'])));
                            echo CHtml::closeTag('li');

                            echo CHtml::openTag('li');
                            echo CHtml::link('OTHERS', $this->createUrl('/web/others/index', array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'])));
                            echo CHtml::openTag('li');
                            ?>
                        </ul>
                    </nav>
                </div>
                <div id="world">
                    <div id="input">

                        <?php
                        echo CHtml::form();
                        $model = new Country();
                        $login_model = new LoginForm;
                        $countriesList = array();
                        $countries = Country::model()->findAll();

                        if ($countries != null) {
                            foreach ($countries as $country) {
                                foreach ($country->cities as $city) {
                                    $countryList[] = array('city_id' => $city->city_id, 'city_name' => $city->city_name, 'country_name' => $country->country_name);
                                }
                            }
                        }


                        $countriesList = CHtml::listData($countryList, 'city_id', 'city_name', 'country_name');
                        echo CHtml::dropDownList('city_id', '', $countriesList, array(
                            'options' => array(Yii::app()->session['city_id'] => array('selected' => true)),
                            'ajax' => array(
                                'type' => 'POST',
                                'dataType' => 'json',
                                'data' => array('city_id' => 'js:$(\'#city_id\').val()'),
                                'url' => $this->createUrl('/site/storechange'),
                                'success' => 'function(data) {
                                                            window.location.href=data.redirect
                                                           }',
                            ),
                                ), $htmlOptions = array('id' => 'countries', 'style' => 'width:500px;')
                        );
                        echo CHtml::endForm();
                        ?>
                        <script>
                            $(document).ready(function() {
                                if ($("#countries") != null) {
                                    $("#countries").msDropdown();
                                }
                            })
                        </script>
                    </div>
                </div>
                <div class="right_middle">
                    <div id="right_header_part">
                        <?php
                        $ip = Yii::app()->request->getUserHostAddress();
                        if (isset(Yii::app()->user->id)) {
                            $tot = Yii::app()->db->createCommand()
                                    ->select('count(*) as total_pro')
                                    ->from('wish_list')
                                    ->where('city_id=' . Yii::app()->session['city_id'] . ' AND user_id=' . Yii::app()->user->user_id)
                                    ->queryRow();
                        } else {
                            $tot = Yii::app()->db->createCommand()
                                    ->select('count(*) as total_pro')
                                    ->from('wish_list')
                                    ->where('city_id=' . Yii::app()->session['city_id'] . ' AND session_id="' . $ip . '"')
                                    ->queryRow();
                        }
                        $wishlistCount = ($tot['total_pro'] > 0) ? $tot['total_pro'] : "";

                        echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . '/images/heart_img_03.jpg', "heart img", array("class" => "heart_img")) . '<p id="wishlist_counter" style="margin-left: 0px;">' . $wishlistCount . '</p>', $this->createUrl('/web/wishList/viewwishlist'));

                        //count total added products in cart
                        if (isset(Yii::app()->user->id)) {
                            $tot = Yii::app()->db->createCommand()
                                    ->select('sum(quantity) as cart_total')
                                    ->from('cart')
                                    ->where('city_id=' . Yii::app()->session['city_id'] . ' AND user_id=' . Yii::app()->user->user_id)
                                    ->queryRow();
                        } else {
                            $tot = Yii::app()->db->createCommand()
                                    ->select('sum(quantity) as cart_total')
                                    ->from('cart')
                                    ->where('city_id=' . Yii::app()->session['city_id'] . ' AND session_id="' . $ip . '"')
                                    ->queryRow();
                        }
                        $cartCount = $tot['cart_total'];


                        echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . '/images/simple_cart_img_03.jpg', "cart img", array("class" => "cart_img")) . '<p id="cart_counter">' . $cartCount . '</p>', $this->createUrl('/web/cart/viewcart', array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'])));
                        ?>
                    </div>
                    <div id="text">
                        <?php
                        if (!Yii::app()->user->isGuest) {
                            $this->renderPartial("application.views.layouts._logout_box");
                        } else {
                            $this->renderPartial("application.views.layouts._login_box", array("login_model" => $login_model));
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </header>
        
    <?php echo $content; ?> 
    <footer>
        <div id="under_footer">
            <div id="left_footer">
                <h1>Connect to DARUSSALAM</h1>
                <?php //$this->widget('LoginWidget');   ?>
                <div id="left_under_footer" >
                    <li>
                        <?php echo CHtml::image(Yii::app()->theme->baseUrl . '/images/phone_img_03.jpg', 'phone'); ?>
                        +(92) 42 35254654 - 54
                    </li>
                    <li>
                        <?php
                        echo CHtml::image(Yii::app()->theme->baseUrl . '/images/gmail_img_03.jpg', 'phone');
                        echo CHtml::mailto("support@darussalam.com", "support@darussalam.com");
                        ?>
                    </li>
                    <li>
                        <?php echo CHtml::image(Yii::app()->theme->baseUrl . '/images/home_img_03.jpg', 'phone'); ?>
                        Darussalam Publishers
                    </li>
                </div>
               	<p>is a multilingual international Islamic publishing house, with headquarters in Riyadh, Kingdom of Saudi Arabia.</p>
            </div>
            <div id="middle_footer">
                <h1>Navigation</h1>
                <?php
                echo CHtml::openTag("article");
                echo CHtml::link('Darussalam Blog', Yii::app()->createUrl('/?r=blog'), array("target" => "_blank"));
                echo '<br>';
                if (!Yii::app()->user->isGuest) {
                    echo CHtml::link('User Profile', $this->createUrl('/web/userProfile/index', array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'])));
                    echo '<br>';
                    echo CHtml::link('Customer History', $this->createUrl('/web/user/customerHistory', array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'])));
                }
                echo CHtml::closeTag("article");
                $require_pages = array("Contact Us");
                $pages = Pages::model()->getPages();

                foreach ($pages as $page) {
                    if (!in_array($page->title, $require_pages)) {
                        echo CHtml::openTag("article");
                        echo CHtml::link($page->title, Yii::app()->createUrl('/web/page/viewPage/', array("id" => $page->id)));
                        echo CHtml::closeTag("article");
                    }
                }
                echo CHtml::openTag("article");
                echo CHtml::link('Contact Us', $this->createUrl('/site/contact'));
                echo CHtml::closeTag("article");
                ?>
            </div>
            <div id="right_footer">
                <h1>What's New?</h1>
                <p><article>D-Tech - Working on technologies</article></p>
                <article><i>iPhone, Android & iPad Islamic apps</i></article>
                <p><article>D-Tech - Working on technologies</article></p>
                <article><i>iPhone, Android & iPad Islamic apps</i></article>
                <section>&copy; 2013 Darussalam, Inc. All Rights Reserved.</section>
            </div>
       	</div>
    </footer>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/msdropdown/jquery.dd.min.js"></script>
</body>
</html>
