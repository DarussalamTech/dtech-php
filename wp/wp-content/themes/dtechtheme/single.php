<?php get_header(); ?>
<div id="wraper1">
    <div id="content">
        <?php get_sidebar(); ?>
        <section>
            <div class="comments_under_section">
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
                        <div class="under_section2">
                            <div class="left_section">
                                <?php echo CHtml::image(Yii::app()->theme->baseUrl . '/images/keyboard_img_03.jpg', '', array('height' => '169', 'width' => '228')); ?>
                            </div>
                            <div class="right_section">
                                <p class="big_para">

                                    <?php
                                    the_content(__('(more)'));
                                    ?>
                                </p>
                                <p class="tag">Tags: <a href="#">advice, Design,Inspiration, kids</a></p>
                                <p class="tag">Posted by Talha Mujahid in <a href="#">Tips and Tricks  |  Comment</a></p>
                            </div>
                        </div>
                        <div class="main_comments">
                            <?php
                            $args = array(
                                'number' => '5',
                                'post_id' => get_post()->ID, // use post_id, not post_ID ,get the current post comment
                            );

                            foreach (get_comments($args) as $comment) {
                                ?>

                                <div class = "comments">
                                    <h4>
                                        <?php echo $comment->comment_author; ?>
                                    </h4>
                                    <p class = "comments_para">
                                        <?php echo $comment->comment_content; ?> 
                                    </p>
                                    <span>
                                        <?php
                                        $timestamp = strtotime($comment->comment_date_gmt);
                                        $numDays = round(abs(time() - $timestamp) / 86400 % 7);
                                        $numHours = round(abs(time() - $timestamp) / 3600 % 24);
                                        $numMinutes = round(abs(time() - $timestamp) / 60 % 60);
                                        $numSeconds = round(abs(time() - $timestamp) % 60);
                                        $remainingtime = '';
                                        if ($numDays != 0 AND $numDays == 1) {
                                            $remainingtime.=$numDays . ' Day ';
                                        }
                                        if ($numDays != 0 AND $numDays > 1) {
                                            $remainingtime.=$numDays . ' Days ';
                                        }
                                        if ($numHours != 0) {
                                            $remainingtime.=$numHours . ' Hours ';
                                        }
                                        if ($numMinutes != 0) {
                                            $remainingtime.=$numMinutes . ' Minutes ';
                                        }
                                        if ($numSeconds != 0) {
                                            $remainingtime.=$numSeconds . ' Seconds ';
                                        }
                                        echo $remainingtime . ' ago';
                                        ?>
                                    </span>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="add_comment">
                            <h5>Add Comment</h5>

                            <?php
                            $form = Yii::app()->controller->beginWidget('CActiveForm', array(
                                'id' => 'wp-comment-form',
                                //'action' => Yii::app()->createUrl('/?r=blog&p=' . get_post()->ID),
                                'action' => Yii::app()->createUrl('/?r=blog/default/comment&p=' . get_post()->ID),
                                //'action' => '/darussalam/wp/wp-comments-post.php',
                                'enableClientValidation' => true,
                            ));
                            /*
                             * some issues here two time model is needed to validtae
                             * will be set in comming days...
                             */

                            $modelz = new WpComment;
                            if (isset($_POST['WpComment'])) {
                                $modelz->attributes = $_POST['WpComment'];
                                if ($modelz->validate()) {
                                    //Yii::app()->controller->saveComment($modelz);
                                }
                            }
                            echo '<div id="error" style="color: red">';
                            echo $form->errorSummary($modelz);
                            echo '</div>';
                            echo $form->textField($modelz, 'wp_user_name', array('class' => 'name', 'placeholder' => 'Your Name...'));
                            //echo $form->hiddenField($modelz, 'wp_user_name', array('class' => 'name', 'placeholder' => 'Your Name...'));
                            if (!empty(Yii::app()->user->id) || is_user_logged_in()) {
                                //echo $form->textField($modelz, 'wp_user_email', array('class' => 'name', 'placeholder' => 'Emailz'));
                                echo $form->textField($modelz, 'wp_user_email', array('class' => 'name', 'placeholder' => 'Email', 'value' => !empty(Yii::app()->user->user_email)? Yii::app()->user->user_email:""));
                            } else {
                                echo $form->textField($modelz, 'wp_user_email', array('class' => 'name', 'placeholder' => 'Email'));
                            }
                            echo $form->textArea($modelz, 'wp_comment', array('cols' => '67', 'rows' => '6', 'placeholder' => 'Add a comment...'));
                            echo CHtml::submitButton('Add Comment', array('class' => 'add_comment_btn'));
                            $this->endWidget();
                            //comments_template()
                            ?>
                        </div>
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