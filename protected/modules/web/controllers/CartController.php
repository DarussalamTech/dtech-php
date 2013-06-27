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
            $cart_model->save();
        }
        /*         * -
         * handling for cart on front page
         */

        if (isset($_REQUEST['from'])) {
            $view = "//cart/_cart";
        }
        $cart = Cart::model()->getCartLists();
        $cart_list_count = Cart::model()->getCartListCount();


        $_view_cart = $this->renderPartial($view, array('cart' => $cart), true, true);
        echo CJSON::encode(array("_view_cart" => $_view_cart, "cart_list_count" => $cart_list_count));
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

}

?>
