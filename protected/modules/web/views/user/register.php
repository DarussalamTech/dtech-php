<div id="book_content">
    <div id="book_main_content">
        <div class="left_book_main_content">
            <?php
            echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/darussalam-inner-logo.png"), $this->createUrl('/site/storehome', array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'])));
            ?>
        </div>
        <div class="search_box">
            <input type="text" placeholder="Search keywords or image ids..." value="" class="search_text" />
            <input type="button" name="" value="" class="search_btn" />
            <?php echo CHtml::image(Yii::app()->theme->baseUrl . "/images/searching_img_03.jpg", '', array('class' => 'searching_img')) ?>
        </div>
        <nav>
            <ul>
                <?php
                echo CHtml::openTag("li");
                $require_pages = array("About Us", "Help");

                foreach ($this->webPages as $page) {
                    if (in_array($page->title, $require_pages)) {

                        echo CHtml::link($page->title, Yii::app()->createUrl('/web/page/viewPage/', array("id" => $page->id)));
                    }
                }
                echo CHtml::link('Contact Us', $this->createUrl('/site/contact'));
                echo CHtml::closeTag("li");
                ?>
            </ul>
        </nav>
    </div>
</div>
<div id="user_login">
    <div id="main_user_login">
        <?php echo $this->renderPartial('_sign_up', array('model' => $model)); ?>
        <?php echo $this->renderPartial('_login', array('model' => $model)); ?>
    </div>
</div>