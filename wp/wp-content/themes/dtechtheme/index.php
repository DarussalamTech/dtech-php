<?php get_header(); ?>
<div id="wraper1">
    <div id="content">
        <?php get_sidebar(); ?>
        <section>
            <div class="under_section">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                        <h2>
                            <?php
                            echo CHtml::link(get_post()->post_title, Yii::app()->createUrl('/?r=blog&p=' . get_post()->ID));
                            ?>
                        </h2>
                        <div class="f_t_g_img">
                            <a href="#">
                                <div class="fb-like" data-href="<?php echo Yii::app()->request->hostInfo . Yii::app()->request->requestUri; ?>" data-send="false" data-layout="button_count" data-width="200" data-show-faces="true"></div>
                            </a>
                            <?php echo CHtml::image(Yii::app()->theme->baseUrl . '/images/t_9_like_img_03.jpg', 'tweet img'); ?>
                            <?php echo CHtml::image(Yii::app()->theme->baseUrl . '/images/g_0_like_img_03.jpg', 'google plus img'); ?>
                            <?php echo CHtml::image(Yii::app()->theme->baseUrl . '/images/pin_it_img_03.jpg', 'pin it img'); ?>
                        </div>
                        <h3><?php the_time('F jS, Y ') ?></h3>
                        <table width="100%">
                            <tr>
                                <td class="left_td" valign="top">
                                    <?php echo CHtml::image(Yii::app()->theme->baseUrl . '/images/keyboard_img_03.jpg', '', array('height' => '169', 'width' => '228')); ?>
                                </td>
                                <td class="right_td">
                                    <p class="big_para">
                                        <?php
                                        echo $string = substr(get_post()->post_content, 0, 600) . ' .....';
                                        ?>
                                    </p>
                                    <?php
                                    echo CHtml::link('Read More ', Yii::app()->createUrl('/?r=blog&p=' . get_post()->ID));
                                    echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . '/images/read_more_arrow_img_03.jpg', 'read more /'), Yii::app()->createUrl('/?r=blog&p=' . get_post()->ID));
                                    ?>
                                    <p class="tag">
                                        Tags: 
                                        <?php
                                        echo CHtml::link('advice, Design,Inspiration, kids', Yii::app()->createUrl('/?r=blog&p=' . get_post()->ID));
                                        ?>
                                    </p>
                                    <p class="tag">
                                        Posted by Talha Mujahid in
                                        <?php
                                        echo CHtml::link('Tips and Tricks  |  Comment', Yii::app()->createUrl('/?r=blog&p=' . get_post()->ID));
                                        ?>
                                    </p>
                                </td>
                            </tr>
                        </table>
                        <?php
                    endwhile;
                else:
                    ?>
                    <p>
                        <?php _e('Sorry, There is no Post with this Category.'); ?>
                    </p>
                <?php endif; ?>	
            </div>

        </section>
    </div>
</div>
<?php get_footer(); ?>