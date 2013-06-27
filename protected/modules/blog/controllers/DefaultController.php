<?php

class DefaultController extends Controller {

    public function init() {
        // note that we disable the layout
        $this->layout = false;
        parent::init();
    }

    public function actionIndex() {
        
        $this->loadWp();
    }

    public function loadWp() {
        //require_once(dirname(__FILE__).'/../wp/wp-load.php');
        //print_r('../wp/wp-load.php');exit;

        try {
            wp();

            require_once(ABSPATH . WPINC . '/template-loader.php');
            require_once(ABSPATH . '/wp-config.php');



            if (get_class($user) == "WP_Error") {
                die("oops- wrong user/pass?");
            }

            Yii::app()->end();
        }
        // if we threw an exception in a WordPress functions.php
        // when we find a 404 header, we could use our main Yii
        // error handler to handle the error, log as desired
        // and then throw the exception on up the chain and
        // let Yii handle things from here
        // without the above, WordPress becomes our 404 error
        // handler for the entire Yii app
        catch (Exception $e) {
            throw $e;
        }
    }

    public function actionWpLogin() {

        //require_once(dirname(__FILE__).'/../wp/wp-load.php');
        //print_r('../wp/wp-load.php');exit;

        try {
            wp();

            require_once(ABSPATH . 'wp-admin/index.php');
            require_once(ABSPATH . '/wp-config.php');


            Yii::app()->end();
        }
        // if we threw an exception in a WordPress functions.php
        // when we find a 404 header, we could use our main Yii
        // error handler to handle the error, log as desired
        // and then throw the exception on up the chain and
        // let Yii handle things from here
        // without the above, WordPress becomes our 404 error
        // handler for the entire Yii app
        catch (Exception $e) {
            throw $e;
        }
    }

    public function actionComment($p = "") {
        $this->layout = "";
        $model = new WpComment;

        $this->saveComment($model, $p);
    }

    /**
     * A word press code for saving comments
     */
    public function saveComment($modelz, $p) {
        /** Sets up the WordPress Environment. */
        require_once(ABSPATH . '/wp-load.php');

  /*
   * check if the data is validated or not if not validated
   * then send back with model->errors
   * other wise load the wordpress page with specific post p=""
   */
        if (isset($_POST['WpComment'])) {
            $modelz->attributes = $_POST['WpComment'];

            if ($modelz->validate()) {

                $_POST['submit'] = 'Post Comment';
                $comment_post_ID = !empty($p) ? (int)$p : 0;
                $post = get_post($comment_post_ID);

                $comment_author = ( isset($modelz->wp_user_name) ) ? trim(strip_tags($modelz->wp_user_name)) : null;
                $comment_author_email = ( isset($modelz->wp_user_email)) ? trim($modelz->wp_user_email) : null;
                $comment_author_url = ( isset($_POST['url']) ) ? trim($_POST['url']) : null;
                $comment_content = ( isset($modelz->wp_comment) ) ? trim($modelz->wp_comment) : null;

                $comment_parent = 0;
                $commentdata = compact('comment_post_ID', 'comment_author', 'comment_author_email', 'comment_author_url', 'comment_content', 'comment_type', 'comment_parent', 'user_ID');
                $comment_id = wp_new_comment($commentdata);

                $this->redirect(Yii::app()->createUrl('/?r=blog&p=' . $p), false);
            } else {
                $this->loadWp();
            }
        } else {
            $this->loadWp();
        }
    }

}