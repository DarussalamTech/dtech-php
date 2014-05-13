<?php

/*
 * setting url for admin site
 * to beautify url in admin site
 * author:ubd
 */
$rules_admin = array(
    /** admin url ** */
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/dtMessages/index' => '/dtMessages/index',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/dtMessages/generate' => '/dtMessages/generate',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/user/index' => '/user/index',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/shippingClass/index' => '/shippingClass/index',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/shippingClass' => '/shippingClass/index',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/user/sendInvitation' => '/user/sendInvitation',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/user/sendEmailinvitation' => '/user/sendEmailinvitation',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/userRole/index' => '/userRole/index',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/country/index' => '/country/index',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/city/index' => '/city/index',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/language/index' => '/language/index',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/selfSite/index' => '/selfSite/index',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/product/index' => '/product/index',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/product-template/index' => '/productTemplate/index',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/product-template' => '/productTemplate/index',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/<id:[\w-\.]+>/product-template/make-available' => '/productTemplate/makeAvailable',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/layout/index' => '/layout/index',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/layout/view//<id:[\w-\.]+>' => '/layout/view',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/categories/index' => '/categories/index',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/categories/indexParent' => '/categories/indexParent',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/author/index' => '/author/index',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/pages/index' => '/pages/index',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/categories/updateOrder' => '/categories/updateOrder',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/author/updateOrder' => '/author/updateOrder',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/translatorCompiler/index' => '/translatorCompiler/index',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/pages/index' => '/pages/index',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/order/index' => '/order/index',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/customer/index' => '/customer/index',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/order/print' => '/order/print',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/order/updateuseraddress' => '/order/updateuseraddress',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/order/orderProductQuantity' => '/order/orderProductQuantity',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/<id:[\w-\.]+>/order/revertlineItem' => '/order/revertlineItem',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/<id:[\w-\.]+>/order/hisotryLineItem' => '/order/hisotryLineItem',
    /** admin url ** */
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/dtMessages/create' => '/dtMessages/create',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/shippingClass/create' => '/shippingClass/create',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/user/create' => '/user/create',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/user/changePassword' => '/user/changePassword',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/customer/create' => '/customer/create',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/user/toggleEnabled/<id:[\w-\.]+>' => '/user/toggleEnabled',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/country/toggleEnabled/<id:[\w-\.]+>' => '/country/toggleEnabled',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/city/toggleEnabled/<id:[\w-\.]+>' => '/city/toggleEnabled',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/product/toggleEnabled/<id:[\w-\.]+>' => '/product/toggleEnabled',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/shippingClass/toggleEnabled/<id:[\w-\.]+>' => '/shippingClass/toggleEnabled',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/commonSystem/tinyUploadlayout' => '/commonSystem/tinyUploadlayout',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/commonSystem/tinyuploadtarget' => '/commonSystem/tinyuploadtarget',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/userRole/create' => '/userRole/create',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/country/create' => '/country/create',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/city/create' => '/city/create',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/language/create' => '/language/create',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/selfSite/create' => '/selfSite/create',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/product/create' => '/product/create',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/product/create-from-template/<id:[\w-\.]+>' => '/product/createFromTemplate',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/product-template/create' => '/productTemplate/create',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/categories/create' => '/categories/create',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/categories/createParent' => '/categories/createParent',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/author/create' => '/author/create',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/pages/create' => '/pages/create',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/translatorCompiler/create' => '/translatorCompiler/create',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/pages/create' => '/pages/create',
    /** update * */
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/dtMessages/update/<id:[\w-\.]+>' => '/dtMessages/update',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/shippingClass/update/<id:[\w-\.]+>' => '/shippingClass/update',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/user/update/<id:[\w-\.]+>' => '/user/update',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/userRole/update/<id:[\w-\.]+>' => '/userRole/update',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/country/update/<id:[\w-\.]+>' => '/country/update',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/city/update/<id:[\w-\.]+>' => '/city/update',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/language/update/<id:[\w-\.]+>' => '/language/update',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/layout/update/<id:[\w-\.]+>' => '/layout/update',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/selfSite/update/<id:[\w-\.]+>' => '/selfSite/update',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/product-template/update/<id:[\w-\.]+>' => '/productTemplate/update',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/product/update/<id:[\w-\.]+>' => '/product/update',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/product/exportProduct/<category:[\w-\.]+>' => '/product/exportProduct',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/<id:[\w-\.]+>/product/removeSlider' => '/product/removeSlider',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/product/slider' => '/product/slider',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/product/exportProduct' => '/product/exportProduct',
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
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/shippingClass/view/<id:[\w-\.]+>' => '/shippingClass/view',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/user/view/<id:[\w-\.]+>' => '/user/view',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/userRole/view/<id:[\w-\.]+>' => '/userRole/view',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/country/view/<id:[\w-\.]+>' => '/country/view',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/city/view/<id:[\w-\.]+>' => '/city/view',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/language/view/<id:[\w-\.]+>' => '/language/view',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/selfSite/view/<id:[\w-\.]+>' => '/selfSite/view',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/product-template/view-product/<id:[\w-\.]+>/<template:[\w-\.]+>' => '/productTemplate/viewProduct',
     '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/product-template/view/<id:[\w-\.]+>' => '/productTemplate/view',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/product/view/<id:[\w-\.]+>' => '/product/view',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/categories/view/<id:[\w-\.]+>' => '/categories/view',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/author/view/<id:[\w-\.]+>' => '/author/view',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/pages/view/<id:[\w-\.]+>' => '/pages/view',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/translatorCompiler/view/<id:[\w-\.]+>' => '/translatorCompiler/view',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/pages/view/<id:[\w-\.]+>' => '/pages/view',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/order/view/<id:[\w-\.]+>' => '/order/view',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/customer/view/<id:[\w-\.]+>' => '/customer/view',
    /** delete * */
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/product-template/delete/<id:[\w-\.]+>' => '/productTemplate/delete',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/shippingClass/delete/<id:[\w-\.]+>' => '/shippingClass/delete',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/categories/delete/<id:[\w-\.]+>' => '/categories/delete',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/order/delete/<id:[\w-\.]+>' => '/order/delete',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/customer/delete/<id:[\w-\.]+>' => '/customer/delete',
    
    /** New admin urls * */
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/product/loadChildByAjax' => '/product/loadChildByAjax',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/product/editChild/<id:[\w-\.]+>' => '/product/editChild',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/product-template/loadChildByAjax' => '/productTemplate/loadChildByAjax',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/product-template/editChild/<id:[\w-\.]+>' => '/productTemplate/editChild',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/product/language/<id:[\w-\.]+>' => '/product/language',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/product/languageDelete/<id:[\w-\.]+>' => '/product/languageDelete',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/product/profileLanguage/<id:[\w-\.]+>' => '/product/profileLanguage',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/product/profileLanguageDelete/<id:[\w-\.]+>' => '/product/profileLanguageDelete',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/categories/loadChildByAjax' => '/categories/loadChildByAjax',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/categories/editChild/<id:[\w-\.]+>' => '/categories/editChild',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/product/indexviewProfile/<id:[\w-\.]+>' => '/product/viewImage',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/product-template/indexviewProfile/<id:[\w-\.]+>' => '/productTemplate/viewImage',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/product/deleteChildByAjax/<id:[\w-\.]+>' => '/product/deleteChildByAjax',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/product-template/deleteChildByAjax/<id:[\w-\.]+>' => '/productTemplate/deleteChildByAjax',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/customer/ordersList/<id:[\w-\.]+>' => '/customer/ordersList',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/customer/orderDetail/<id:[\w-\.]+>' => '/customer/orderDetail',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/order/orderDetail/<id:[\w-\.]+>' => '/order/orderDetail',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/dtMessages/loadChildByAjax' => '/dtMessages/loadChildByAjax',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/dtMessages/editChild/<id:[\w-\.]+>' => '/dtMessages/editChild',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/dtMessages/deleteChildByAjax/<id:[\w-\.]+>' => '/dtMessages/deleteChildByAjax',
    /**
     * backup module
     */
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/backup' => '/backup',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/backup/default/index' => '/backup/default/index',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/backup/default/backUpSql' => '/backup/default/backUpSql',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/backup/default/backUpImage' => '/backup/default/backUpImage',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/backup/default/allBackup' => '/backup/default/allBackup',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/backup/default/downloadBackUpSql' => '/backup/default/downloadBackUpSql',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/backup/default/downloadImageBackup' => '/backup/default/downloadImageBackup',
    /**
     * rights module
     */
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/rights' => '/rights',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/rights/authItem/permissions' => '/rights/authItem/permissions',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/rights/authItem/roles' => '/rights/authItem/roles/',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/rights/assignment/user' => '/rights/assignment/user',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/rights/authItem/update' => '/rights/authItem/update',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/rights/assignment/view' => '/rights/assignment/view',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/menus/installMenu' => '/menus/installMenu',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/menus/rebuildAssets' => '/menus/rebuildAssets',
    /**
     * configuration
     */
    /** admin configurations url ** */
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/conf/load/' => '/configurations/load',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/conf/general/' => '/configurations/general',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/conf/load/' => '/configurations/load',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/conf/deleteG/' => '/configurations/deleteGeneral',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/conf/deleteO/' => '/configurations/deleteOther',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/<type:[\w-\.]+>/conf/load/' => '/configurations/load',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/conf/load/' => '/configurations/load',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/conf/delete/' => '/configurations/delete',
    /** Import module * */
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/import' => '/import',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/import/mappingList' => '/import/mappingList',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/import/insert' => '/import/insert',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/import/getCityCategories' => '/import/getCityCategories',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/import/status/<id:[\w-\.]+>' => '/import/status',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/import/index' => '/import/index',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/<step:[\w-\.]+>/<id:[\w-\.]+>/import/index' => '/import/index',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/<step:[\w-\.]+>/import/index' => '/import/index',
    
    /** internation Shipping module * */
    
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/zone/create' => '/zone/create',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/zone/index' => '/zone/index',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/<id:[\w-\.]+>/zone/update' => '/zone/update',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/<id:[\w-\.]+>/zone/view' => '/zone/view',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/<id:[\w-\.]+>/zone/delete' => '/zone/delete',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/zone/uploadRates' => '/zone/uploadRates',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/zone/loadChildByAjax' => '/zone/loadChildByAjax',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/zone/editChild/<id:[\w-\.]+>' => '/zone/editChild',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/zone/deleteChildByAjax/<id:[\w-\.]+>' => '/zone/deleteChildByAjax',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/zone/viewHistory/<id:[\w-\.]+>' => '/zone/viewHistory',
    
    //notifications
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/notification/create' => '/notifcation/create',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/notification/' => '/notifcation/index',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/notification/create-folder' => '/notifcation/createFolder',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/notification/list' => '/notifcation/index',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/<id:[\w-\.]+>/notification/sendcopy' => '/notifcation/copy',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/<id:[\w-\.]+>/notification/view' => '/notifcation/view',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/notification/move-to' => '/notifcation/moveTo',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/notification/mark-<status:[\w-\.]+>' => '/notifcation/markStatus',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/notification/mark-deleted' => '/notifcation/markDeleted',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/notification/deleted-items' => '/notifcation/deletedItems',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/notification/delete' => '/notifcation/delete',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/notification/manage-folders' => '/notifcation/manageFolders',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/<id:[\w-\.]+>/notification/deleteFolder' => '/notifcation/deleteFolder',
    '<country:[\w-\.]+>/<city:[\w-\.]+>/<city_id:[\w-\.]+>/notification/get-total-notifications' => '/notifcation/getTotalNotifications',
    
  );
?>
