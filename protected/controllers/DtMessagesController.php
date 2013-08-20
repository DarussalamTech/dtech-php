<?php

class DtMessagesController extends Controller {

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
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array(
                    'create', 'update', 'index', 'view',
                    'admin', 'delete',
                    'loadChildByAjax',
                    'editChild',
                    'loadChildByAjax',
                    'deleteChildByAjax',
                    'generate'
                ),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function beforeAction($action) {
        Yii::app()->theme = "admin";
        parent::beforeAction($action);

        $operations = array('create', 'update', 'index', 'delete');
        parent::setPermissions($this->id, $operations);

        return true;
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $model = $this->loadModel($id);
        $this->manageChildrens($model);

        $this->render('view', array(
            'model' => $model,
        ));
    }

//    /**
//     * Creates a new model.
//     * If creation is successful, the browser will be redirected to the 'view' page.
//     */
//    public function actionCreate() {
//        $model = new DtMessages;
//
//        // Uncomment the following line if AJAX validation is needed
//        // $this->performAjaxValidation($model);
//
//        if (isset($_POST['DtMessages'])) {
//            $model->attributes = $_POST['DtMessages'];
//            if ($model->save())
//                $this->redirect(array('view', 'id' => $model->id));
//        }
//
//        $this->render('create', array(
//            'model' => $model,
//        ));
//    }
//
//    /**
//     * Updates a particular model.
//     * If update is successful, the browser will be redirected to the 'view' page.
//     * @param integer $id the ID of the model to be updated
//     */
//    public function actionUpdate($id) {
//        $model = $this->loadModel($id);
//
//        // Uncomment the following line if AJAX validation is needed
//        // $this->performAjaxValidation($model);
//
//        if (isset($_POST['DtMessages'])) {
//            $model->attributes = $_POST['DtMessages'];
//            if ($model->save())
//                $this->redirect(array('view', 'id' => $model->id));
//        }
//
//        $this->render('update', array(
//            'model' => $model,
//        ));
//    }
//
//    /**
//     * Deletes a particular model.
//     * If deletion is successful, the browser will be redirected to the 'admin' page.
//     * @param integer $id the ID of the model to be deleted
//     */
//    public function actionDelete($id) {
//        $this->loadModel($id)->delete();
//
//        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
//        if (!isset($_GET['ajax']))
//            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
//    }

    /**
     * Manages all models.
     */
    public function actionIndex() {
        $model = new DtMessages('search');
        $model->unsetAttributes();  // clear any default values

        /**
         * 
         */
        if (isset($_GET['category'])) {
            $model->category = $_GET['category'];
        }
        if (isset($_GET['DtMessages']))
            $model->attributes = $_GET['DtMessages'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return DtMessages the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = DtMessages::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param DtMessages $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'dt-messages-form') {
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

        $this->manageChild($model, "messages", "sourceMessage");
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

        $model = $model->find("id=" . $id);


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

    public $files;

    /**
     * generate languages translation against
     * this category
     * 
     */
    public function actionGenerate() {
        if (isset($_GET['category'])) {
            $data = DtMessages::model()->findAll("category ='{$_GET['category']}'");
            $this->layout = "";
            $str = "<?php " . PHP_EOL;
            $str.='$common_t =  array(' . PHP_EOL;
            foreach ($data as $d) {

                $str.= '"' . $d->message . '" => "' . $d->arabic_messages[0]->message . '",' . PHP_EOL;
            }
            $str.=' ); ' . PHP_EOL;
            $category = $_GET['category'];
            $str.=' return $' . $category . '_t;' . PHP_EOL;
            $str.= "?>";



            $path = Yii::getPathOfAlias('application.messages.ar.' . $_GET['category']) . '.php';


            $ad = new CCodeFile($path, $str);

            $ad->save();
            Yii::app()->user->setFlash("message","Languages has been updated successfully");
            $this->redirect($this->createUrl("/dtMessages/index"));
        }
    }

}
