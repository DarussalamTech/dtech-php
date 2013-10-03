<div id="sidebar">
    <div class="web_button">
        <?php
        echo CHtml::link(CHtml::button('Visit darussalam.com', array('class' => 'visit_btn')), Yii::app()->homeUrl, array('style' => 'cursor:pointer'));
        ?>
        <div class="small_images">
            <div id="fb-root"></div>

            <h1>Follow us</h1>
            <?php echo CHtml::link(CHtml::image(get_template_directory_uri() . '/images/f_img_03.jpg'), "http://www.facebook.com/darussalam.sns",array("target"=>"_blank")); ?>
            <?php echo CHtml::link(CHtml::image(get_template_directory_uri() . '/images/t_img_03.jpg'), "http://twitter.com/darussalamsns",array("target"=>"_blank")); ?>
            
        </div>
        <div class="like_us">
            <h1>Like us on Facebook</h1>
            <?php echo CHtml::image(get_template_directory_uri() . '/images/f_114k_img_03.jpg'); ?>
        </div>
        <h1>Search blog posts</h1>
        <div class="search">
            <a href="javascript:void(0)" onclick="$('#searchform').submit();">
                <?php echo CHtml::image(get_template_directory_uri() . '/images/search_img_03.jpg'); ?>
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