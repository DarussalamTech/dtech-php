<?php

/**
 * @author Ali Abbas
 * @abstract use for 
 *  setting import class
 *  
 */
$url_manager = array(
    'urlFormat' => 'path',
    'showScriptName' => true,
    'rules' => array(
        '' => '/site/index',
        /** Product detail * */
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>' => '/site/storehome',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>' => '/site/storeHome',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/fillFeaturedBox' => '/site/fillFeaturedBox',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/contact' => '/site/contact',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/user/forgot' => '/web/user/forgot',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/featuredProducts' => '/web/product/featuredProducts',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/educationToys' => '/web/educationToys/index',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/quran' => '/web/quran/index',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/others' => '/web/others/index',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/bestSellings' => '/web/product/bestSellings',
        /**
         * modify urls
         */
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/<pcategory:[\w-\.]+>/<slug:[\w-\.]+>/detail' => '/web/product/productDetail',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/<slug:[\w-\.]+>/toyDetail' => '/web/educationToys/productDetail',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/<slug:[\w-\.]+>/otherDetail' => '/web/others/productDetail',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/<slug:[\w-\.]+>/quranDetail' => '/web/quran/productDetail',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/<product_id:[\w-\.]+>/bookPrev' => '/web/product/productPreview',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/<product_id:[\w-\.]+>/toyPrev' => '/web/educationToys/productPreview',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/<product_id:[\w-\.]+>/otherPrev' => '/web/others/productPreview',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/<product_id:[\w-\.]+>/quranPrev' => '/web/quran/productPreview',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/pagesPreview/<id:[\w-\.]+>' => '/web/page/pagesPreview',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/bookDetailLang/<id:[\w-\.]+>' => '/web/product/productDetailLang',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/quranDetailLang/<id:[\w-\.]+>' => '/web/quran/productDetailLang',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/<Product_page:[\w-\.]+>/allProducts/' => '/web/product/allproducts',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/<category:[\w-\.]+>/books/' => '/web/product/allproducts/',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/books' => '/web/product/allproducts',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/<Product_page:[\w-\.]+>/educationToys' => '/web/educationToys/index',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/<Product_page:[\w-\.]+>/quran' => '/web/quran/index',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/<Product_page:[\w-\.]+>/others' => '/web/others/index',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/<category:[\w-\.]+>/educationToys' => '/web/educationToys/index',
        /**
         * urls new modifications
         */
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/category/<slug:[\w-\.]+>' => '/web/product/category',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/<category:[\w-\.]+>/quran' => '/web/quran/index',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/<Product_page:[\w-\.]+>/others' => '/web/others/index',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/viewCart' => '/web/cart/viewcart',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/deleteCart' => '/web/cart/deleteCart',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/paymentmethod' => '/web/payment/paymentmethod',
       // '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/paymentmethod/' => '/web/payment/paymentmethod',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/customerHistory' => '/web/user/customerHistory',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/productfilter' => '/web/product/productfilter',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/wishlist' => '/web/wishList/viewwishlist',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/user/register' => '/web/user/register',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/userProfile/' => '/web/userProfile/index',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/socialLogin/<provider:[\w-\.]+>' => '/web/hybrid/login',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/socialRegister/<provider:[\w-\.]+>' => '/web/hybrid/registerSocial',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/payment/confirmOrder/' => '/web/payment/confirmOrder',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/emailToAdmin/' => '/web/cart/emailtoAdmin',
        /**
         * Blog links
         */
        //'<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/blogtest/' =>'/blog/default/index',
        //'<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/blogindex/' =>'/blog/wp/index',

        /** Product detail * */
        /**
         * paypall
         */
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/paypalconfirm' => '/web/paypal/confirm',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/paypalcancel' => '/web/paypal/cancel',
        /** Search * */
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/dosearch' => '/web/search/dosearch',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/getSearch' => '/web/search/getSearch',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/searchDetail' => '/web/search/searchDetail',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/viewPage/<id:[\w-\.]+>' => '/web/page/viewPage',
        /** admin configurations url ** */
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/conf/load/' => '/configurations/load',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/conf/general/' => '/configurations/general',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/conf/load/' => '/configurations/load',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/conf/deleteG/' => '/configurations/deleteGeneral',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/conf/deleteO/' => '/configurations/deleteOther',
        //'<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/<type:[\w-\.]+>/conf/load/' => '/configurations/load',
        //'<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/conf/load/' => '/configurations/load',

        /** admin url ** */
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/dtMessages/index' => '/dtMessages/index',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/user/index' => '/user/index',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/userRole/index' => '/userRole/index',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/country/index' => '/country/index',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/city/index' => '/city/index',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/language/index' => '/language/index',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/selfSite/index' => '/selfSite/index',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/product/index' => '/product/index',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/categories/index' => '/categories/index',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/categories/indexParent' => '/categories/indexParent',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/author/index' => '/author/index',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/pages/index' => '/pages/index',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/translatorCompiler/index' => '/translatorCompiler/index',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/pages/index' => '/pages/index',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/order/index' => '/order/index',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/order/updateuseraddress' => '/order/updateuseraddress',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/order/orderProductQuantity' => '/order/orderProductQuantity',
        /** admin url ** */
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/dtMessages/create' => '/dtMessages/create',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/user/create' => '/user/create',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/user/toggleEnabled/<id:[\w-\.]+>' => '/user/toggleEnabled',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/userRole/create' => '/userRole/create',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/country/create' => '/country/create',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/city/create' => '/city/create',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/language/create' => '/language/create',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/selfSite/create' => '/selfSite/create',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/product/create' => '/product/create',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/categories/create' => '/categories/create',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/categories/createParent' => '/categories/createParent',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/author/create' => '/author/create',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/pages/create' => '/pages/create',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/translatorCompiler/create' => '/translatorCompiler/create',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/pages/create' => '/pages/create',
        /** update * */
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/dtMessages/update/<id:[\w-\.]+>' => '/dtMessages/update',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/user/update/<id:[\w-\.]+>' => '/user/update',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/userRole/update/<id:[\w-\.]+>' => '/userRole/update',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/country/update/<id:[\w-\.]+>' => '/country/update',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/city/update/<id:[\w-\.]+>' => '/city/update',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/language/update/<id:[\w-\.]+>' => '/language/update',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/layout/update/<id:[\w-\.]+>' => '/layout/update',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/selfSite/update/<id:[\w-\.]+>' => '/selfSite/update',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/product/update/<id:[\w-\.]+>' => '/product/update',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/<id:[\w-\.]+>/product/removeSlider' => '/product/removeSlider',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/product/slider' => '/product/slider',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/product/sliderSetting' => '/product/sliderSetting',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/product/createSlider' => '/product/createSlider',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/categories/updateParent/<id:[\w-\.]+>' => '/categories/updateParent',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/categories/update/<id:[\w-\.]+>' => '/categories/update',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/author/update/<id:[\w-\.]+>' => '/author/update',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/page/update/<id:[\w-\.]+>' => '/pages/update',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/translatorCompiler/update/<id:[\w-\.]+>' => '/translatorCompiler/update',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/customer/update/<id:[\w-\.]+>' => '/customer/update',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/order/update/<id:[\w-\.]+>' => '/order/update',
        /** view admin * */
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/dtMessages/view/<id:[\w-\.]+>' => '/dtMessages/view',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/user/view/<id:[\w-\.]+>' => '/user/view',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/userRole/view/<id:[\w-\.]+>' => '/userRole/view',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/country/view/<id:[\w-\.]+>' => '/country/view',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/city/view/<id:[\w-\.]+>' => '/city/view',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/language/view/<id:[\w-\.]+>' => '/language/view',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/selfSite/view/<id:[\w-\.]+>' => '/selfSite/view',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/product/view/<id:[\w-\.]+>' => '/product/view',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/categories/view/<id:[\w-\.]+>' => '/categories/view',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/author/view/<id:[\w-\.]+>' => '/author/view',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/pages/view/<id:[\w-\.]+>' => '/pages/view',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/translatorCompiler/view/<id:[\w-\.]+>' => '/translatorCompiler/view',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/pages/view/<id:[\w-\.]+>' => '/pages/view',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/order/view/<id:[\w-\.]+>' => '/order/view',
        /** delete * */
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/categories/delete/<id:[\w-\.]+>' => '/categories/delete',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/order/delete/<id:[\w-\.]+>' => '/order/delete',
        /** New admin urls * */
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/product/loadChildByAjax' => '/product/loadChildByAjax',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/product/editChild/<id:[\w-\.]+>' => '/product/editChild',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/product/language/<id:[\w-\.]+>' => '/product/language',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/product/languageDelete/<id:[\w-\.]+>' => '/product/languageDelete',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/product/profileLanguage/<id:[\w-\.]+>' => '/product/profileLanguage',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/product/profileLanguageDelete/<id:[\w-\.]+>' => '/product/profileLanguageDelete',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/categories/loadChildByAjax' => '/categories/loadChildByAjax',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/categories/editChild/<id:[\w-\.]+>' => '/categories/editChild',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/product/viewProfile/<id:[\w-\.]+>' => '/product/viewImage',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/product/deleteChildByAjax/<id:[\w-\.]+>' => '/product/deleteChildByAjax',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/customer/ordersList/<id:[\w-\.]+>' => '/customer/ordersList',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/customer/orderDetail/<id:[\w-\.]+>' => '/customer/orderDetail',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/order/orderDetail/<id:[\w-\.]+>' => '/order/orderDetail',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/dtMessages/loadChildByAjax' => '/dtMessages/loadChildByAjax',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/dtMessages/editChild/<id:[\w-\.]+>' => '/dtMessages/editChild',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/dtMessages/deleteChildByAjax/<id:[\w-\.]+>' => '/dtMessages/deleteChildByAjax',
        /** other urls * */
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/login' => '/web/site/login',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/login' => '/site/login',
        '<controller:\w+>/<id:\d+>' => '<controller>/view',
        '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
        '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/changePass' => '/web/user/changePass',
        /**
         * rights module
         */
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/rights' => '/rights',
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/rights/assignment/view' => '/rights/assignment/view',
        
        '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/menus/installMenu' => '/menus/installMenu',
    ),
);
//$url_manager = array();
?>
