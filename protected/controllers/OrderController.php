<?php

class OrderController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';
    public $filters;

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            // 'accessControl', // perform access control for CRUD operations
            'rights',
            'https + index + view + update + create + manageOderHistory',
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
     * Initialize Left site filters
     */
    public function init() {
        parent::init();

        $criteria = new CDbCriteria();
        $criteria->select = "id,name";
        $paymentModels = ConfPaymentMethods::model()->findAll($criteria);

        /* Set filters and default active */
        $this->filters = array(
            'status' => Status::model()->gettingOrderStatus() + array("" => "All"),
            'payment_method_id' => CHtml::listData($paymentModels, "id", "name") + array("" => "All"),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $model = $this->loadModel($id);

        /**
         * order detail part
         * 
         */
        $model_d = new OrderDetail('Search');
        $model_d->unsetAttributes();  // clear any default values
        $model_d->order_id = $id;
        if (isset($_GET['OrderDetail'])) {
            $model_d->attributes = $_GET['Order'];
        }

        $orderStatuses = Status::model()->gettingOrderStatus();

        $order_history = $this->manageOderHistory($model_d, $orderStatuses);
        $this->render('view', array(
            'model' => $model,
            'model_d' => $model_d,
            'order_history' => $order_history,
            'orderStatuses' => $orderStatuses
        ));
    }

    /**
     * print the statment
     * @param type $id
     */
    public function actionPrint($id) {
        $this->layout = "";

        $model = $this->loadModel($id);

        /**
         * order detail part
         * 
         */
        $model_d = new OrderDetail('Search');
        $model_d->unsetAttributes();  // clear any default values
        $model_d->order_id = $id;
        if (isset($_GET['Order'])) {
            $model_d->attributes = $_GET['Order'];
        }
        $orderStatuses = Status::model()->gettingOrderStatus();

        $order_history = $this->manageOderHistory($model_d, $orderStatuses);
        $this->renderPartial('print', array(
            'model' => $model,
            'model_d' => $model_d,
            'order_history' => $order_history
                ), false, false);
    }

    /**
     * manage order history for 
     * in admin panel
     * that wll trakc the order
     * all $orderStatuses;
     */
    public function manageOderHistory($order, $orderStatuses) {
        $orderHistory = new OrderHistory();

        $orderHistory->user_id = Yii::app()->user->id;
        $orderHistory->order_id = $order->order_id;

        if (isset($_POST['OrderHistory'])) {
            $orderHistory->attributes = $_POST['OrderHistory'];


            if ($orderHistory->save()) {
                $old_status = $order->order->status;
                Order::model()->updateByPk($order->order_id, array("status" => $orderHistory->status));
                $order = Order::model()->findByPk($order->order_id);



                $this->manageStock($old_status, $order, $orderStatuses);
                if ($orderHistory->is_notify_customer == 1) {
                    /**
                     * if admin wants to comments in email then this comment
                     * var will be filled
                     */
                    $comments = $orderHistory->include_comment == 1 ? $orderHistory->comment : "";
                    $this->sendStatusEmail($order, $old_status, $comments);
                }
                $this->redirect($this->createUrl("view", array("id" => $order->order_id)));
            }
        }

        return $orderHistory;
    }

    /**
     * will be only use for update status
     * @param type $id
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        $old_status = $model->status;


        if (isset($_POST['Order'])) {
            $model->attributes = $_POST['Order'];

            $model->updateByPk($id, array("status" => $model->status, "update_time" => new CDbExpression('NOW()')));
            $model->generateAudit();



            $this->manageStock($old_status, $model, $model->all_status);
            if ($model->notifyUser == 1) {
                $this->sendStatusEmail($model, $old_status);
            }
            /**
             * if not in case of ajax
             */
            if (!isset($_POST['ajax'])) {
                $this->redirect(array("view", "id" => $id));
            }
        }
        if (!isset($_POST['ajax'])) {
            $this->render('update', array(
                'model' => $model,
            ));
        }
    }

    /**
     *  manage stock for product in 
     *  admin in 
     *  while performing the task 
     * @param type $old_status
     * @param type $model
     * @param $orderStatuses = Status::model()->gettingOrderStatus();
     */
    public function manageStock($old_status, $model, $orderStatuses) {

        /*
         * check wether the order status is shipped or not
         * its old status is process or pending
         * by calling the function 
         */
        if (($orderStatuses[$old_status] == "Process" || $orderStatuses[$old_status] == "Pending") && $orderStatuses[$model->status] == 'Shipped') {
            $model->decreaseStock();
            Yii::app()->user->setFlash("status", "Your products stock has been updated (Decreased)");
        }

        /*
         * Logic to proces when an order is canceld  
         * and its last status is completed
         */

        if ($orderStatuses[$old_status] == "Shipped" &&
                ($orderStatuses[$model->status] == 'Cancelled' || $orderStatuses[$model->status] == 'Refunded')) {
            $model->increaseStock();
            Yii::app()->user->setFlash("status", "Your products stock has been updated  (Increased)");
        }
    }

    /**
     * 
     * @param type $model
     * @param type $oldStatus
     * @param type $comments
     * 
     * send status email
     * old status changes to new 
     */
    public function sendStatusEmail($model, $oldStatus, $comments = "") {

        $orderStatuses = Status::model()->gettingOrderStatus();

        $email['To'] = $model->user->user_email;
        $email['From'] = Yii::app()->params['adminEmail'];
        $email['Subject'] = "Order #" . $model->order_id . " has been changed ";
        $email['Body'] = "Your order #" . $model->order_id . " status has been changes from " . $orderStatuses[$oldStatus] . " to " . $orderStatuses[$model->status];
        $email['Body'].= "<br/>" . $comments;

        $email['Body'] = $this->renderPartial('/common/_email_template', array('email' => $email), true, false);

        $this->sendEmail2($email);
    }

    /**
     * managing order detail quanity 
     * will show the user thats product is updated 
     * the quantity or not
     * @param type $id
     */
    public function actionOrderProductQuantity($id) {
        $order_detail = OrderDetail::model()->findByPk($id);
        if (isset($_POST['OrderDetail'])) {
            $order_detail->attributes = $_POST['OrderDetail'];

            $order_detail->quantity = $_POST['OrderDetail']['quantity'];

            $productProfile = ProductProfile::model()->findByPk($order_detail->product_profile_id);

            if ($order_detail->quantity <= $productProfile->quantity) {

                OrderDetail::model()->updateByPk($id, array("quantity" => $order_detail->quantity));
                $orderDetail = OrderDetail::model()->findByPk($id);
                $orderDetail->saveOrderDetailHistory();
            } else {
                echo "None";
            }
        }
    }

    /**
     * revert the line item to product
     * @param type $id
     */
    public function actionRevertlineItem($id) {

        $model = OrderDetail::model()->findByPk($id);
        /**
         * send back form will treate to send this product
         * to revert
         */
        $sendBackForm = new SendBackStock();
        $sendBackForm->order_quantity = $model->quantity;
        $sendBackForm->back_quanity = $model->quantity;

        if (isset($_POST['SendBackStock'])) {
            $sendBackForm->attributes = $_POST['SendBackStock'];
            if ($sendBackForm->validate()) {
                $available_quantity = $sendBackForm->order_quantity - $sendBackForm->back_quanity;
                OrderDetail::model()->updateByPk($id, array("quantity" => $available_quantity));
                $orderDetail = OrderDetail::model()->findByPk($id);
                /**
                 * senback to stock dats y 
                 */
                /**
                 * if both quanity are equal then product is fully reverted
                 */
                if ($sendBackForm->order_quantity == $sendBackForm->back_quanity) {
                    $orderDetail->saveOrderDetailHistory(1);
                } else {
                    /**
                     * 2 is for partially reverted item
                     */
                    $orderDetail->saveOrderDetailHistory(2);
                }

                ProductProfile::model()->updateStock($sendBackForm->back_quanity, $orderDetail->product_profile_id);
            }
        }

        $this->renderPartial("_stock", array(
            "model" => $model,
            'sendBackForm' => $sendBackForm,
                ), false, true);
    }

    /**
     * update address for shipping 
     * and billing
     */
    public function actionUpdateuseraddress($id, $model) {
        $addressModel = $model::model()->findByPk($id);
        $regionList = CHtml::listData(Region::model()->findAll(), 'id', 'name');
        /**
         * 
         */
        if (isset($_POST[$model])) {
            $addressModel->attributes = $_POST[$model];
            if ($addressModel->save()) {
                $this->redirect($this->createUrl("/order/updateuseraddress", array("id" => $id, "model" => $model)));
            }
        }

        $this->renderPartial("_change_billing_shipping", array(
            "model" => $addressModel,
            'regionList' => $regionList,
            "address" => $model
                ), false, true);
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
        $model = new Order('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Order']))
            $model->attributes = $_GET['Order'];


        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionOrderDetail($id) {

        $model = new OrderDetail('Search');
        $model->unsetAttributes();  // clear any default values
        $model->order_id = $id;
        if (isset($_GET['Order'])) {
            $model->attributes = $_GET['Order'];
        }
        $this->renderPartial('_order_detail', array(
            'model' => $model,
            'user_name' => $_POST['username'],
            "parent_model" => Order::model()->findByPk($id),
                ), false, true);
        Yii::app()->end();
    }

    /**
     * hisotry of line items
     */
    public function actionHisotryLineItem($id) {
        $model = new OrderHistoryDetail('Search');
        $model->unsetAttributes();  // clear any default values
        $model->order_detail_id = $id;
        if (isset($_GET['OrderHistoryDetail'])) {
            $model->attributes = $_GET['OrderHistoryDetail'];
        }

        $this->renderPartial("_order_detail_history", array("model" => $model));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Order the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Order::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Order $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'order-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
