<?php

/**
 * @author Ali Abbas
 * @abstract use for 
 *  setting new  module
 *  
 */
$modules = array(
    // uncomment the following to enable the Gii tool
    // uncomment the following to enable the Gii tool

    'web',
    'blog',
    'backup',
    'gii' => array(
        'class' => 'system.gii.GiiModule',
        'password' => '123',
        // If removed, Gii defaults to localhost only. Edit carefully to taste.
        'ipFilters' => array('127.0.0.1', '::1'),
    ),
    'rights' => array(
        'superuserName' => 'SuperAdmin', // Name of the role with super user privileges.
        'cityAdmin' => 'CityAdmin',
        'authenticatedName' => 'Authenticated', // Name of the authenticated user role.
        'userIdColumn' => 'user_id', // Name of the user id column in the database.
        'userNameColumn' => 'user_name', // Name of the user name column in the database.
        'enableBizRule' => false, // Whether to enable authorization item business rules.
        'enableBizRuleData' => false, // Whether to enable data for business rules.
        'displayDescription' => true, // Whether to use item description instead of name.
        'flashSuccessKey' => 'RightsSuccess', // Key to use for setting success flash messages.
        'flashErrorKey' => 'RightsError', // Key to use for setting error flash messages.
        'install' => false, // Whether to install rights.
        'baseUrl' => '/rights', // Base URL for Rights. Change if module is nested.
        'layout' => 'rights.views.layouts.main', // Layout to use for displaying Rights.
        'appLayout' => 'webroot.themes.admin.views.layouts.main', // Application layout.
        /**
         * it means super admin can only access these controllers
         */
        'superAllowedactions' => array(
            'User.*', 'Country.*',
            'City.*', 'SelfSite.*',
            'Backup.*',
            'Configurations.Load',
            'Configurations.General',
            'Configurations.DeleteGeneral',
            'Configurations.DeleteOther',
            'Language.*', 'DtMessages.*',
            'User.View', 'Country.View',
            'City.View', 'SelfSite.View',
            'City.Update', 'Country.Update',
            'Language.View',
            'City.ToggleEnabled',
            'Country.ToggleEnabled',
            'User.Index', 'Country.Index',
            'City.Index', 'SelfSite.Index',
            'Language.Index',
            'User.Create', 'Country.Create',
            'City.Create', 'SelfSite.Create',
            'Language.Create',
            //backup module
            'Backup.Default.Index',
            'Backup.Default.BackUpSql',
            'Backup.Default.BackUpImage',
            'Backup.Default.AllBackup',
            'Backup.Default.DownloadBackUpSql',
            'Backup.Default.DownloadImageBackup',
            /**
             * adding author
             */
            'Author.Index',
            'Author.Create',
            'Author.Update',
            'Author.View',
            'Author.Delete',
            //Import module
            'Import.Index',
            'Import.MappingList',
            'Import.Status',
            'Import.Insert',
            //Notifcation
            'Notifcation.Index',
            'Notifcation.Create',
            'Notifcation.Copy',
            'Notifcation.View',
            'Notifcation.CreateFolder',
            'Notifcation.MoveTo',
            'Notifcation.MarkStatus',
            'Notifcation.MarkDeleted',
            'Notifcation.DeletedItems',
            'Notifcation.Delete',
            'Notifcation.ManageFolders',
            'Notifcation.DeleteFolder',
            'Notifcation.GetTotalNotifications',
            //Product Template
            'ProductTemplate.Index',
            'ProductTemplate.Create',
            'ProductTemplate.Update',
            'ProductTemplate.View',
            'ProductTemplate.Delete',
            'ProductTemplate.LoadChildByAjax',
            'ProductTemplate.EditChild',
            'ProductTemplate.DeleteChildByAjax',
            'ProductTemplate.ViewImage',
            'ProductTemplate.ViewProduct',
            'ProductTemplate.MakeAvailable',
            //Product Module
            'Product.Index',
            'Product.Create',
            'Product.Update',
            'Product.View',
            'Product.Delete',
            'Product.LoadChildByAjax',
            'Product.EditChild',
            'Product.DeleteChildByAjax',
            'Product.Slider',
            'Product.CreateSlider',
            'Product.RemoveSlider',
            'Product.SliderSetting',
            'Product.ViewImage',
            'Product.ToggleEnabled',
            'Product.Language',
            'Product.LanguageDelete',
            'Product.ProfileLanguage',
            'Product.ProfileLanguageDelete',
            'Product.ExportProduct',
            'Product.CreateFromTemplate',
            //Category Module
            'Categories.Index',
            'Categories.Create',
            'Categories.Update',
            'Categories.View',
            'Categories.Delete',
            'Categories.LoadChildByAjax',
            'Categories.EditChild',
            'Categories.UpdateOrder',
            'Categories.IndexParent',
            'Categories.UpdateParent',
            'Categories.CreateParent',
            
             //Translator Module
            'TranslatorCompiler.Index',
            'TranslatorCompiler.Create',
            'TranslatorCompiler.Update',
            'TranslatorCompiler.View',
            'TranslatorCompiler.Delete',
             //Zone Module
            'Zone.Index',
            'Zone.Create',
            'Zone.Update',
            'Zone.View',
            'Zone.Delete',
            'Zone.UploadRates',
            //Customer Module
            'Customer.Index',
            'Customer.Create',
            'Customer.Update',
            'Customer.View',
            'Customer.Delete',
            'Customer.OrderDetail',
            'Customer.OrdersList',
            
            //Log
            'Log.Index',
            'Log.View',
            'Log.Robote',
            'Log.HtAccess',
            
            //Dashboard
            'DashBoard.*',
            'DashBoard.Index'

        ),
        'debug' => false, // Whether to enable debug mode.
    ),
);


$conf_component_authManager = array(
    'class' => 'RDbAuthManager', // Provides support authorization item sorting. ...... 
);
?>
