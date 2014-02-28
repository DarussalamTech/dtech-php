<?php

class CategoriesController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';
    public $filters;

    public function beforeAction($action) {
        Yii::app()->theme = "admin";
        parent::beforeAction($action);

        $operations = array('create', 'update', 'index', 'delete');
        parent::setPermissions($this->id, $operations);

        return true;
    }

    /**
     * Initialize Project Report
     */
    public function init() {
        parent::init();

        /* Set filters and default active */
        $this->filters = array(
            'parent_id' => Categories::model()->getParentCategories(),
        );
    }

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            // 'accessControl', // perform access control for CRUD operations
            'rights',
            'https + index + view + update + create + createParent + updateParent +indexParent',
        );
    }

    public function allowedActions() {
        return '@';
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {

        if (!isset($_POST['children'])) {

            $model = $this->loadModel($id, true);
        } else {

            $model = $this->loadModel($id);
        }


        $this->manageChildrens($model);

        $this->render('view', array(
            'model' => $model,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Categories();

        global $categotyList;

        $this->changeAdminCity();
        $model->city_id = Yii::app()->session['city_id'];

        $parentCategories = Categories::model()->findAllByAttributes(
                array(
                    'parent_id' => 0,
                    'city_id' => Yii::app()->session['city_id']
                )
        );

        if ($parentCategories != null) {
            foreach ($parentCategories as $category) {
                $categotyList[] = array('category_id' => $category->category_id, 'category_name' => $category->category_name);
                $this->getSubCategories($category->category_id, $category->category_name);
            }
        }
        if (empty($categotyList)) {
            $categotyList = array();
        }
        $categoriesList = CHtml::listData($categotyList, 'category_id', 'category_name');
        $cityList = CHtml::listData(City::model()->findAll(), 'city_id', 'city_name');
        unset($categotyList);


        // Uncomment the following line if AJAX validation is needed
        if (isset($_POST['Categories'])) {


            $model->attributes = $_POST['Categories'];
            $model->added_date = time();
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->category_id));
        }

        $this->render('create', array(
            'model' => $model,
            'categoriesList' => $categoriesList,
            'cityList' => $cityList
        ));
    }

    /**
     * Creating parent categories
     */
    public function actionCreateParent() {

        $model = new Categories;
        // $model->attachCbehavour();
        // Uncomment the following line if AJAX validation is needed
        if (isset($_POST['Categories'])) {

            $model->attributes = $_POST['Categories'];
            $model->added_date = time();

            //making instance of the uploaded image 
            $img_file = DTUploadedFile::getInstance($model, 'category_image');
            $model->category_image = $img_file;
            if ($model->save()) {

                $upload_path = DTUploadedFile::creeatRecurSiveDirectories(array("parent_category", $model->category_id));
                if (!empty($img_file)) {
                    $img_file->saveAs($upload_path . $img_file->name);
                }

                $this->redirect(array('view', 'id' => $model->category_id));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function getSubCategories($sub_catetory_id, $category_name) {
        global $categotyList;
        $childCategories = Categories::model()->findAllByAttributes(array('parent_id' => $sub_catetory_id));
        if ($childCategories != null) {
            foreach ($childCategories as $child) {
                $categotyList[] = array('category_id' => $child->category_id, 'category_name' => $category_name . ' ->' . $child->category_name);
                $this->getSubCategories($child->category_id, $category_name . '->' . $child->category_name);
            }
        }
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        global $categotyList;

        $this->changeAdminCity();

        $parentCategories = Categories::model()->findAllByAttributes(array('parent_id' => '0'));
        if ($parentCategories != null) {
            foreach ($parentCategories as $category) {
                $categotyList[] = array('category_id' => $category->category_id, 'category_name' => $category->category_name);
                $this->getSubCategories($category->category_id, $category->category_name);
            }
        }
        if (empty($categotyList)) {
            $categotyList = array();
        }
        $categoriesList = CHtml::listData($categotyList, 'category_id', 'category_name');
        $cityList = CHtml::listData(City::model()->findAll(), 'city_id', 'city_name');
        unset($categotyList);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        
        if (isset($_POST['Categories'])) {
            $model->attributes = $_POST['Categories'];
            
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->category_id));
        }

        $this->render('update', array(
            'model' => $model,
            'categoriesList' => $categoriesList,
            'cityList' => $cityList
        ));
    }

    /**
     * Creating parent categories
     */
    public function actionUpdateParent($id) {

        $model = $this->loadModel($id);

        $old_img = $model->category_image;
       
        // Uncomment the following line if AJAX validation is needed
        if (isset($_POST['Categories'])) {
            $model->attributes = $_POST['Categories'];

            $img_file = DTUploadedFile::getInstance($model, 'category_image');
            $model->category_image = $img_file;

            if (empty($model->category_image)) {

                // conditon for if no image submited then old img should not be deleted
                $model->category_image = $old_img;
            }
            
            if ($model->save()) {
                $upload_path = DTUploadedFile::creeatRecurSiveDirectories(array("parent_category", $model->category_id));
                if (!empty($img_file)) {
                    $img_file->saveAs($upload_path . $img_file->name);
                }

                $this->redirect(array('view', 'id' => $model->category_id));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Manages all models.
     */
    public function actionIndex() {
        $model = new Categories('search');

        $this->init();
        $model->unsetAttributes();  // clear any default values
        $model->city_id = Yii::app()->request->getQuery('city_id');

        if (isset($_GET['Categories']))
            $model->attributes = $_GET['Categories'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Manage parent categories
     */
    public function actionIndexParent() {

        $model = new Categories('search');

        $this->init();
        $model->unsetAttributes();   // clear any default values

        $model->city_id = Yii::app()->request->getQuery('city_id');

        $model->parent_id = 0;
        if (isset($_GET['Categories']))
            $model->attributes = $_GET['Categories'];



        $this->render('index_parent', array(
            'model' => $model,
        ));
    }

    /**
     * update order of categories
     */
    public function actionUpdateOrder() {

        if (isset($_POST['items'])) {
            foreach ($_POST['items'] as $key => $item) {
                $id_array = explode(" ", $item);
                $id = trim($id_array[0]);


                Categories::model()->updateByPk($id, array("user_order" => $key));
            }
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Categories the loaded model
     * @throws CHttpException
     */
    public function loadModel($id, $ml = false) {
        $model = Categories::model()->findByPk((int) $id);
        if ($model === null)
            throw new CHttpException(404, 'The requested post does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Categories $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'categories-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /*
     * managing recrods
     * at create
     */

    private function checkCilds($model) {

        if (isset($_POST['ProductCategories'])) {
            $model->setRelationRecords('productCategories', is_array($_POST['ProductCategories']) ? $_POST['ProductCategories'] : array());
        }

        return true;
    }

    /**
     * will be used to manage child at 
     * view mode
     * @param type $model 
     */
    private function manageChildrens($model) {

        $this->manageChild($model, "catlangs", "category");
    }

    /**
     *
     * @param <type> $mName
     * @param <type> $index
     */
    public function actionLoadChildByAjax($mName, $dir, $load_for, $index, $upload_index = "") {
        /* Get regarding model */
        $model = new $mName;

        $this->renderPartial($dir . '/_fields_row', array(
            'index' => $index,
            'model' => $model,
            "load_for" => $load_for,
            'dir' => $dir,
            'upload_index' => isset($_REQUEST['upload_index']) ? $_REQUEST['upload_index'] : "",
            'fields_div_id' => $dir . '_fields'), false, true);
    }

    /**
     *
     * @param <type> $id
     * @param <type> $mName
     * @param <type> $dir 
     */
    public function actionEditChild($id, $mName = "", $dir = "") {

        /* Get regarding model */
        $model = new $mName;
        $render_view = $dir . '/_fields_row';

        $model = $model->findByPk($id);


        $this->renderPartial($render_view, array('index' => 1, 'model' => $model,
            "load_for" => "view", 'dir' => $dir, "displayd" => "block",
            'fields_div_id' => $dir . '_fields',
                ), false, true);
    }

    /**
     * delete child by ajax
     * @param type $id
     * @param type $mName
     * @throws CHttpException 
     */
    public function actionDeleteChildByAjax($id, $mName) {





        if (Yii::app()->request->isAjaxRequest) {
            /* Get regarding model */
            $model = new $mName;

            $model = $model->findByPk($id);

            $model->deleteByPk($id);
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

}
