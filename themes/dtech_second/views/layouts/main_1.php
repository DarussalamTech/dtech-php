<!DOCTYPE html>
<html>
    <head>
        <title>Darussalam</title>
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl ?>/css/style.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl ?>/css/popup_style.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl ?>/css/footer_style.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl ?>/css/login_style.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl ?>/css/side_bar.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl ?>/css/msdropdown/dd.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl ?>/css/msdropdown/flags.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl ?>/css/customStyle.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl ?>/media/css/overlay.css" />
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl ?>/js/jquery-1.8.0.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl ?>/js/dtech_new.js"></script>
        <script src="<?php echo Yii::app()->baseUrl; ?>/media/js/dtech.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl ?>/js/msdropdown/jquery.dd.min.js"></script>


        <script type="text/javascript">
            $(document).ready(function() {
                dtech_new.toggleLogin();
                dtech_new.toggleSideBar();
                dtech_new.footerToggle();
                dtech_new.changeBookImgHover();
                dtech_new.registerCountryDropDown();
                jQuery("#countries").msDropdown();
                dtech_new.registerPopUp();

            });
        </script>


    </head>
    <body>
        <div id="wraper">
            <header>
                <div id="left_header">
                    <select name="countries" id="countries" style="width:300px;">
                        <option value='in' data-image="<?php echo Yii::app()->theme->baseUrl ?>/images/msdropdown/icons/blank.gif" data-imagecss="flag in" data-title="India" selected="selected">India</option>
                        <option value='pk' data-image="<?php echo Yii::app()->theme->baseUrl ?>/images/msdropdown/icons/blank.gif" data-imagecss="flag pk" data-title="Pakistan">Pakistan</option>
                        <option value='sa' data-image="<?php echo Yii::app()->theme->baseUrl ?>/images/msdropdown/icons/blank.gif" data-imagecss="flag sa" data-title="Saudi Arabia">Saudi Arabia</option>
                        <option value='uk' data-image="<?php echo Yii::app()->theme->baseUrl ?>/images/msdropdown/icons/blank.gif" data-imagecss="flag uk" data-title="United Kingdom">United Kingdom</option>
                        <option value='us' data-image="<?php echo Yii::app()->theme->baseUrl ?>/images/msdropdown/icons/blank.gif" data-imagecss="flag us" data-title="United States">United States</option>
                    </select>
                </div>
                <div id="right_header">
                    <span><a href="#">Sign Up</a></span>
                    <span>
                        <div id="login_contain">
                            <?php
                            if (!Yii::app()->user->isGuest) {
                                echo $this->renderPartial("//layouts/_logout_box")
                                ?>
                            <?php } else {
                                ?>

                                <a href="#" id="login_btn">
                                    <span>
                                        Login 
                                    </span>
                                </a>
                                <div style="clear:both"></div>
                                <div id="login_bx">  
                                    <?php
                                    $login_model = new LoginForm;
                                    $form = $this->beginWidget('CActiveForm', array(
                                        'id' => 'login_frm',
                                        'action' => Yii::app()->createUrl('/site/login'),
                                        'enableClientValidation' => true,
                                        'clientOptions' => array(
                                            'validateOnSubmit' => true,
                                        ),
                                    ));
                                    ?> 
                                    <fieldset id="body">
                                        <fieldset>
                                            <div id="login_pointer">
                                            </div>
                                            <label for="email">User Name</label>
                                            <?php
                                            echo $form->textField($login_model, 'username', array("id" => "email"));
                                            ?>
                                        </fieldset>
                                        <fieldset>
                                            <label for="password">Password</label>
                                            <?php
                                            echo $form->passwordField($login_model, 'password', array("id" => "password"));
                                            ?>
                                        </fieldset>
                                    </fieldset>
                                    <?php echo CHtml::submitButton("User Login", array("class" => "user_login_btn")); ?>
                                    <?php $this->endWidget(); ?>
                                </div>
                            <?php } ?>
                        </div>
                    </span>
                    <span>
                        <?php
                        echo CHtml::link('Contact Us', $this->createUrl('/site/contact'));
                        ?>
                    </span>
                    <span>
                        <?php echo CHtml::link('Blog', Yii::app()->createUrl('/?r=blog'), array("target" => "_blank")); ?>
                    </span>
                </div>
            </header>
            <div id="banner">
                <div id="upper_banner">
                    <div class="logo">
                        <?php
                        echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/logo_img_03.png", 'Logo'), $this->createDTUrl('site/index'));
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
                                        'placeholder' => 'type here',
                                    ),
                                ));
                                ?>
                                <button id='search-button' type='submit' onclick="dtech.doGloblSearch()"><span>Search</span></button>
                            </form>
                        </div>
                    </div>
                    <div class="cart_part">
                        <div class="add_to_cart">
                            <ul>
                                <li>
                                    <a href="#">
                                        <?php
                                        echo CHtml::image(Yii::app()->theme->baseUrl . "/images/shopping_cart_03.png");
                                        ?>
                                    </a>
                                    <ul class="sub-menu">
                                        <div id="pointer">
                                        </div>
                                        <h1>My Shopping Bag</h1>
                                        <div class="sub-sub-menu">
                                            <select>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                            </select>
                                            <h2>Moon Split</h2>
                                            <span>5,96 PKR</span>
                                        </div>
                                        <div class="sub-sub-menu">
                                            <select>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                            </select>
                                            <h2>Moon Split</h2>
                                            <span>5,96 PKR</span>
                                        </div>
                                        <div class="sub-sub-menu">
                                            <select>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                            </select>
                                            <h2>Moon Split</h2>
                                            <span>5,96 PKR</span>
                                        </div>
                                        <div class="total">
                                            <?php
                                            echo CHtml::image(Yii::app()->theme->baseUrl . "/images/total_little_img_03.png");
                                            ?>
                                            <h3>TOTAL:</h3>
                                            <h4>16,39 PKR</h4>
                                        </div>
                                        <div id="check_out_pointer">
                                        </div>
                                        <input type="button" value="CHECKOUT" class="check_out" />
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="wishlist">
                            <a href="#">
                                <?php
                                echo CHtml::image(Yii::app()->theme->baseUrl . "/images/wishlist_img_03.png");
                                ?>
                            </a>
                            <span>500</span>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <hr class="style-two">	
                </div>
                <div id="below_banner">
                    <div id="bar">
                        <div id="container">
                            <div id="sideBarContainer">
                                <a href="#" id="sideBarButton">

                                    <?php
                                    echo CHtml::image(Yii::app()->theme->baseUrl . "/images/navigation_img_02.png");
                                    ?>
                                    <em></em>
                                </a>
                                <div style="clear:both"></div>
                                <div id="sideBarBox">                
                                    <div id="sideBarForm">
                                        <ul class="makeMenu">
                                            <h1>Browse Through</h1>
                                            <li class="quran">
                                                <?php
                                                echo CHtml::link("Quran", $this->createUrl("/web/quran/index"));
                                                $quranCategories = Categories::model()->getchildrenCategory(0, "Quran", "ASC", 9);
                                                $count = 0;
                                                foreach ($quranCategories as $cat) {
                                                    if ($count <= 1) {
                                                        echo CHtml::openTag("p");
                                                        echo CHtml::link(
                                                                $cat->category_name, $this->createUrl("/web/quran/index") . "#cat=" . $cat->category_id, array("onclick" => "dtech_new.showCategoryListing(this);return false;")
                                                        );
                                                        echo CHtml::closeTag("p");
                                                    }
                                                    $count++;
                                                }

                                                echo CHtml::openTag("ul");
                                                echo CHtml::openTag("h2");
                                                echo "Quran";
                                                echo CHtml::closeTag("h2");

                                                foreach ($quranCategories as $subcat) {
                                                    echo CHtml::openTag("li");
                                                    echo CHtml::link(
                                                            $subcat->category_name, $this->createUrl("/web/quran/index") . "#cat=" . $subcat->category_id, array("onclick" => "dtech_new.showCategoryListing(this);return false;")
                                                    );
                                                    echo CHtml::closeTag("li");
                                                }
                                                echo CHtml::closeTag("ul");
                                                ?>

                                            </li>
                                            <li>

                                                <?php
                                                echo CHtml::link("Books", $this->createUrl("/web/product/allproducts"));
                                                $booksCategories = Categories::model()->getchildrenCategory(0, "Books", "ASC", 9);
                                                $count = 0;
                                                foreach ($booksCategories as $cat) {
                                                    if ($count <= 1) {
                                                        echo CHtml::openTag("p");
                                                        echo CHtml::link(
                                                                $cat->category_name, $this->createUrl("/web/product/allproducts") . "#cat=" . $cat->category_id, array("onclick" => "dtech_new.showCategoryListing(this);return false;")
                                                        );
                                                        echo CHtml::closeTag("p");
                                                    }
                                                    $count++;
                                                }


                                                echo CHtml::openTag("ul");
                                                echo CHtml::openTag("h2");
                                                echo "Books";
                                                echo CHtml::closeTag("h2");

                                                foreach ($booksCategories as $subcat) {
                                                    echo CHtml::openTag("li");
                                                    echo CHtml::link(
                                                            $subcat->category_name, $this->createUrl("/web/product/allproducts") . "#cat=" . $subcat->category_id, array("onclick" => "dtech_new.showCategoryListing(this);return false;")
                                                    );
                                                    echo CHtml::closeTag("li");
                                                }
                                                echo CHtml::closeTag("ul");
                                                ?>


                                            </li>
                                            <li>

                                                <?php
                                                echo CHtml::link("Educational Toys", $this->createUrl("/web/educationToys/index"));
                                                $eduCategories = Categories::model()->getchildrenCategory(0, "Educational Toys", "ASC", 9);
                                                $count = 0;
                                                foreach ($eduCategories as $cat) {
                                                    if ($count <= 1) {
                                                        echo CHtml::openTag("p");
                                                        echo CHtml::link(
                                                                $cat->category_name, $this->createUrl("/web/educationToys/index") . "#cat=" . $cat->category_id, array("onclick" => "dtech_new.showCategoryListing(this);return false;")
                                                        );
                                                        echo CHtml::closeTag("p");
                                                    }

                                                    $count++;
                                                }
                                                echo CHtml::openTag("ul");
                                                echo CHtml::openTag("h2");
                                                echo "Educational Toys";
                                                echo CHtml::closeTag("h2");

                                                foreach ($eduCategories as $subcat) {
                                                    echo CHtml::openTag("li");
                                                    echo CHtml::link(
                                                            $subcat->category_name, $this->createUrl("/web/educationToys/index") . "#cat=" . $subcat->category_id, array("onclick" => "dtech_new.showCategoryListing(this);return false;")
                                                    );
                                                    echo CHtml::closeTag("li");
                                                }
                                                echo CHtml::closeTag("ul");
                                                ?>
                                            </li>
                                            <li>
                                                <?php
                                                echo CHtml::link("Other Items", $this->createUrl("/web/others/index"));
                                                $otherCategories = Categories::model()->getchildrenCategory(0, "Others", "ASC", 9);
                                                $count = 0;
                                                foreach ($otherCategories as $cat) {
                                                    if ($count <= 1) {
                                                        echo CHtml::openTag("p");
                                                        echo CHtml::link(
                                                                $cat->category_name, $this->createUrl("/web/others/index") . "#cat=" . $cat->category_id, array("onclick" => "dtech_new.showCategoryListing(this);return false;"));
                                                        echo CHtml::closeTag("p");
                                                    }
                                                    $count++;
                                                }
                                                echo CHtml::openTag("ul");
                                                echo CHtml::openTag("h2");
                                                echo "Other Items";
                                                echo CHtml::closeTag("h2");

                                                foreach ($otherCategories as $subcat) {
                                                    echo CHtml::openTag("li");
                                                    echo CHtml::link(
                                                            $subcat->category_name, $this->createUrl("/web/others/index") . "#cat=" . $subcat->category_id, array("onclick" => "dtech_new.showCategoryListing(this);return false;")
                                                    );
                                                    echo CHtml::closeTag("li");
                                                }
                                                echo CHtml::closeTag("ul");
                                                ?>
                                            </li>
                                            <li class="full_storage"><a href="#">Full Store Cateloge</a><span> > </span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="best_seller">
                            <a href="javascript:void(0)" onClick="dtech_new.showBestSeller()">

                                <?php
                                echo CHtml::image(Yii::app()->theme->baseUrl . "/images/best_sellers_img_03.png");
                                ?>
                            </a>
                            <div class="under_best_seller">

                                <?php
                                echo CHtml::image(Yii::app()->theme->baseUrl . "/images/crown_img_03.png", '', array("class" => "crown_img"));
                                ?>
                                <h1>Best Sellers</h1>
                                <div class="quran_pen">
                                    <div class="quran_img">

                                        <?php
                                        echo CHtml::image(Yii::app()->theme->baseUrl . "/images/quran_pen_img_03.png");
                                        ?>
                                    </div>
                                    <div class="quran_text">
                                        <h2>Quran Pen</h2>
                                        <p>Lorem ipsum color sit bla bla thhm ipoum deona eio a ea sho moxnt</p>
                                        <article>

                                            <?php
                                            echo CHtml::image(Yii::app()->theme->baseUrl . "/images/good_stars_img_03.png");
                                            ?>
                                            (7)
                                        </article>
                                    </div>
                                </div>
                                <div class="shop_up">
                                    <input class="shop_now_arrow" type="button" value="Shop Now >" />
                                </div>
                                <div class="quran_pen">
                                    <div class="quran_img">

                                        <?php
                                        echo CHtml::image(Yii::app()->theme->baseUrl . "/images/quran_pen_img_03.png");
                                        ?>
                                    </div>
                                    <div class="quran_text">
                                        <h2>Quran Pen</h2>
                                        <p>Lorem ipsum color sit bla bla thhm ipoum deona eio a ea sho moxnt</p>
                                        <article>

                                            <?php
                                            echo CHtml::image(Yii::app()->theme->baseUrl . "/images/good_stars_img_03.png");
                                            ?>
                                            (7)
                                        </article>
                                    </div>
                                </div>
                                <div class="shop_up">
                                    <input class="shop_now_arrow" type="button" value="Shop Now >" />
                                </div>
                                <div class="quran_pen">
                                    <div class="quran_img">

                                        <?php
                                        echo CHtml::image(Yii::app()->theme->baseUrl . "/images/quran_pen_img_03.png");
                                        ?>
                                    </div>
                                    <div class="quran_text">
                                        <h2>Quran Pen</h2>
                                        <p>Lorem ipsum color sit bla bla thhm ipoum deona eio a ea sho moxnt</p>
                                        <article>

                                            <?php
                                            echo CHtml::image(Yii::app()->theme->baseUrl . "/images/good_stars_img_03.png");
                                            ?>
                                            (7)
                                        </article>
                                    </div>
                                </div>
                                <div class="shop_up">
                                    <input class="shop_now_arrow" type="button" value="Shop Now >" />
                                </div>
                                <div class="quran_pen">
                                    <div class="quran_img">

                                        <?php
                                        echo CHtml::image(Yii::app()->theme->baseUrl . "/images/quran_pen_img_03.png");
                                        ?>
                                    </div>
                                    <div class="quran_text">
                                        <h2>Quran Pen</h2>
                                        <p>Lorem ipsum color sit bla bla thhm ipoum deona eio a ea sho moxnt</p>
                                        <article>

                                            <?php
                                            echo CHtml::image(Yii::app()->theme->baseUrl . "/images/good_stars_img_03.png");
                                            ?>
                                            (7)
                                        </article>
                                    </div>
                                </div>
                                <div class="shop_up">
                                    <input class="shop_now_arrow" type="button" value="Shop Now >" />
                                </div>
                                <div class="quran_pen">
                                    <div class="quran_img">

                                        <?php
                                        echo CHtml::image(Yii::app()->theme->baseUrl . "/images/quran_pen_img_03.png");
                                        ?>
                                    </div>
                                    <div class="quran_text">
                                        <h2>Quran Pen</h2>
                                        <p>Lorem ipsum color sit bla bla thhm ipoum deona eio a ea sho moxnt</p>
                                        <article>

                                            <?php
                                            echo CHtml::image(Yii::app()->theme->baseUrl . "/images/good_stars_img_03.png");
                                            ?>
                                            (7)
                                        </article>
                                    </div>
                                </div>
                                <div class="shop_up">
                                    <input class="shop_now_arrow" type="button" value="Shop Now >" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            echo $content;
            ?>
    </body>
    <script type="text/javascript">
            dtech_new.is_filter = <?php echo isset($this->is_cat_filter) ? 1 : 0 ?>
    </script>
</html>
