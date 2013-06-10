<div id="landing_content">
    <p>Darussalam is a multilingual international Islamic publishing house, with headquarters in Riyadh, Kingdom of Saudi Arabia, and branches &amp; agents in major cities of the world. The foremost obligation of Darussalam is to publish most authentic Islamic books in the light of the Quran and the Sahih Ahadith in all major international languages. To impart and impel the above mentioned sacred obligation, Darussalam has been engaged from its very inception, in producing books on Islam in the Arabic, English, Urdu, Spanish, French, Hindi, Persian, Malayalam, Turkish, Indonesian, Russian, Albanian and Bangla languages. The main theme of these books is to present the fundamentals of Islam as explained by the most recognized Islamic scholars of the Muslim world.</p>
    <div class="landing_main_div">
        <?php //echo CVarDumper::dump($model,10,TRUE);die; ?>
        <div class="landing_div">
            <?php
            echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/quran_without_color_07.png"), $this->createUrl('/web/quran/index', array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'])));
            ?>
            <h4>Quran</h4>
            <article>The Quran is the central religious text of Islam, which Muslims believe to be the verbatim word of God.</article>
            <input type="button" value="Shop Now" class="shop_now" />
        </div>
        <div class="landing_div">
            <div class="ribbon-wrapper">
                <div class="ribbon-wrapper-green"><div class="ribbon-green">Popular</div></div>
            </div>
            <?php
            echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/books_img_03.png"), $this->createUrl('/web/product/allproducts', array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'])));
            ?>
            <h4>Books</h4>
            <article>Lorem ipsum color sit bla bla thhm ipoum deona eio a ea sho moxnt</article>
            <input type="button" value="Shop Now" class="shop_now" />
        </div>
        <div class="landing_div">
            <?php
            echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/educational_toys_img_03.png"), $this->createUrl('/web/educationToys/index', array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'])));
            ?>
            <h4>Educationsl Toys</h4>
            <article>Lorem ipsum color sit bla bla thhm ipoum deona eio a ea sho moxnt</article>
            <input type="button" value="Shop Now" class="shop_now" />
        </div>
        <div class="landing_div">
            <?php
            echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/other_items_img_03.png"), $this->createUrl('/web/others/index', array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'])));
            ?>
            <h4>Other Items</h4>
            <article>Lorem ipsum color sit bla bla thhm ipoum deona eio a ea sho moxnt</article>
            <input type="button" value="Shop Now" class="shop_now" />
        </div>
    </div>
</div>