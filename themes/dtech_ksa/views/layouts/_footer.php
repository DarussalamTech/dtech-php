<div id="footer_part">
    <footer>
        <div id="left_footer">
            <h4><?php echo Yii::t('header_footer', 'Connect to DARUSSALAM', array(), NULL, $this->currentLang); ?></h4>
            <div class="under_left_footer">
                <div class="footer_lamp">
                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/footerlamb.png" />
                </div>
                <div class="section_part">
                    <section><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/phone.png" /><span>+(966) 011 4033962 </span></section>
                    <section><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/mail.png" />
                        <span>
                            <?php
                            echo CHtml::mailto("it@darussalamksa.com");
                            ?>

                        </span>
                    </section>
                    
                </div>
            </div>
        </div>
        
        <div class="right_footer">
            
            <div class="under_right_footer">
                <section><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/home.png" /><span>Darussalam Publishers</span>
               <p>
                        <?php echo Yii::t('header_footer', " Muraba'a Area-Dabbab Street, Opposite to Chamber of Commerce", array(), NULL, $this->currentLang); ?>

               </p> 
                    </section>
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
            echo Yii::t('header_footer', '&copy; 2014 Darussalam, Inc. All Rights Reserved.', array(), NULL, $this->currentLang)
            ?>
        </p>
    </div>
</div>