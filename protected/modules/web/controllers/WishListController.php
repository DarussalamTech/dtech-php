<?php

/**
 * 
 */
class WishListController extends Controller {

    /**
     * For viewing the list of product which add into wishlist
     */
    public function actionViewwishlist() {
        Yii::app()->user->SiteSessions;
        $wishlist = WishList::model()->getWishLists();
       
        $this->render('//wishList/viewwishlist', array('wishList' => $wishlist));
    }

    /**
     * For Edit or delete the wishlist product
     */
    public function actionEditwishlist() {

        if ($_REQUEST['type'] == 'delete_wishlist') {
            $wishlist_model = new WishList();
            $wishlist_model->findByPk($_REQUEST['id'])->delete();
            /**
             * get wish list again
             */
            $wishlist = WishList::model()->getWishLists();
            $wish_list_count = WishList::model()->getWishListCount();
            $_view_list = $this->renderPartial("//wishList/_view_wish_lists", array('wishList' => $wishlist), true, true);
            echo CJSON::encode(array("_view_list" => $_view_list, "wish_list_count" => $wish_list_count['total_pro']));
        }
    }

}

?>
