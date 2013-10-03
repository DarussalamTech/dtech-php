<?php
/**
 * The default template for displaygin search resutls and other terms.
 *
 * @package DTech
 * @subpackage DsTheme...
 * @since dtechtheme
 */
?>
<h2>
    <?php
    echo CHtml::link(get_post()->post_title, Yii::app()->createUrl('/?r=blog&p=' . get_post()->ID));
    ?>
</h2>
<div class="f_t_g_img">
    <?php echo CHtml::image(get_template_directory_uri() . '/images/f_0_like_img_03.jpg', 'facebook img'); ?>
    <?php echo CHtml::image(get_template_directory_uri() . '/images/t_9_like_img_03.jpg', 'tweet img'); ?>
    <?php echo CHtml::image(get_template_directory_uri() . '/images/g_0_like_img_03.jpg', 'google plus img'); ?>
    <?php echo CHtml::image(get_template_directory_uri() . '/images/pin_it_img_03.jpg', 'pin it img'); ?>
</div>
<h3><?php the_time('F jS, Y ') ?></h3>
<table width="100%">
    <tr>
        <td class="left_td" valign="top">
            <?php echo CHtml::image(get_template_directory_uri() . '/images/keyboard_img_03.jpg', '', array('height' => '169', 'width' => '228')); ?>
        </td>
        <td class="right_td">
            <p class="big_para">
                <?php the_content(__('(more)')); ?>
            </p>
            <a href="#" class="read_more">
                Read More 
                <?php echo CHtml::image(get_template_directory_uri() . '/images/read_more_arrow_img_03.jpg', 'read more /'); ?>
            </a>
            <p class="tag">Tags: <a href="#">advice, Design,Inspiration, kids</a></p>
            <p class="tag">Posted by Talha Mujahid in <a href="#">Tips and Tricks  |  Comment</a></p>
        </td>
    </tr>
</table>



