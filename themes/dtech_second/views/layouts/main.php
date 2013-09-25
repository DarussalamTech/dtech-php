<!doctype html>
<html>
    <head>
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl ?>/packages/jui/js/jquery.js"></script>
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl ?>/css/style.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl ?>/css/customStyle.css" />
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl ?>/js/dtech_new.js"></script>
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl ?>/media/css/overlay.css" />
        <script src="<?php echo Yii::app()->baseUrl; ?>/media/js/dtech.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl ?>/js/msdropdown/jquery.dd.min.js"></script>
        <meta charset="utf-8">
        <script>
            var yii_base_url = "<?php echo Yii::app()->baseUrl; ?>";
            var yii_base_theme_url = "<?php echo Yii::app()->theme->baseUrl; ?>";
        </script>
        <script type="text/javascript">
            $(document).ready(function() {
                dtech_new.hideLoginBox();
                dtech_new.showtopMenu();
            });
        </script>

        <title><?php echo Yii::app()->name ?></title>
    </head>

    <body>
        <header>
            <div id="inner_header">
                <div id="left_header">
                    <?php
                    /**
                     * will perform the store change
                     * 
                     * 
                     */
                    /**
                     * if city session is enabled
                     */
                    if (isset($_REQUEST['city_id'])):
                        $this->renderPartial("//layouts/_change_city");
                    endif;
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'lang_change_form',
                        'action' => $this->createDTUrl('/site/changeLang'),
                        'enableClientValidation' => FALSE,
                        'clientOptions' => array(
                            'validateOnSubmit' => true,
                        ),
                    ));
                    ?>
                    <a href="javascript:void(0)" 
                       class="countries_img flag"

                       onclick ="dtech_new.changeLang(this)"
                       lang = "ar"
                       >
                           <?php
                           echo CHtml::image(Yii::app()->theme->baseUrl . "/images/saudi_arabia_flag_03.png");
                           ?>
                    </a>
                    <a href="javascript:void(0)" class="flag"
                       onclick ="dtech_new.changeLang(this)"
                       lang = "en"
                       >

                        <?php
                        echo CHtml::image(Yii::app()->theme->baseUrl . "/images/USA_flag_03.png");
                        ?>
                    </a>
                    <a href="javascript:void(0)" class="flag"
                       onclick ="dtech_new.changeLang(this)"
                       lang = "ur"
                       >

                        <?php
                        echo CHtml::image(Yii::app()->theme->baseUrl . "/images/pak_icon.png");
                        ?>
                    </a>
                    <input type="hidden" id="lang_h" name="lang_h" value="" />
                    <?php $this->endWidget(); ?>

                </div>
                <div id="right_header">
                    <ul>

                        <?php
                        if (Yii::app()->user->isGuest) {
                            echo CHtml::openTag("li");
                            echo CHtml::link(Yii::t('header_footer', 'Sign Up', array(), NULL, $this->currentLang), $this->createUrl('/web/user/register'));
                            echo CHtml::closeTag("li");
                        }
                        ?>
                        <li>


                            <div style="clear:both"></div>
                            <?php
                            if (!Yii::app()->user->isGuest) {
                                echo $this->renderPartial("//layouts/_logout_box");
                            } else {
                                echo CHtml::link(Yii::t('header_footer', 'Login', array(), NULL, $this->currentLang), 'javascript:void(0)', array("onclick" => "dtech_new.showLoginBox(this)"));
                                $this->renderPartial("//layouts/_login_box");
                            }
                            ?>
                        </li>
                        <li>
                            <?php
                            echo CHtml::link(Yii::t('header_footer', 'Contact Us', array(), NULL, $this->currentLang), $this->createUrl('/site/contact'));
                            ?>
                        </li>
                        <li>
                            <?php echo CHtml::link(Yii::t('header_footer', 'Blog', array(), NULL, $this->currentLang), Yii::app()->createUrl('/?r=blog'), array("target" => "_blank")); ?>
                        </li>
                    </ul>
                    <div id="cart">
                        <?php
                        /**
                         * if city session is enabled
                         */
                        if (isset($_REQUEST['city_id'])):
                            $cart = Cart::model()->getCartLists();

                            $this->renderPartial("//cart/_cart", array("cart" => $cart));
                        endif;
                        ?>
                    </div>
                </div>
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/lamp_img_02.png" class="lamp" />
            </div>
        </header>
        <div id="header_bottom">
            <div id="logo_part">
                <div id="logo">

                    <?php
                    echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/logo_img_03.jpg", 'Logo'), $this->createUrl('/site/storeHome'));
                    ?>
                </div>
                <div id="right_logo">
                    <p>

                        <?php
                        if (Yii::app()->user->isGuest) {
//                            echo Yii::t('header_footer', 'Welcome DTECH you can', array(), NULL, $this->currentLang);
//                            echo " ";
//                            echo CHtml::link(Yii::t('header_footer', 'Login', array(), NULL, $this->currentLang), $this->createUrl("/site/login"));
//                            echo " ";
//                            echo Yii::t('header_footer', 'or', array(), NULL, $this->currentLang);
//                            echo " ";
//                            echo CHtml::link(Yii::t('header_footer', 'create an account', array(), NULL, $this->currentLang), $this->createUrl("/web/user/register"));
                        }
                        ?>
                    </p>
                    <div>
                        <form id="search_form" method="post" 
                              action="<?php echo $this->createUrl("/web/search/getSearch") ?>" target='_top'>
                                  <?php
                                  $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                                      'name' => 'serach_field',
                                      'source' => $this->createUrl("/web/search/dosearch"),
                                      // additional javascript options for the autocomplete plugin
                                      'options' => array(
                                          'minLength' => '1',
                                      ),
                                      'htmlOptions' => array(
                                          'id' => 'serach_field',
                                          'class' => 'search_here',
                                          'value' => (isset($_POST['serach_field']) ? $_POST['serach_field'] : ""),
                                          'placeholder' => Yii::t('header_footer', 'Search here', array(), NULL, $this->currentLang)
                                      ),
                                  ));

                                  echo CHtml::link(
                                          CHtml::image(Yii::app()->theme->baseUrl . "/images/search_img_03.jpg", 'Logo', array(
                                              "class" => "search_img", 'onclick' => 'dtech.doGloblSearch()')), 'javascript:void(0)'
                                  );
                                  ?>
                        </form>

                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div id="navigation">
            <div id="navigation_part">
                <nav>
                    <ul>
                        <?php
                        if (isset($this->menu_categories)) {
                            foreach ($this->menu_categories as $id => $data):
                                echo '<li class="nav_hover">';
                                echo CHtml::link(Yii::t('common', $data['name'], array(), NULL, $this->currentLang), $this->createUrl("/web/product/category", array("slug" => $data['slug'])), array("class" => "top_link_hover"));

                                if (isset($data['data'])):
                                    echo CHtml::openTag("div", array(
                                        "class" => "nav_dropdown",
                                        "style" => "display:none;"
                                            )
                                    );

                                    echo '<div class="nav_pointer"></div>';
                                    /**
                                     * if size is greater then 10
                                     * then it will be 
                                     * decomsed
                                     */
                                    if (count($data['data']) > 10) {
                                        $data_childs = array_chunk($data['data'], 10);
                                        $counter = 1;
                                        foreach ($data_childs as $datachild) {
                                            $class = "";
                                            if ($counter != count($data_childs)) {
                                                $class = "even_menu";
                                            }
                                            echo "<ul style='float:left;' class='$class'>";
                                            foreach ($datachild as $cat):

                                                echo "<li class=''>";
                                                echo CHtml::link($cat->category_name, $this->createUrl("/web/product/category", array("slug" => $cat->slug)));
                                                echo "</li>";


                                            endforeach;
                                            echo "</ul>";


                                            $counter++;
                                        }
                                    } else {

                                        echo "<ul>";
                                        foreach ($data['data'] as $cat):

                                            echo "<li class=''>";
                                            echo CHtml::link($cat->category_name, $this->createUrl("/web/product/category", array("slug" => $cat->slug)));
                                            echo "</li>";

                                        endforeach;

                                        echo "</ul>";
                                    }


                                    echo CHtml::closeTag("div");

                                endif;

                                echo "</li>";
                            endforeach;
                        }
                        ?>

                    </ul>
                </nav>
                <div class="wishlist">

                    <?php
                    /**
                     * if city session is enabled
                     */
                    if (isset($_REQUEST['city_id'])):
                        $this->renderPartial("//layouts/_wishlist");
                    endif;
                    ?>
                </div>
            </div>
        </div>
        <?php
        echo $content;
        ?>

        <?php echo $this->renderPartial("//layouts/_footer") ?>
    </body>
</html>
<script type="text/javascript">
            jQuery('.nav_hover').hover(function() {
                jQuery('.cart_bx').hide();
                jQuery('.login_bx').hide();
                jQuery('.logout').hide();
                jQuery('.cart_arrow img').attr('src', jQuery('#cart_click').attr("unhover"));
            });
</script>
