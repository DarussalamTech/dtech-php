<div id="sidebar">
    <div class="web_button">
        <?php
        echo CHtml::link(CHtml::button('Visit darussalam.com', array('class' => 'visit_btn')), Yii::app()->createUrl('/site/storehome', array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'])), array('style' => 'cursor:pointer'));
        ?>
        <div class="small_images">
            <div id="fb-root"></div>

            <h1>Follow us</h1>
            <?php echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . '/images/f_img_03.jpg'), Yii::app()->createUrl('/web/hybrid/login/', array("provider" => "Facebook"))); ?>
            <?php echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . '/images/t_img_03.jpg'), Yii::app()->createUrl('/web/hybrid/login/', array("provider" => "Twitter"))); ?>
            <a href="<?php // bloginfo('rss2_url'); ?> "><?php echo CHtml::image(Yii::app()->theme->baseUrl . '/images/subscriber_img_03.jpg'); ?></a>
        </div>
        <div class="like_us">
            <h1>Like us on Facebook</h1>
            <?php echo CHtml::image(Yii::app()->theme->baseUrl . '/images/f_114k_img_03.jpg'); ?>
        </div>
        <h1>Search blog posts</h1>
        <div class="search">
            <a href="javascript:void(0)" onclick="$('#searchform').submit();">
                <?php echo CHtml::image(Yii::app()->theme->baseUrl . '/images/search_img_03.jpg'); ?>
            </a>

            <form method="get" id="searchform" action="">
                <input type="hidden" name="r" value="blog"/>
                <input type="text" class="search_text"  name="s" id="s" placeholder="<?php esc_attr_e('Search', 'dtechtheme'); ?>" />
            </form>
        </div>
        <div class="sidebar_list">
            <h1>Categories</h1>
            <ul>
                <?php
                foreach (get_categories() as $category) {
                    if ($category->count > 0) {
                        echo CHtml::openTag('li');
                        echo CHtml::link($category->cat_name, Yii::app()->createUrl('/?r=blog&cat=' . $category->cat_ID));
                        echo CHtml::closeTag('li');
                    }
                }
                ?>
            </ul>
        </div>
        <div class="contact_us">
            <h1>Talk to us</h1>
            <li>Send blog feedback and suggestions to</li>
            <a href="#">blog@darussalam.com</a>
        </div>
    </div>
</div>