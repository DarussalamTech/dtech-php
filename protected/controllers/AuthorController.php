<?php

class AuthorController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    public function beforeAction($action) {
        parent::beforeAction($action);
        Yii::app()->theme = "admin";
        $operations = array('create', 'update', 'index', 'delete');
        parent::setPermissions($this->id, $operations);
        


        return true;
    }

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            // 'accessControl', // perform access control for CRUD operations
            'rights',
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
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Author;
         

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Author'])) {
            $model->attributes = $_POST['Author'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->author_id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Author'])) {
            $model->attributes = $_POST['Author'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->author_id));
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
        $model = new Author('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Author']))
            $model->attributes = $_GET['Author'];

        $this->render('index', array(
            'model' => $model,
        ));
    }
    
        /**
     * update order of categories
     */
    public function actionUpdateOrder(){
       
        if(isset($_POST['items'])){
            foreach($_POST['items'] as $key=>$item){
                $id_array = explode(" ",$item);
                $id = trim($id_array[0]);
      
                
                Author::model()->updateByPk($id,array("user_order"=>$key));
            }
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Author the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Author::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Author $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'author-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
