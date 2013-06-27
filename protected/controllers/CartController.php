<?php

/**
 *  to handle every cart information 
 *  adding removing here
 */
class CartController extends Controller {

    /**
     * 
     */
    public function actionAddtocart() {

        $ip = Yii::app()->request->getUserHostAddress();
        $cart_model = new Cart();
        if (isset(Yii::app()->user->id)) {
            $cart = $cart_model->find('product_profile_id=' . $_REQUEST['product_profile_id'] . ' AND (user_id=' . Yii::app()->user->id . ' OR session_id="' . $ip . '")');
            $ip = '';
        } else {
            $cart = $cart_model->find('product_profile_id=' . $_REQUEST['product_profile_id'] . ' AND session_id="' . $ip . '"');
        }
        if ($cart != null) {
            $cart_model = $cart;
            $cart_model->quantity = $cart->quantity + $_REQUEST['quantity'];
        } else {
            $cart_model = new Cart();
            $cart_model->quantity = $_REQUEST['quantity'];
            $cart_model->product_profile_id = $_REQUEST['product_profile_id'];
            $cart_model->user_id = Yii::app()->user->id;
            $cart_model->city_id = Yii::app()->session['city_id'];
            $cart_model->added_date = date(Yii::app()->params['dateformat']);
            $cart_model->session_id = $ip;
        }

        $cart_model->save();


        //count total added products in cart
        
        $cart_tot = Cart::model()->getCartListCount();

        echo CJSON::encode(array('product_profile_id' => $_REQUEST['product_profile_id'], 'cart_counter' => $cart_tot['cart_total']));
    }
    
    /**
     * 
     */
    public function actionAddtowishlist() {

        $ip = Yii::app()->request->getUserHostAddress();
        $wishlist_model = new WishList();
        if (isset(Yii::app()->user->id)) {
            $wishlist = $wishlist_model->find('product_profile_id=' . $_REQUEST['product_profile_id'] . ' AND (user_id=' . Yii::app()->user->id . ' OR session_id="' . $ip . '")');
            $ip = '';
        } else {
            $wishlist = $wishlist_model->find('product_profile_id=' . $_REQUEST['product_profile_id'] . ' AND session_id="' . $ip . '"');
        }
        if ($wishlist == null) {
            $wishlist_model = new WishList();
            $wishlist_model->product_profile_id = $_REQUEST['product_profile_id'];
            $wishlist_model->user_id = Yii::app()->user->id;
            $wishlist_model->city_id = Yii::app()->session['city_id'];
            $wishlist_model->added_date = date(Yii::app()->params['dateformat']);
            $wishlist_model->session_id = $ip;
            $wishlist_model->save();
        }


        $tot_wishlists = WishList::model()->getWishListCount();
        echo CJSON::encode(array('product_profile_id' => $_REQUEST['product_profile_id'], 'wishlist_counter' => $tot_wishlists['total_pro']));
    }

}

?>
