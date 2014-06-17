<?php

class CustomerController extends Controller {

    public $layout = '//layouts/column2';

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            // 'accessControl', // perform access control for CRUD operations
            'rights',
            'https + index + view + update + create + orderDetail + ordersList',
        );
    }

    public function allowedActions() {
        return '@';
    }

    public function beforeAction($action) {
        Yii::app()->theme = "abound";
        parent::beforeAction($action);
        unset(Yii::app()->clientScript->scriptMap['jquery.js']);
        $operations = array('create', 'update', 'index', 'delete');
        parent::setPermissions($this->id, $operations);

        return true;
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
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = UserUpdate::model()->findByPk($id);
        $cityList = CHtml::listData(City::model()->findAll(), 'city_id', 'city_name');

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->user_id));
        }

        $this->render('update', array(
            'model' => $model,
            'cityList' => $cityList,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $model = $this->loadModel($id);

        $delete = 1;

        if (count($model->orders) > 0) {
            $delete = 0;
        }
        if (count($model->userProfiles) > 0) {
            $delete = 0;
        }

        if ($delete == 1) {
            Yii::app()->db->createCommand("SET FOREIGN_KEY_CHECKS=0;")->execute();

            $model->deleteByPk($id);
            Yii::app()->db->createCommand("SET FOREIGN_KEY_CHECKS=1;")->execute();

            Yii::app()->user->setFlash('success', "Customer has been deleted successfully");
        } else {
            Yii::app()->user->setFlash('errorIntegrity', "Customer cannot be deleted because its related with orders or profile");
        }


        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
    }

    /**
     * Manages all models.
     */
    public function actionIndex() {

        $model = new User('searchCustomer');

        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['User'])) {
            $model->attributes = $_GET['User'];
        }
        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionOrdersList() {
        $model = new Order('Search');
        $model->unsetAttributes();  // clear any default values
        $model->user_id = $_REQUEST['id'];
        if (isset($_GET['User'])) {
            $model->attributes = $_GET['Order'];
        }
        $this->render('orders_list', array(
            'model' => $model,
        ));
    }

    public function actionOrderDetail($id) {

        $model = new OrderDetail('Search');
        $model->unsetAttributes();  // clear any default values
        $model->order_id = $id;
        if (isset($_GET['User'])) {
            $model->attributes = $_GET['Order'];
        }
        $this->renderPartial('_order_detail', array(
            'model' => $model,
            'user_name' => $_POST['username'],
        ));
        Yii::app()->end();
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return User the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = User::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param User $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
