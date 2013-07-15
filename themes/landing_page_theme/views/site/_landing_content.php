<div id="landing_content">
    <p>Darussalam is a multilingual international Islamic publishing house, with headquarters in Riyadh, Kingdom of Saudi Arabia, and branches &amp; agents in major cities of the world. The foremost obligation of Darussalam is to publish most authentic Islamic books in the light of the Quran and the Sahih Ahadith in all major international languages. To impart and impel the above mentioned sacred obligation, Darussalam has been engaged from its very inception, in producing books on Islam in the Arabic, English, Urdu, Spanish, French, Hindi, Persian, Malayalam, Turkish, Indonesian, Russian, Albanian and Bangla languages. The main theme of these books is to present the fundamentals of Islam as explained by the most recognized Islamic scholars of the Muslim world.</p>
    <div class="landing_main_div">
        <?php //echo CVarDumper::dump($model,10,TRUE);die; ?>
        <div class="landing_div">
            <?php
            echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/quran_without_color_07.png"), $this->createUrl('/web/quran/index', array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'])));
            ?>
            <h4><?php echo Yii::t('common', 'Quran', array(), NULL, $this->currentLang); ?></h4>
            <article>Darussalam has stock of Holy Quran with it's tafseers written by Scholars</article>
            <?php
            echo CHtml::link(CHtml::button(Yii::t('common', 'Shop Now', array(), NULL, $this->currentLang), array("class" => "shop_now")), $this->createUrl('/web/quran/index', array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'])));
            ?>
        </div>
        <div class="landing_div">
            <div class="ribbon-wrapper">
                <div class="ribbon-wrapper-green"><div class="ribbon-green">
                        <?php echo Yii::t('common', 'Popular', array(), NULL, $this->currentLang); ?>
                    </div></div>
            </div>
            <?php
            echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/books_img_03.png"), $this->createUrl('/web/product/allproducts', array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'])));
            ?>
            <h4><?php echo Yii::t('common', 'Books', array(), NULL, $this->currentLang); ?></h4>
            <article>Darussalam is Global Islamic Books Publishers and Distributors</article>
            <?php
            echo CHtml::link(CHtml::button(Yii::t('common', 'Shop Now', array(), NULL, $this->currentLang), array("class" => "shop_now")), $this->createUrl('/web/product/allproducts', array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'])));
            ?>
        </div>
        <div class="landing_div">
            <?php
            echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/educational_toys_img_03.png"), $this->createUrl('/web/educationToys/index', array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'])));
            ?>
            <h4><?php echo Yii::t('common', 'Educational Toys', array(), NULL, $this->currentLang); ?></h4>
            <article>Darussalam also provides Eductaional toys for Children promoting islamic soul in them</article>
            <?php
            echo CHtml::link(CHtml::button(Yii::t('common', 'Shop Now', array(), NULL, $this->currentLang), array("class" => "shop_now")), $this->createUrl('/web/educationToys/index', array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'])));
            ?>
        </div>
        <div class="landing_div">
            <?php
            echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/other_items_img_03.png"), $this->createUrl('/web/others/index', array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'])));
            ?>
            <h4><?php echo Yii::t('common', 'Other Items', array(), NULL, $this->currentLang); ?></h4>
            <article>In other products of Darussalam there are Electronic pen, quran, DVD and many more</article>
            <?php
            echo CHtml::link(CHtml::button(Yii::t('common', 'Shop Now', array(), NULL, $this->currentLang), array("class" => "shop_now")), $this->createUrl('/web/others/index', array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'])));
            ?>

        </div>
    </div>
</div>