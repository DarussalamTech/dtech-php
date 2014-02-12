<div id="footer_part">
    <footer>
        <div id="left_footer">
            <h4><?php echo Yii::t('header_footer', 'Connect to DARUSSALAM', array(), NULL, $this->currentLang); ?></h4>
            <div class="under_left_footer">
                <div class="footer_lamp">
                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/footerlamb.png" />
                </div>
                <div class="section_part">
                    <section><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/phone.png" /><span>+(92) 42 37240024 </span></section>
                    <section><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/mail.png" />
                        <span>
                            <?php
                            echo CHtml::mailto("support@darussalampk.com");
                            ?>

                        </span>
                    </section>
                    <section><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/home.png" /><span>Darussalam Publishers</span></section>
                    <p>
                        <?php echo Yii::t('header_footer', ' 36 Lower Mall, Secretariat Stop, Lahore, Pakistan', array(), NULL, $this->currentLang); ?>

                    </p>
                </div>
            </div>
        </div>
        <div class="center_footer">
            <h4>                
                <?php echo Yii::t('header_footer', 'get in TOUCH.', array(), NULL, $this->currentLang); ?>
            </h4>
            <div class="under_center_footer">
                <?php echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/t_img_03.png"), "http://twitter.com/darussalamsns",array("target"=>"_blank")); ?>
                <?php //echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/in_img_03.png"), "javascript:void(0)"); ?>
                <?php echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/f_img_03.png", ''), "http://www.facebook.com/darussalam.sns",array("target"=>"_blank")); ?>
                <?php //echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/g_img_03.png"), "javascript:void(0)"); ?>
            </div>
        </div>
        <div class="right_footer">
            <h4><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/darussalam_img_03.png" /> 
                <span>
                    <?php echo Yii::t('header_footer', 'whats NEW?.', array(), NULL, $this->currentLang); ?>
                </span>
            </h4>
            <div class="under_right_footer">
                <article>
                    <?php echo Yii::t('header_footer', 'Beta Website releasd.', array(), NULL, $this->currentLang); ?>
                </article>
                <span>
                    <i>
                        <?php echo Yii::t('header_footer', 'Authentic Isamic Books.', array(), NULL, $this->currentLang); ?>
                    </i>
                </span>
                <article>
                    <?php echo Yii::t('header_footer', 'Darussalam Publishers', array(), NULL, $this->currentLang); ?>
                </article>
                <span>
                    <i>
                        <?php echo Yii::t('header_footer', 'Islamic Ebooks and apps', array(), NULL, $this->currentLang); ?>
                    </i>
                </span>
            </div>
        </div>
    </footer>
</div>
<div id="footer_nav_part">
    <div id="footer_nav">
        <p>
            <?php
            $not_required_pages = array("Contact Us");
            $pages = Pages::model()->getPages();
            foreach ($pages as $page) {
                if (!in_array($page->title, $not_required_pages)) {
                    echo CHtml::openTag("span");
                    echo CHtml::link(Yii::t('header_footer', $page->title, array(), NULL, $this->currentLang), $this->createUrl('/web/page/viewPage/', array("id" => str_replace(" ","-",$page->title)."-".$page->id)));
                    echo CHtml::closeTag("span");
                }
            }
            echo CHtml::openTag("span");
            echo CHtml::link('Contact Us', $this->createUrl('/site/contact'));
            echo CHtml::closeTag("span");
            if (!Yii::app()->user->isGuest) {
                echo CHtml::openTag("span");
                echo CHtml::link(Yii::t('header_footer', 'User Profile', array(), NULL, $this->currentLang), $this->createUrl('/web/userProfile/index', array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'])));
                echo CHtml::closeTag("span");
                echo CHtml::openTag("span");
                echo CHtml::link(Yii::t('header_footer', 'Customer History', array(), NULL, $this->currentLang), $this->createUrl('/web/user/customerHistory', array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'])));
                echo CHtml::closeTag("span");
            }
            ?>
        </p>
    </div>
</div>
<div id="darussalam_bar_part">
    <div id="darussalam_bar">
        <p>
            <?php
            echo Yii::t('header_footer', '&copy; 2013 Darussalam, Inc. All Rights Reserved.', array(), NULL, $this->currentLang)
            ?>
        </p>
    </div>
</div>