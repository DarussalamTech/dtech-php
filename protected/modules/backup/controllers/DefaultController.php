<?php

class DefaultController extends Controller {
    /*
     * To change this template, choose Tools | Templates
     * to take backups of data
     * mysql and uploads folder ...
     * path will be home/backups folder of
     * file system 
     * $auth:ubd
     */

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            // 'accessControl', // perform access control for CRUD operations
            'rights',
            'https + index +load+general',
        );
    }

    public function allowedActions() {
        return '@';
    }

    public function beforeAction($action) {
        Yii::app()->theme = "admin";
        parent::beforeAction($action);

        $operations = array('create', 'update', 'index', 'delete');
        parent::setPermissions($this->id, $operations);
        return true;
    }

    /**
     * action for all backups
     */
    public function actionIndex() {
        $this->layout = "//layouts/column2";
        $this->render("index");
    }

    /**
     * 
     * @param type $m
     * @param type $id
     * @param type $module
     * function to take 
     * backups of mysql
     * with current time and datestamp
     * @author UBD <ubaidullah@darussalampk.com>
     */
    public function actionbackUpSql() {

        $this->dosqlBackup();
        $this->redirect($this->createUrl("/backup/default/index"));
    }

    /**
     * for images backups
     * @author UBD <ubaidullah@darussalampk.com>
     */
    public function actionbackUpImage() {
        $this->doImageBackup();
        $this->redirect($this->createUrl("/backup/default/index"));
    }

    /**
     * all backup for uploads and sql
     */
    public function actionAllBackup() {

        $dateTime = str_replace(" ", "-", date('Y-m-d h:m:s'));
        $this->doImageBackup($dateTime);
        $this->doImageBackup($dateTime);
        $this->redirect($this->createUrl("/backup/default/index"));
    }

    /**
     * This is For the Download of backup sql Files
     */
    public function actionDownloadBackUpSql() {

        $file_arr = $this->dosqlBackup();
        Yii::app()->getRequest()->sendFile($file_arr['file_name'], @file_get_contents($file_arr['file']));
    }

    /*
     * This code is for downloading images
     */

    public function actionDownloadImageBackup() {
        $file_arr = $this->doImageBackup();
        Yii::app()->getRequest()->sendFile($file_arr['file_name'], @file_get_contents($file_arr['file']));
    }

    /**
     * sql backup
     * @param type $dateTime
     */
    public function dosqlBackup($dateTime = '') {
        $dbConArr = explode(";", Yii::app()->db->connectionString);
        $dbArr = explode("=", $dbConArr[count($dbConArr) - 1]);
        if (!is_dir("/home/dtech_pub_backup/")) {

            mkdir("/home/dtech_pub_backup/", 0777, true);
        }
        if (empty($dateTime)) {
            $dateTime = str_replace(" ", "-", date('Y-m-d h:m:s'));
        }
        $file = '/home/dtech_pub_backup/darussalam_ecom-' . $dateTime . '.sql';
        $cmd = 'mysqldump --opt --user=' . Yii::app()->db->username . ' --password=' . Yii::app()->db->password . ' ' . $dbArr[1] . '>' . $file;
        exec($cmd);

        if (is_file($file)) {
            Yii::app()->user->setFlash('back_up', 'Sql file Back-Up generated Successfully, in .sql formate');
        } else {
            Yii::app()->user->setFlash('back_up', 'Error in Taking Backups of your sql file');
        }
        return array("file" => $file, "file_name" => 'darussalam_ecom-' . $dateTime . '.sql');
    }

    /**
     * do image backup
     * @param type $dateTime
     */
    public function doImageBackup($dateTime = '') {

        if (!is_dir("/home/dtech_pub_backup/")) {

            mkdir("/home/dtech_pub_backup/", 0777, true);
        }
        if (empty($dateTime)) {
            $dateTime = str_replace(" ", "-", date('Y-m-d h:m:s'));
        }
        $file = '/home/dtech_pub_backup/darussalam_ecom-' . $dateTime . '.gz';


        $cmd = exec('tar -cvzf ' . $file . " " . Yii::app()->basePath . "/../uploads/");
        if (is_file($file)) {

            Yii::app()->user->setFlash('back_up', 'Images Back-Up generated Successfully, in zip/xz formate');
        } else {
            Yii::app()->user->setFlash('back_up', 'Error in Taking Backups of your images');
        }
        return array("file" => $file, "file_name" => 'dtech-pub-' . $dateTime . '.gz');
    }

}

