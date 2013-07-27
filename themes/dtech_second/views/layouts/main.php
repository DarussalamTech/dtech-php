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
                    $this->renderPartial("//layouts/_change_city");
                    ?>
                    <a href="#" class="countries_img">
                        <?php
                        echo CHtml::image(Yii::app()->theme->baseUrl . "/images/saudi_arabia_flag_03.png");
                        ?>
                    </a>
                    <a href="#">

                        <?php
                        echo CHtml::image(Yii::app()->theme->baseUrl . "/images/USA_flag_03.png");
                        ?>
                    </a>
                    <a href="#">

                        <?php
                        echo CHtml::image(Yii::app()->theme->baseUrl . "/images/portugal_flag_03.png");
                        ?>
                    </a>

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
                            <?php
                            echo CHtml::link(Yii::t('header_footer', 'Login', array(), NULL, $this->currentLang), 'javascript:void(0)', array("onclick" => "dtech_new.showLoginBox(this)"));
                            ?>

                            <div style="clear:both"></div>
                            <?php
                            if (!Yii::app()->user->isGuest) {
                                echo $this->renderPartial("//layouts/_logout_box");
                            } else {
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
                        $cart = Cart::model()->getCartLists();

                        $this->renderPartial("//cart/_cart", array("cart" => $cart));
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
                        echo Yii::t('header_footer', 'Welcome DTECH you can', array(), NULL, $this->currentLang);
                        echo " ";
                        echo CHtml::link(Yii::t('header_footer', 'Login', array(), NULL, $this->currentLang), $this->createUrl("/site/login"));
                        echo " ";
                        echo Yii::t('header_footer', 'or', array(), NULL, $this->currentLang);
                        echo " ";
                        echo CHtml::link(Yii::t('header_footer', 'create an account', array(), NULL, $this->currentLang), $this->createUrl("/web/user/register"));
                        ?>
                    </p>
                    <div>

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
                                'class' => 'search_here',
                                'value' => (isset($_POST['serach_field']) ? $_POST['serach_field'] : ""),
                                'placeholder' => Yii::t('header_footer', 'type here', array(), NULL, $this->currentLang)
                            ),
                        ));
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div id="navigation">
            <div id="navigation_part">
                <nav>
                    <ul>
                        <?php
                        $paren_categories = Categories::model()->getParentCategories();

                        foreach ($paren_categories as $id => $name):
                            echo '<li class="nav_hover">';
                            ?>

                            <?php
                            echo CHtml::link(Yii::t('common', $name, array(), NULL, $this->currentLang), $this->createUrl("#"), array("class" => "top_link_hover"));
                            $childrenCats = Categories::model()->getchildrenCategory($id, "", "", 200);

                            if (count($childrenCats) >= 1):
                                echo CHtml::openTag("div", array(
                                        "class" => "nav_dropdown",
                                        "style" => "display:none;"
                                   )
                                );

                                echo '<div class="nav_pointer"></div>';
                                        
                                foreach ($childrenCats as $cat):
                                    echo "<p>";
                                    echo CHtml::link($cat->category_name);
                                    echo "</p>";
                                endforeach;
                                echo CHtml::closeTag("div");

                            endif;
                            echo "</li>";
                        endforeach;
                        ?>

                    </ul>
                </nav>
                <div class="wishlist">

                    <?php
                    $this->renderPartial("//layouts/_wishlist");
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