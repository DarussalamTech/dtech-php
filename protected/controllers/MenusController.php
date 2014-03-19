<?php

/**
 * Drop Down Navigation
 *  MPN is deployed on different sub-domains for different projects. For each 
 * MPN project it is required to have different menus, different title, 
 * sub-menus and main menus. To achieve that functionality we developed a 
 * navigation control system. Each menu item of main navigation is saved in 
 * database in menus table. We can assign menu or un-assign, set sort order, 
 * sub-menu at any level through that system.
 * 
 * Note: This functionality is not under client’s control. Only MPN developers can use it
 * 
 * ProDropDown extension is a drop down menu which provide us proper suitable 
 * CSS and JS the rest code is divided into simple Yii CRUD.
 * 
 * @author Mohsin Shoaib
 */
class MenusController extends Controller {

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
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('rebuildAssets'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('index', 'create', 'update', 'delete', 'addChild', 'sort',
                    'installMenu', 'generateData', 'json'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Menu;

        if (isset($_POST['Menu'])) {
            $model->attributes = $_POST['Menu'];

            $model->pid = 0;
            $model->is_assigned = "Yes";
            $model->weight = $model->getMainMenuWeight();
            $model->default_title = $model->user_title;

            if ($model->save())
                $this->redirect(array('index'));
        }

        $this->render('create', array('model' => $model));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $previousPID = $model->pid;

        if (isset($_POST['Menu']) && !isset($_POST['Menu']['id'])) {
            /* Update attributes */
            $model->attributes = $_POST['Menu'];

            if ($model->main_menu == true && $model->pid == 0 && $model->is_assigned == "No") {
                $model->is_assigned = "Yes";
                $model->weight = $model->getMainMenuWeight();
            }

            /*
             * Find if it is main menu submitted or menu item 
             * Inf is_assigned == 'No' and pid = 0 then it is menu item
             * And if it is menu item then update pid and set is_assigned = yes
             */
            if ($model->main_menu == false && $previousPID != $model->pid && $model->pid > 0) {
                $model->is_assigned = "Yes";
                $model->weight = $model->getMenuItemWeight();
            }
            /* If no parent is selected and it has parent before. */ else if ($model->main_menu == false && $model->pid == 0 && $previousPID > 0) {
                $model->is_assigned = "No";
                $model->weight = $model->getMenuItemWeightUnAssigned();
            }

            if ($model->save())
                $this->redirect(array('index'));
        }

        $this->render('update', array('model' => $model));
    }

    /**
     * Add child or menu sub-item 
     */
    public function actionAddChild() {
        if (isset($_POST['Menu']) && $_POST['Menu']['id'] > 0) {
            $id = $_POST['Menu']['id'];

            $model = $this->loadModel($id);

            /* Update attributes */
            $model->attributes = $_POST['Menu'];

            $model->root_parent = Menu::model()->getRootParent($model->pid);

            $model->is_assigned = "Yes";
            $model->weight = $model->getMenuItemWeight();

            if ($model->save()) {
                $this->redirect(array('update', 'id' => $model->pid));
            }
        } else {
            $this->redirect(array('update', 'id' => $_POST['Menu']['pid']));
        }
        $this->redirect(array('index'));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $model = $this->loadModel($id);

        /* Set some attributes to put this menu in un-assigneds */
        $pid = $model->pid;
        $model->pid = 0;
        $model->root_parent = 0;
        $model->is_assigned = "No";
        $model->weight = $model->getMenuItemWeightUnAssigned();

        /* Save changings */
        $model->save();

        /**
         * Suppose we have this data of nvigation
         * User Management
         *      1. List All 
         *      2. Create User
         *      3. View Single User
         *      4. Delete Single User
         *      5. Delete All Users
         * 
         * Now if we delete '3' menu item then sequence/weight/sort order will become 1,2,4,5
         * So to make sort order or weight proper we have to set Main menu's items weights/sort order.
         * And after that it will become 1,2,3,4
         */
        $model = Menu::model()->findAllByAttributes(array("pid" => $pid, "is_assigned" => "Yes"));

        foreach ($model as $weight => $menu) {
            $m = Menu::model()->findByPk($menu->id);
            $m->weight = $weight;
            $m->save();
        }

        $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
    }

    /**
     * Manages all models.
     */
    public function actionIndex() {
        $model = new Menu('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['Menu']))
            $model->attributes = $_GET['Menu'];

        $this->render('index', array('model' => $model,));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Menu::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * When user press up or down button in menu page to sort it this function is called :)
     * @param type $id
     * @param type $type 
     */
    public function actionSort($id, $direction) {
        $model = Menu::model()->findByPk($id);

        $criteria = new CDbCriteria();

        if ($direction == "up") {
            $criteria->condition = "weight < " . $model->weight . " AND pid = " . $model->pid . " AND is_assigned = 'Yes'";
            $criteria->order = "weight DESC";
        } else {
            $criteria->condition = "weight > " . $model->weight . " AND pid = " . $model->pid . " AND is_assigned = 'Yes'";
            $criteria->order = "weight ASC";
        }

        $model2 = Menu::model()->find($criteria);

        if (count($model2) == 1) {
            $wc = $model->weight;
            $model->weight = $model2->weight;
            $model2->weight = $wc;
            $model->save();
            $model2->save();
        }

        $this->redirect(array('index'));
    }

    /**
     * Install menu only first time when it is deployed. 
     */
    public function actionInstallMenu() {
        Menu::model()->deleteAll();

        $ary[] = array("id" => "1", "pid" => "0", "root_parent" => "1", "controller" => "site", "action" => "index", "default_title" => "Darussalam", "user_title" => "Darussalam", "is_assigned" => "Yes", "min_permission" => "Index", "weight" => "0");

        /** for user module * */
        $ary[] = array("id" => "2", "pid" => "0", "root_parent" => "2", "controller" => "user", "action" => "index", "default_title" => "Admin Users", "user_title" => "Admin Users", "is_assigned" => "Yes", "min_permission" => "View", "weight" => "3");
        $ary[] = array("id" => "3", "pid" => "2", "root_parent" => "2", "controller" => "user", "action" => "index", "default_title" => "List All", "user_title" => "List All", "is_assigned" => "Yes", "min_permission" => "View", "weight" => "0");
        $ary[] = array("id" => "4", "pid" => "2", "root_parent" => "2", "controller" => "user", "action" => "create", "default_title" => "Create", "user_title" => "Create", "is_assigned" => "Yes", "min_permission" => "View", "weight" => "2");

        /* admin module for the User Role managment */

        $ary[] = array("id" => "5", "pid" => "0", "root_parent" => "5", "controller" => "userRole", "action" => "index", "default_title" => "User Role", "user_title" => "User Role", "is_assigned" => "Yes", "min_permission" => "View", "weight" => "3");
        $ary[] = array("id" => "6", "pid" => "5", "root_parent" => "5", "controller" => "userRole", "action" => "index", "default_title" => "List All", "user_title" => "List All", "is_assigned" => "Yes", "min_permission" => "View", "weight" => "0");
        $ary[] = array("id" => "7", "pid" => "5", "root_parent" => "5", "controller" => "userRole", "action" => "create", "default_title" => "Create", "user_title" => "Create", "is_assigned" => "Yes", "min_permission" => "View", "weight" => "2");


        /* admin module for the User Status managment */

        $ary[] = array("id" => "8", "pid" => "0", "root_parent" => "8", "controller" => "pages", "action" => "index", "default_title" => "Pages", "user_title" => "Pages", "is_assigned" => "Yes", "min_permission" => "View", "weight" => "3");
        $ary[] = array("id" => "9", "pid" => "8", "root_parent" => "8", "controller" => "pages", "action" => "index", "default_title" => "List All", "user_title" => "List All", "is_assigned" => "Yes", "min_permission" => "View", "weight" => "0");
        $ary[] = array("id" => "10", "pid" => "8", "root_parent" => "8", "controller" => "pages", "action" => "create", "default_title" => "Create", "user_title" => "Create", "is_assigned" => "Yes", "min_permission" => "View", "weight" => "2");


        /* admin module for the User Country managment */

        $ary[] = array("id" => "11", "pid" => "0", "root_parent" => "11", "controller" => "country", "action" => "index", "default_title" => "Country", "user_title" => "Country", "is_assigned" => "Yes", "min_permission" => "View", "weight" => "3");
        $ary[] = array("id" => "12", "pid" => "11", "root_parent" => "11", "controller" => "country", "action" => "index", "default_title" => "List All", "user_title" => "List All", "is_assigned" => "Yes", "min_permission" => "View", "weight" => "0");
        $ary[] = array("id" => "13", "pid" => "11", "root_parent" => "11", "controller" => "country", "action" => "create", "default_title" => "Create", "user_title" => "Create", "is_assigned" => "Yes", "min_permission" => "View", "weight" => "2");


        /* admin module for the User City managment */

        $ary[] = array("id" => "14", "pid" => "0", "root_parent" => "14", "controller" => "city", "action" => "index", "default_title" => "City", "user_title" => "City", "is_assigned" => "Yes", "min_permission" => "View", "weight" => "3");
        $ary[] = array("id" => "15", "pid" => "14", "root_parent" => "14", "controller" => "city", "action" => "index", "default_title" => "List All", "user_title" => "List All", "is_assigned" => "Yes", "min_permission" => "View", "weight" => "0");
        $ary[] = array("id" => "16", "pid" => "14", "root_parent" => "14", "controller" => "city", "action" => "create", "default_title" => "Create", "user_title" => "Create", "is_assigned" => "Yes", "min_permission" => "View", "weight" => "2");

        /* admin module for the User Language managment */

        $ary[] = array("id" => "17", "pid" => "0", "root_parent" => "17", "controller" => "language", "action" => "index", "default_title" => "Languages", "user_title" => "Languages", "is_assigned" => "Yes", "min_permission" => "View", "weight" => "3");
        $ary[] = array("id" => "18", "pid" => "17", "root_parent" => "17", "controller" => "language", "action" => "index", "default_title" => "List All", "user_title" => "List All", "is_assigned" => "Yes", "min_permission" => "View", "weight" => "0");
        $ary[] = array("id" => "19", "pid" => "17", "root_parent" => "17", "controller" => "language", "action" => "create", "default_title" => "Create", "user_title" => "Create", "is_assigned" => "Yes", "min_permission" => "View", "weight" => "2");


        /* admin module for the User Layouts managment */

        $ary[] = array("id" => "20", "pid" => "0", "root_parent" => "20", "controller" => "layout", "action" => "index", "default_title" => "Layouts", "user_title" => "Layouts", "is_assigned" => "Yes", "min_permission" => "View", "weight" => "3");
        $ary[] = array("id" => "21", "pid" => "20", "root_parent" => "20", "controller" => "layout", "action" => "index", "default_title" => "List All", "user_title" => "List All", "is_assigned" => "Yes", "min_permission" => "View", "weight" => "0");
        //$ary[] = array("id" => "22", "pid" => "20", "root_parent" => "20", "controller" => "layout", "action" => "create", "default_title" => "Create", "user_title" => "Create", "is_assigned" => "Yes", "min_permission" => "View", "weight" => "2");


        /* admin module for the site managment */

        $ary[] = array("id" => "23", "pid" => "0", "root_parent" => "23", "controller" => "selfSite", "action" => "index", "default_title" => "Site", "user_title" => "Site", "is_assigned" => "Yes", "min_permission" => "View", "weight" => "3");
        $ary[] = array("id" => "24", "pid" => "23", "root_parent" => "23", "controller" => "selfSite", "action" => "index", "default_title" => "List All", "user_title" => "List All", "is_assigned" => "Yes", "min_permission" => "View", "weight" => "0");
        $ary[] = array("id" => "25", "pid" => "23", "root_parent" => "23", "controller" => "selfSite", "action" => "create", "default_title" => "Create", "user_title" => "Create", "is_assigned" => "Yes", "min_permission" => "View", "weight" => "2");

        /* admin module for the Products managment */

        $ary[] = array("id" => "26", "pid" => "0", "root_parent" => "26", "controller" => "product", "action" => "index", "default_title" => "Products", "user_title" => "Products", "is_assigned" => "Yes", "min_permission" => "View", "weight" => "3");
        $ary[] = array("id" => "27", "pid" => "26", "root_parent" => "26", "controller" => "product", "action" => "index", "default_title" => "List All", "user_title" => "List All", "is_assigned" => "Yes", "min_permission" => "View", "weight" => "0");
        $ary[] = array("id" => "28", "pid" => "26", "root_parent" => "26", "controller" => "product", "action" => "create", "default_title" => "Create", "user_title" => "Create", "is_assigned" => "Yes", "min_permission" => "View", "weight" => "2");

        /* admin module for the Categories managment */

        $ary[] = array("id" => "29", "pid" => "0", "root_parent" => "29", "controller" => "categories", "action" => "index", "default_title" => "Product Categories", "user_title" => "Product Categories", "is_assigned" => "Yes", "min_permission" => "View", "weight" => "3");
        $ary[] = array("id" => "30", "pid" => "29", "root_parent" => "29", "controller" => "categories", "action" => "index", "default_title" => "List All", "user_title" => "List All", "is_assigned" => "Yes", "min_permission" => "View", "weight" => "0");
        $ary[] = array("id" => "31", "pid" => "29", "root_parent" => "29", "controller" => "categories", "action" => "create", "default_title" => "Create", "user_title" => "Create", "is_assigned" => "Yes", "min_permission" => "View", "weight" => "2");

        /* admin module for the Author managment */

        $ary[] = array("id" => "32", "pid" => "0", "root_parent" => "32", "controller" => "author", "action" => "index", "default_title" => "Author", "user_title" => "Author", "is_assigned" => "Yes", "min_permission" => "View", "weight" => "3");
        $ary[] = array("id" => "33", "pid" => "32", "root_parent" => "32", "controller" => "author", "action" => "index", "default_title" => "List All", "user_title" => "List All", "is_assigned" => "Yes", "min_permission" => "View", "weight" => "0");
        $ary[] = array("id" => "34", "pid" => "32", "root_parent" => "32", "controller" => "author", "action" => "create", "default_title" => "Create", "user_title" => "Create", "is_assigned" => "Yes", "min_permission" => "View", "weight" => "2");

        /* admin module for the Customer managment */

        $ary[] = array("id" => "35", "pid" => "0", "root_parent" => "35", "controller" => "customer", "action" => "index", "default_title" => "Customers", "user_title" => "Customers", "is_assigned" => "Yes", "min_permission" => "View", "weight" => "3");
        $ary[] = array("id" => "36", "pid" => "35", "root_parent" => "35", "controller" => "customer", "action" => "index", "default_title" => "List All", "user_title" => "List All", "is_assigned" => "Yes", "min_permission" => "View", "weight" => "0");


        /* admin module for the Translator Compiler managment */

        $ary[] = array("id" => "37", "pid" => "0", "root_parent" => "37", "controller" => "translatorCompiler", "action" => "index", "default_title" => "Author", "user_title" => "Translator Compiler", "is_assigned" => "Yes", "min_permission" => "View", "weight" => "3");
        $ary[] = array("id" => "38", "pid" => "37", "root_parent" => "37", "controller" => "translatorCompiler", "action" => "index", "default_title" => "List All", "user_title" => "List All", "is_assigned" => "Yes", "min_permission" => "View", "weight" => "0");
        $ary[] = array("id" => "39", "pid" => "37", "root_parent" => "37", "controller" => "translatorCompiler", "action" => "create", "default_title" => "Create", "user_title" => "Create", "is_assigned" => "Yes", "min_permission" => "View", "weight" => "2");

        /** FOr order module * */
        $ary[] = array("id" => "40", "pid" => "0", "root_parent" => "40", "controller" => "order", "action" => "index", "default_title" => "Order", "user_title" => "Order", "is_assigned" => "Yes", "min_permission" => "View", "weight" => "3");
        $ary[] = array("id" => "41", "pid" => "40", "root_parent" => "40", "controller" => "order", "action" => "index", "default_title" => "List All", "user_title" => "List All", "is_assigned" => "Yes", "min_permission" => "View", "weight" => "0");

        /**
         * Category other links
         */
        $ary[] = array("id" => "42", "pid" => "29", "root_parent" => "29", "controller" => "categories", "action" => "createParent", "default_title" => "Create Parent", "user_title" => "Create Parent", "is_assigned" => "Yes", "min_permission" => "View", "weight" => "2");
        $ary[] = array("id" => "43", "pid" => "29", "root_parent" => "29", "controller" => "categories", "action" => "indexParent", "default_title" => "List All Parent", "user_title" => "List All Parent", "is_assigned" => "Yes", "min_permission" => "View", "weight" => "2");

        /**
         * product module 
         */
        $ary[] = array("id" => "44", "pid" => "26", "root_parent" => "26", "controller" => "product", "action" => "slider", "default_title" => "Make Slider", "user_title" => "Make Slider", "is_assigned" => "Yes", "min_permission" => "View", "weight" => "2");
        $ary[] = array("id" => "45", "pid" => "26", "root_parent" => "26", "controller" => "product", "action" => "sliderSetting", "default_title" => "Slider Settings", "user_title" => "Slider Settings", "is_assigned" => "Yes", "min_permission" => "View", "weight" => "2");

        //shipping class
        $ary[] = array("id" => "46", "pid" => "0", "root_parent" => "46", "controller" => "shippingClass", "action" => "index", "default_title" => "Shipping Class", "user_title" => "Shipping Class", "is_assigned" => "Yes", "min_permission" => "View", "weight" => "3");
        $ary[] = array("id" => "47", "pid" => "46", "root_parent" => "46", "controller" => "shippingClass", "action" => "index", "default_title" => "List All", "user_title" => "List All", "is_assigned" => "Yes", "min_permission" => "View", "weight" => "0");
        $ary[] = array("id" => "48", "pid" => "46", "root_parent" => "46", "controller" => "shippingClass", "action" => "create", "default_title" => "Create", "user_title" => "Create", "is_assigned" => "Yes", "min_permission" => "View", "weight" => "2");

        //import class
        $ary[] = array("id" => "49", "pid" => "0", "root_parent" => "49", "controller" => "import", "action" => "index", "default_title" => "Import", "user_title" => "Import", "is_assigned" => "Yes", "min_permission" => "status", "weight" => "3");
        $ary[] = array("id" => "50", "pid" => "49", "root_parent" => "49", "controller" => "import", "action" => "mappingList", "default_title" => "List All", "user_title" => "List All", "is_assigned" => "Yes", "min_permission" => "status", "weight" => "0");
        $ary[] = array("id" => "51", "pid" => "49", "root_parent" => "49", "controller" => "import", "action" => "index", "default_title" => "Create Import", "user_title" => "Create Import", "is_assigned" => "Yes", "min_permission" => "status", "weight" => "2");
        
        //rates import class
        $ary[] = array("id" => "52", "pid" => "0", "root_parent" => "52", "controller" => "zone", "action" => "index", "default_title" => "Zone Rates", "user_title" => "Zone Rates", "is_assigned" => "Yes", "min_permission" => "View", "weight" => "3");
        $ary[] = array("id" => "53", "pid" => "52", "root_parent" => "52", "controller" => "zone", "action" => "index", "default_title" => "List All", "user_title" => "List All", "is_assigned" => "Yes", "min_permission" => "View", "weight" => "0");
        $ary[] = array("id" => "54", "pid" => "52", "root_parent" => "52", "controller" => "zone", "action" => "uploadRates", "default_title" => "Upload Rates", "user_title" => "Create Import", "is_assigned" => "Yes", "min_permission" => "View", "weight" => "2");

        
        foreach ($ary as $attr) {
            $model = new Menu();
            $model->attributes = $attr;
            CVarDumper::dump($model->attributes, 10, true);

            if (!$model->save()) {
                CVarDumper::dump($model->getErrors(), 10, true);
            }
        }
    }

    public function updateWpbaseUrl() {
        $url = Yii::app()->request->hostInfo . Yii::app()->baseUrl . "/wp";

        WpOptions::model()->updateByPk(1, array("option_value" => $url));
        WpOptions::model()->updateByPk(36, array("option_value" => $url));
        WpOptions::model()->updateByPk(44, array("option_value" => "dtechtheme"));
        WpOptions::model()->updateByPk(45, array("option_value" => "dtechtheme"));
    }

    /*
     * function to remove assets data
     * 
     * 
     */

    public function actionRebuildAssets() {
        $this->deleteDir();
    }

    /**
     * for linux
     */
    public function deleteDir() {

        $basePath = Yii::app()->basePath;

        if (strstr($basePath, "protected")) {
            $basePath = realPath($basePath . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR);
        }

        $assets_path = $basePath . DIRECTORY_SEPARATOR . "assets" . DIRECTORY_SEPARATOR;

        if (stristr(PHP_OS, 'Linux')) {



            if (is_dir($assets_path) && $handle = opendir($assets_path)) {


                /* This is the correct way to loop over the directory. */
                while (($file = readdir($handle)) !== false) {

                    if ($file != "." && $file != "..") {

                        echo $assets_path . $file;
                        echo "<br/>";
                        exec('rm -rf ' . $assets_path . $file);
                    }
                }


                closedir($handle);
            }
        }
    }

}
