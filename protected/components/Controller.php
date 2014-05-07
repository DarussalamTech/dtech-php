<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends RController {

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * Register script/css files
     * @var array
     */
    public $cs, $scriptMap = array();

    /**
     * to verify current page is admin or not
     * @var type 
     */
    public $isAdminSite = false;

    /**
     * Menu categories
     * for web pages
     * purspose to make one time
     * ans used multiple times
     * @var type 
     */
    public $menu_categories;
    //PCM Will handle languages by session

    public $currentLang = "en";

    /**
     *
     * @var type 
     */
    public $definedLangActions = array(
        "productDetail",
        "productDetailLang",
    );

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();

    /**
     * base path will be saved here
     * @var type 
     */
    public $basePath = "";

    /**
     *  menu html for code
     * @var type 
     */
    public $menuHtml = "";

    /**
     * PCM Widget array
     * @var type 
     */
    public $PcmWidget;

    /**
     * to get the themes 
     * inside
     * @var type 
     */
    public $slash = "/";

    /**
     *
     * @var type 
     */
    public $webPcmWidget;

    /**
     *
     * @var type 
     * web pages like dynamic pages
     * footer , shipping, contact,about us
     */
    public $webPages = array();

    public function beforeAction($action) {
        /**
         * Now allowed urls 
         * for to reduce errors
         * from google bot
         */
        if (strstr($_SERVER['QUERY_STRING'], Yii::app()->params['notAllowedRequestUri'])) {
            $this->redirect(Yii::app()->homeUrl);
        }
        //Not allowed urls

        if (!empty($_REQUEST['option']) && strstr($_REQUEST['option'], 'com_')) {

            $this->redirect(Yii::app()->homeUrl);
        }


        parent::beforeAction($action);
        $this->setPages();
        $this->installConfig();
        $this->registerWidget();
        $this->basePath = Yii::app()->basePath;
        if (strstr($this->basePath, "protected")) {
            $this->basePath = realPath($this->basePath . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR);
        }

        /**
         * storing php session in yii session
         * when no user is login
         */
        if (empty(Yii::app()->user->id)) {
            Yii::app()->session['cart_session'] = session_id();
        }

        $this->isChangeAdminCity();

        /**
         * Check if script is already loaded then not reload it.
         * This is used in case of ajax calls.
         */
        Yii::app()->clientScript->scriptMap = array(
            (YII_DEBUG ? 'jquery.js' : 'jquery.min.js') => false,
                //'jquery-ui.min.js' => false,
                //'jquery-ui.css' => false
        );
    
//        die;
        return true;
    }

    /* PCM: For Mohsin: Remove this code from here and manage it in a seprate compononet. */

    /**
     * property array, Holds all contorllers array
     * @var type 
     * 
     */
    public $controllers;

    /**
     * property array holds Operation's Permission
     * @var type 
     * 
     */
    public $OpPermission = array();

    /**
     * Set controller array
     * 
     */
    public function setControllers() {
        $this->controllers = array(
            "Author" => "View",
            'Site' => 'Index',
            'UserRole' => 'View',
            "Categories" => "View",
            "City" => "View",
            "Configurations" => "View",
            "Country" => "View",
            "Layout" => "View",
            "Customer" => "View",
            "Language" => "View",
            "Menus" => "View",
            "Order" => "View",
            "Pages" => "View",
            "Product" => "View",
            "SelfSite" => "View",
            "TranslatorCompiler" => "View",
            "User" => "View",
            "Import" => "Status",
            "ShippingClass" => "View",
            "Zone" => "View",
            "Notifcation" => "View",
            "ProductTemplate" => "View",
                //"Assignment" => "View",
        );
    }

    /**
     * Set Permissions 
     * For menu and for individual child controller i.e. Project, Contact etc..
     * 
     * @param string $controller
     * @param array $operations
     * @return type 
     */
    public function setPermissions($controller = "", $operations = array()) {
        /**
         * In case of ajax call we don't need to send all queries to db and update
         * OpPermission array.
         */
//        if (Yii::app()->request->isAjaxRequest)
//            return false;

        /* If call comes from this controller's before action */
        if (empty($controller)) {
            $this->setMinPermissions();
        }
        /* If call comes from child controller's before action */ else {
            $this->setAllPermissions($controller, $operations);
        }
        return true;
    }

    /**
     * Set minimum permissions
     * And update OpPermissions Array
     */
    private function setMinPermissions() {
        $this->setControllers();
        $perm = array();
        foreach ($this->controllers as $controller => $minPer) {
            $operation = $controller . '.' . $minPer;

            $perm[$operation] = Yii::app()->user->checkAccess($operation);
        }

        $this->OpPermission = $perm;

        return true;
    }

    private function setAllPermissions($controller, $operations) {
        $perm = array();
        foreach ($operations as $operation) {
            $op = ucfirst($controller) . "." . ucfirst($operation);
            $perm[$op] = Yii::app()->user->checkAccess($op);
        }

        $this->OpPermission = $this->OpPermission + $perm;
    }

    /**
     * Get Permission
     * @param string $operation
     * @return boolean 
     */
    public function getPermission($operation) {
        return $this->OpPermission[ucfirst($operation)];
    }

    /**
     * Check view access
     * @param type $operation
     * @return type 
     */
    public function checkViewAccess($operation) {
        return Yii::app()->user->checkAccess($operation);
    }

    /**
     * to check if admin change his city 
     * which is not allowed with sessions
     */
    public function isChangeAdminCity() {

        if (!empty($this->controllers)) {
            $controllers = array_keys($this->controllers);


            if (in_array(ucfirst($this->id), $controllers) && Yii::app()->user->User->city_id != Yii::app()->request->getQuery('city_id')) {

                Yii::app()->user->logout();
                $this->redirect(Yii::app()->homeUrl);
            }
        }
    }

    /**
     *  set pages for system
     */
    public function setPages() {
        $module = $this->getModule();


        if ($this->id == "site" || get_class($module) == "WebModule") {
            $this->webPages = Pages::model()->getPages();
            /**
             * only in case of when city id is started
             */
            if (isset(Yii::app()->session['city_id']) || isset($_REQUEST['city_id'])) {
                $this->menu_categories = Categories::model()->getMenuCategories();
            }

            /**
             * if menu category not present then page will be redirected again
             */
            if (!isset($this->menu_categories)) {
                Yii::app()->user->SiteSessions;
                ;
            }
            $this->currentLang = isset(Yii::app()->session['current_lang']) ? Yii::app()->session['current_lang'] : "en";
            //$this->configureTheme();
        } else {
            /**
             * for admin site
             */
            $this->currentLang = "en";
            $this->isAdminSite = true;
            $this->setPermissions();
        }
    }

    /**
     * filtering the http and 
     * https for security purpose of 
     * the application:
     * extending from the Filter class residing
     * in proteted/DTHTtpsFilter :ubd
     * @param type $filterChain
     */
    public function filterHttps($filterChain) {
        $filter = new DTHttpsFilter;
        $filter->filter($filterChain);
    }

    /**
     * filtering the http url only for local and testing env.
     *  @param type $filterChain
     */
    public function filterHttp($filterChain) {
        $filter = new DTHttpFilter;
        $filter->filter($filterChain);
    }

    /**
     * configure Web site theme
     */
    public function configureTheme() {
        /**
         * PCM temprory
         */
        $theme = Yii::app()->db->createCommand()
                ->select('*')
                ->from("conf_misc")
                ->where("misc_type='general' AND param ='theme'")
                ->queryRow();

        Yii::app()->params['theme'] = $theme['value'];

        if (Yii::app()->params['theme'] == 'dtech_second') {
            Yii::app()->theme = Yii::app()->params['theme'];
            Yii::app()->controller->layout = "//layouts/column2";
            Yii::app()->session['layout'] = Yii::app()->params['theme'];
            $this->slash = "/";
        }
    }

    /**
     * register widget
     * e.g gridview 
     */
    public function registerWidget() {
        Yii::app()->widgetFactory->widgets = array(
            'ItstGridView' => array(
                'cssFile' => Yii::app()->baseURL . '/css/gridview.css',
                'template' => '{items}{summary}{pager}<div class="clear"></div>',
                'pager' => array('cssFile' => Yii::app()->baseURL . '/css/pager.css'),
                'emptyText' => "No Record Found",
                'showTableOnEmpty' => false,
        ));
    }

    /**
     * handle client script to see 
     * no script will be loaded again 
     */
    public function handleClientScript() {
        Yii::app()->clientScript->scriptMap = array(
            (YII_DEBUG ? 'jquery.js' : 'jquery.min.js') => false,
            'jquery-ui.min.js' => false,
            'jquery-ui.css' => false
        );
        /* Script Maping: Load necessary scripts in scriptMap array */
        $this->scriptMap = array(
            'jquery.js' => Yii::app()->request->baseUrl . '/packages/jui/js/jquery.js',
            'jquery-ui.min.js' => Yii::app()->request->baseUrl . '/packages/jui/js/jquery-ui.min.js',
            'jquery-ui.css' => Yii::app()->request->baseUrl . '/packages/jui/css/base/jquery-ui.css',
        );
        $this->cs = Yii::app()->clientScript;
    }

    /**
     * To Save multiple child records in view mode
     * @param Obj $model
     * @param String $child_relation_name
     * @param String $parent_relation_name
     * @param String $scanario
     * @param INT $redirect_to_parent_id 
     *  In-case to redirect to specific id, or saving some child's child data and have to show view of parent
     */
    public function manageChild($model, $child_relation_name, $parent_relation_name, $scanario = "", $redirect_id = 0, $redirect_path = "") {
        /* Get exact classs name */
        $activeRelation = $model->getActiveRelation($child_relation_name);
        $className = $activeRelation->className;


        /* if that child is posted */
        if (isset($_POST[$className])) {
            /* create child object of above class */

            $cModel = new $className($scanario);


            /*  */
            $repRes = $cModel->saveMultiple($parent_relation_name, $model->primaryKey);


            if ($repRes['result'] == false)
                $model->$child_relation_name = $repRes['models'];
            else {
                $id = ($redirect_id == 0 ? $model->primaryKey : $redirect_id);
                if (!empty($redirect_path)) {
                    $this->redirect($redirect_path);
                } else {
                    $this->redirect(array('view', 'id' => $id, '#' => $child_relation_name));
                }
            }
        }
    }

    /**
     *  used for 
     *  handling top menues
     *  in controller
     * @return int 
     */
    public function getRootParent() {
        $model = Menu::model()->findByAttributes(array("controller" => $this->id, "is_assigned" => "Yes"));
        if (count($model) == 1) {
            return $model->root_parent;
        } else {
            return 0;
        }
    }

    /**
     * get the navigation 
     * list for top menu
     * @param type $pid
     * @param type $level
     * @param type $root_parent
     * @param type $pidArray 
     * @param type $action
     *      based on action to view  
     */
    public function getNavigation($pid = 0, $level = 0, $root_parent = 0, $pidArray = array(), $action = false) {

        $model = Menu::model()->findAllByAttributes(array("pid" => $pid, "is_assigned" => "Yes"));
        $l = $level;

        if (count($model) > 0) {
            if ($pid == 0) {
                $this->menuHtml .= '<ul id="nav">';
                $l = 1;
            } else {
                $this->menuHtml .='<ul class="' . ($level == 1 ? 'sub' : '') . '">';
                $l = 2;
            }
            $foundAny = false;
            foreach ($model as $menu) {

                $operation = ($level == 0) ? $menu->min_permission : $menu->min_permission;


                $childCount = Menu::model()->count("pid = $menu->id");
                if (
                        $menu->min_permission == "" || ($menu->min_permission != "" && $this->checkViewAccess(ucfirst($menu->controller) . "." . ucfirst($operation)))
                ) {
                    $foundAny = true;

                    $this->menuHtml .='<li ' . ($pid == 0 ? "class='top'" : "") . '>';
                    $url = "#";
                    if ($menu->controller != "") {
                        $url = $this->createUrl("/" . $menu->controller . "/" . $menu->action);
                    }
                    $this->menuHtml .='<a href="' . $url . '" class="' . ($pid == 0 ? "top_link " . ($menu->id == $root_parent ? "active " : "") . $menu->root_class : ($childCount > 0 ? "fly" : "")) . '">';
                    if ($pid == 0)
                        $this->menuHtml .='<span class="down">';
                    $this->menuHtml .=$menu->user_title;
                    if ($pid == 0)
                        $this->menuHtml .='</span>';
                    $this->menuHtml .='</a>';

                    if (in_array($menu->id, $pidArray))
                        $this->getNavigation($menu->id, $l, 0, $pidArray, true);
                    $this->menuHtml .='</li>';
                }
            }
        }
        if ($foundAny == false)
            $this->menuHtml .='<span class="noItemFound"></span>';
        $this->menuHtml .='</ul>';
    }

    /**
     * general mesg for sending 
     * email
     * @param type $email
     * @return boolean 
     */
    public function sendEmail2($email = array()) {
        if (isset($email['To'])) {

            $mailer = Yii::createComponent('application.extensions.mailer.EMailer');



            $mailer->FromName = (isset($email['FromName']) && !empty($email['FromName']) ? $email['FromName'] : Yii::app()->name); //Yii::app()->user->name;
            Yii::app()->params['smtp'] = ConfMisc::model()->find("param = 'smtp'")->value;
           
            if (Yii::app()->params['smtp'] == 1) {
                $mailer->IsSMTP();

                $mailer->SMTPAuth = true;
                $mailer->SMTPSecure = Yii::app()->params['mailSecuity'];
                //$mailer->SMTPDebug = 2;
                $mailer->Host = Yii::app()->params['mailHost'];
                $mailer->Port = Yii::app()->params['mailPort'];
                $mailer->Username = Yii::app()->params['mailUsername'];
                $mailer->Password = Yii::app()->params['mailPassword'];
                //CVarDumper::dump($mailer,10,true);
            }

            $mailer->IsHTML(true);
            /**
             * if email address is array then add multiple emails
             */
            if (is_array($email['To'])) {
                foreach ($email['To'] as $emailAdd) {
                    $mailer->AddAddress($emailAdd);
                }
            } else {
                $mailer->AddAddress($email['To']);
            }
            $mailer->From = $email['From'];
            $mailer->Subject = $email['Subject'];
            $mailer->Body = $email['Body'];



            if(!$mailer->Send()){
               //echo "NOt sent ".$mailer->ErrorInfo;
            }
            else {
                //echo " sent";
            }
            $mailer->ClearAddresses();
          


            //$mailer->Send();
            //$mailer->ClearAddresses();
            
             $mailer->ClearAddresses();
            $mailer->SMTPKeepAlive = true;
        }
        return true;
    }

   /**
    * It is extend url will take now easy to make url in ciy and country
    * @param type $route
    * @param type $params
    * @param type $ampersand
    *   merge param means if it is true then it preffers user parameters otherwise
    *   it takes session
    * @param type $merge
    * 
    * @return type
    */
    public function createUrl($route, $params = array(), $ampersand = '&',$merge = false) {

        $conCate = array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id']);
        /**
         * for user side only 
         */
        if (!$this->isAdminSite) {
            $conCate['lang'] = $this->currentLang;
        }
        $params = $merge ==false?array_merge($params, $conCate):array_merge($conCate,$params);
       
        return parent::createUrl($route, $params, $ampersand);
    }

    /**
     * set Total amount in session
     */
    public function setTotalAmountSession($grand_total, $total_quantity, $description = "") {
        Yii::app()->session['total_price'] = round($grand_total, 2);
        Yii::app()->session['quantity'] = $total_quantity;
        Yii::app()->session['description'] = $description;
    }

    /**
     * set shipping cost
     * 
     * @param type $shipping
     */
    public function setShippingCost($shipping,$shipping_rate_id = 0) {
        Yii::app()->session['shipping_price'] = round($shipping, 2);
        Yii::app()->session['shipping_rate_id'] = $shipping_rate_id;
    }
    /**
     * set tax cost
     * 
     * @param type $tax
     */
    public function setTaxAmount($tax) {
        Yii::app()->session['tax_amount'] = round($tax, 2);
    }
    /**
     * set Converted currency total cost
     * 
     * @param type $tax
     */
    public function setCurrencyAmount($currency_total) {
        Yii::app()->session['currency_amount'] = round($currency_total, 2);
    }

    /**
     * to change admin city for
     */
    public function changeAdminCity() {
        if (isset($_REQUEST['change_city_id'])) {
            $_REQUEST['city_id'] = $_REQUEST['change_city_id'];
            Yii::app()->user->SiteSessions;
            $this->redirect($this->createUrl($this->route));
        }
    }

    /**
     *  Normal createUrl is now CREATED URL other wise it createurl will apned the session var while it not
     *
     * @param type $route
     * @param type $params
     * @param type $ampersand
     * @return type string
     */
    public function createDTUrl($route, $params = array(), $ampersand = '&') {
        if ($route === '')
            $route = $this->getId() . '/' . $this->getAction()->getId();
        elseif (strpos($route, '/') === false)
            $route = $this->getId() . '/' . $route;
        if ($route[0] !== '/' && ($module = $this->getModule()) !== null)
            $route = $module->getId() . '/' . $route;
        return Yii::app()->createUrl(trim($route, '/'), $params, $ampersand);
    }

    /**
     * 
     * DT dumper for development only just pass the variable...
     * @param type $var
     * @return type
     */
    public function dtdump($var) {
        return CVarDumper::dump($var, 10, TRUE);
    }

    /**
     * Install configurations
     * for soical application
     */
    public function installConfig() {

        $criteria = new CDbCriteria();
        $criteria->addCondition("misc_type = 'other' ");
        $selected = array("dateformat", "auto_item_code", "slider_time");
        $criteria->addInCondition("param", $selected);
        if (!empty($_REQUEST['city_id'])) {
            $criteria->addCondition("city_id = '" . $_REQUEST['city_id'] . "'");
        }
        $criteria->select = "param,value";
       
        $conf = ConfMisc::model()->findAll($criteria);

        if (!empty($conf)) {
            foreach ($conf as $data) {
                Yii::app()->params[$data->param] = $data->value;
            }
        }
    }

}

