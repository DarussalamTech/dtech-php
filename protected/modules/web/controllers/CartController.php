<?php

/**
 *  Cart Controller
 */
class CartController extends Controller {

    /**
     * view cart page
     */
    public function actionViewcart() {


        Yii::app()->user->SiteSessions;

        $cart = Cart::model()->getCartLists();

        $this->render('//cart/viewcart', array('cart' => $cart));
    }

    /**
     * set Total amount in session
     */
    public function setTotalAmountSession($grand_total, $total_quantity, $description) {
        Yii::app()->session['total_price'] = round($grand_total, 2);
        Yii::app()->session['quantity'] = $total_quantity;
        Yii::app()->session['description'] = $description;
    }
    
    /**
     * delete Cart 
     */
    
    public function actionDeleteCart($id){
        Cart::model()->findByPk($id)->delete();
    }

    /**
     * edit or delete cart
     */
    public function actionEditcart() {

        Yii::app()->user->SiteSessions;



        $view = "//cart/_view_cart";
        if ($_REQUEST['type'] == 'delete_cart') {
            $cart_model = new Cart();

            Cart::model()->deleteByPk($_REQUEST['cart_id']);
        } else {
            $cart_model = new Cart();
            $cart = $cart_model->find('cart_id=' . $_REQUEST['cart_id']);
            $cart_model = $cart;
            $cart_model->quantity = $_REQUEST['quantity'];

            $criteria = new CDbCriteria();
            $criteria->select = "quantity";
            $product_pf = ProductProfile::model()->findByPk($cart_model->product_profile_id, $criteria);

            /**
             * get particular product counter in cart
             */
            $total_in_cart = Cart::model()->getTotalCountProduct($cart_model->product_profile_id);

            $total_available = $product_pf->quantity - $total_in_cart;

            /**
             * available is fal
             */
            $available = false;

            if ($cart_model->quantity < $total_available) {

                $cart_model->save();
                $available = true;
            }
        }
        /*         * -
         * handling for cart on front page
         */

        if (isset($_REQUEST['from'])) {
            $view = "//cart/_cart";
        }
        $cart = Cart::model()->getCartLists();
        $cart_list_count = Cart::model()->getCartListCount();


        $_view_cart = $this->renderPartial($view, array('cart' => $cart, "available" => isset($available) ? $available : "",
            "request_quantity" => isset($_REQUEST['quantity']) ? $_REQUEST['quantity'] : ""), true, true);
        echo CJSON::encode(array("_view_cart" => $_view_cart, "cart_list_count" => $cart_list_count,
            "total_available" => isset($total_available) ? $total_available : "",
            "available" => $available,
        ));
    }

    /**
     * load cart again
     */
    public function actionLoadCart() {

        Yii::app()->user->SiteSessions;

        $cart = Cart::model()->getCartLists();
        $cart_list_count = Cart::model()->getCartListCount();


        $_view_cart = $this->renderPartial("//cart/_cart", array('cart' => $cart), true, true);
        echo CJSON::encode(array("_view_cart" => $_view_cart, "cart_list_count" => $cart_list_count));
    }

    /**
     * on email admin
     */
    public function actionEmailtoAdmin($id) {

        Yii::app()->user->SiteSessions;

        $model = new EmailToAdmin();

        if (isset($_POST['EmailToAdmin'])) {
            $model->attributes = $_POST['EmailToAdmin'];
            if ($model->validate()) {
                $email['From'] = $model->email;

                $productProfile = ProductProfile::model()->findByPk($id);

                $email['To'] = User::model()->getCityAdmin();
                $email['Subject'] = "This product is out of stock";
                $email['Body'] = "This product is out of stock kindly make available to us and send me email";
                $url = Yii::app()->request->hostInfo . $this->createUrl("/product/viewImage/", array("id" => $product_profile_id));
                $email['Body'].=" <br/>" . CHtml::link($productProfile->item_code, $url);
                $email['Body'] = $this->renderPartial('/common/_email_template', array('email' => $email), true, false);

                $this->sendEmail2($email);
                Yii::app()->user->setFlash('send', "Your Query has been send to admin successfully");
                $this->redirect($this->createUrl("/web/cart/emailtoAdmin",array("id"=>$id)));
            }
        }

        $this->render("//cart/emailtoadmin", array("model" => $model));
    }

}

?>
