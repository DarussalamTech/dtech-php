<?php

/*
 * setting url for web module
 * to beautify url in user's site
 * author:ubd
 */
$rules_web = array(
    '' => '/site/index',
    /** Product detail * */
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>' => '/site/storehome',
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>' => '/site/storeHome',
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/facebookpage' => '/web/default/getFacebookFeeds',
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/fillFeaturedBox' => '/site/fillFeaturedBox',
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/contact' => '/site/contact',
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/user/forgot' => '/web/user/forgot',
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/featuredProducts' => '/web/product/featuredProducts',
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/educationToys' => '/web/educationToys/index',
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/quran' => '/web/quran/index',
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/others' => '/web/others/index',
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/bestSellings' => '/web/product/bestSellings',
    
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/wuser/activateUser' => '/web/user/activate',
    /**
     * modify urls
     */
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/<pcategory:[\w-\.]+>/<slug:[\w-\.]+>/detail' => '/web/product/productDetail',
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/<slug:[\w-\.]+>/toyDetail' => '/web/educationToys/productDetail',
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/<slug:[\w-\.]+>/otherDetail' => '/web/others/productDetail',
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/<slug:[\w-\.]+>/quranDetail' => '/web/quran/productDetail',
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/<product_id:[\w-\.]+>/bookPrev' => '/web/product/productPreview',
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/<product_id:[\w-\.]+>/toyPrev' => '/web/educationToys/productPreview',
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/<product_id:[\w-\.]+>/otherPrev' => '/web/others/productPreview',
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/<product_id:[\w-\.]+>/quranPrev' => '/web/quran/productPreview',
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/pagesPreview/<id:[\w-\.]+>' => '/web/page/pagesPreview',
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/bookDetailLang/<id:[\w-\.]+>' => '/web/product/productDetailLang',
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/quranDetailLang/<id:[\w-\.]+>' => '/web/quran/productDetailLang',
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/<Product_page:[\w-\.]+>/allProducts/' => '/web/product/allproducts',
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/<category:[\w-\.]+>/books/' => '/web/product/allproducts/',
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/books' => '/web/product/allproducts',
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/<Product_page:[\w-\.]+>/educationToys' => '/web/educationToys/index',
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/<Product_page:[\w-\.]+>/quran' => '/web/quran/index',
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/<Product_page:[\w-\.]+>/others' => '/web/others/index',
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/<category:[\w-\.]+>/educationToys' => '/web/educationToys/index',
    /**
     * urls new modifications
     */
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/category/<slug:[\w-\.]+>' => '/web/product/category',
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/<category:[\w-\.]+>/quran' => '/web/quran/index',
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/<Product_page:[\w-\.]+>/others' => '/web/others/index',
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/viewCart' => '/web/cart/viewcart',
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/cart/addtocart' => '/cart/addtocart',
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/cart/addtowishlist' => '/cart/addtowishlist',
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/cart/loadCart' => '/web/cart/loadCart',
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/cart/editcart' => '/web/cart/editcart',
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/deleteCart' => '/web/cart/deleteCart',
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/paymentmethod' => '/web/payment/paymentmethod',
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/calculateShipping' => '/web/payment/calculateShipping',
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/placeOrder' => '/web/payment/placeOrder',
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/emailTest' => '/web/payment/emailTest',
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/productquantity/emailtous' => '/cart/emailtous',
    
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/mailertest' => '/web/payment/mailer2',
    // '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/paymentmethod/' => '/web/payment/paymentmethod',
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/customerHistory' => '/web/user/customerHistory',
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/<id:[\w-\.]+>/customerDetail' => '/web/user/customerDetail',
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/<id:[\w-\.]+>/print' => '/web/user/print',
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/productfilter' => '/web/product/productfilter',
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/wishlist' => '/web/wishList/viewwishlist',
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/register' => '/web/user/register',
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/userProfile/' => '/web/userProfile/index',
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/socialLogin/<provider:[\w-\.]+>' => '/web/hybrid/login',
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/socialRegister/<provider:[\w-\.]+>' => '/web/hybrid/registerSocial',
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/payment/confirmOrder/' => '/web/payment/confirmOrder',
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/emailToAdmin/' => '/web/cart/emailtoAdmin',
    /**
     * Blog links
     */
    //'<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/blogtest/' =>'/blog/default/index',
    //'<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/blogindex/' =>'/blog/wp/index',

    /** Product detail * */
    /**
     * paypall
     */
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/paypalconfirm' => '/web/paypal/confirm',
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/paypalcancel' => '/web/paypal/cancel',
    /** Search * */
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/dosearch' => '/web/search/dosearch',
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/getSearch' => '/web/search/getSearch',
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/searchDetail' => '/web/search/searchDetail',
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/viewPage/<id:[\w-\.]+>' => '/web/page/viewPage',


    /** other urls * */
    '<lang:[\w-\.]+>/<controller:\w+>/<id:\d+>' => '<controller>/view',
    '<lang:[\w-\.]+>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
    '<lang:[\w-\.]+>/<controller:\w+>/<action:\w+>' => '<controller>/<action>',
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/changePass' => '/web/user/changePass',
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/setNewPass' => '/web/user/setNewPass',
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/login' => '/web/site/login',
    '<lang:[\w-\.]+>/<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/logout' => '/site/logout',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/login' => '/site/login',
);
?>
