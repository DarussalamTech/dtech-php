<div id="footer_part">
    <div id="header_img">
        <div class="toggleBtnHolder">
            <?php
            echo CHtml::image(Yii::app()->theme->baseUrl . "/images/footer_open_img_03.png", '', array('class' => 'btnToggle'));
            ?>
            <div id="dvText">
                <div id="div_text">
                    <div id="left_footer">
                        <h1>
                            <?php echo Yii::t('header_footer', 'Connect to DARUSSALAM', array(), NULL, $this->currentLang); ?>
                        </h1>
                        <?php echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/f_img_06.png"), $this->createUrl('/web/hybrid/login/', array("provider" => "facebook"))); ?>
                        <?php echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/t_img_06.png"), $this->createUrl('/web/hybrid/login/', array("provider" => "twitter"))); ?>
                        <?php echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/in_img_06.png", '', array('style' => 'width:28px; height:24px')), $this->createUrl('/web/hybrid/login/', array("provider" => "linkedin"))); ?>
                        <?php echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/google_img_06.png"), $this->createUrl('/web/hybrid/login/', array("provider" => "google"))); ?>
                        <div id = "left_under_footer">
                            <li>
                                <?php echo CHtml::image(Yii::app()->theme->baseUrl . "/images/phone_img_06.png"); ?>
                                +(92) 42 35254654 - 54
                            </li>
                            <li>
                                <?php echo CHtml::image(Yii::app()->theme->baseUrl . "/images/mail_img_06.png"); ?>
                                <?php echo CHtml::mailto("support@darussalam.com", "support@darussalam.com");
                                ?>
                            </li>
                            <li>
                                <?php echo CHtml::image(Yii::app()->theme->baseUrl . "/images/home_img_06.png"); ?>
                                Darussalam Publishers
                            </li>
                        </div>
                        <p>is a multilingual international Islamic publishing house, with headquarters in Riyadh, Kingdom of Saudi Arabia.</p>
                    </div>
                    <div id="middle_footer">
                        <h1>
                            <?php echo Yii::t('header_footer', 'Navigation', array(), NULL, $this->currentLang); ?>
                        </h1>
                        <?php
                        $not_required_pages = array("Contact Us");
                        $pages = Pages::model()->getPages();
                        foreach ($pages as $page) {
                            if (!in_array($page->title, $not_required_pages)) {
                                echo CHtml::openTag("article");
                                echo CHtml::link($page->title, $this->createUrl('/web/page/viewPage/', array("id" => $page->id)));
                                echo CHtml::closeTag("article");
                            }
                        }
                        echo CHtml::openTag("article");
                        echo CHtml::link('Contact Us', $this->createUrl('/site/contact'));
                        echo CHtml::closeTag("article");
                        if (!Yii::app()->user->isGuest) {
                            echo CHtml::openTag("article");
                            echo CHtml::link('User Profile', $this->createUrl('/web/userProfile', array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'])));
                            echo '<br>';
                            echo CHtml::link('Customer History', $this->createUrl('/web/user/customerHistory', array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'])));
                            echo CHtml::closeTag("article");
                        }
                        ?>
                    </div>
                    <div id="right_footer">
                        <h1>
                            <?php echo Yii::t('header_footer', "What's New?", array(), NULL, $this->currentLang); ?>
                        </h1>
                        <p style='color: #888888;'>D-Tech - Working on technologies</p>
                        <article><i>iPhone, Android & iPad Islamic apps</i></article>
                        <section>&copy; 2013 Darussalam, Inc. All Rights Reserved.</section>
                    </div>
                </div>
                <?php
                echo CHtml::image(Yii::app()->theme->baseUrl . "/images/down_footer_img_03.png", '', array('id' => 'div_img'));
                ?>
            </div>
        </div>
    </div>
</div>