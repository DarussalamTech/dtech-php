<?php

class CommonSystemController extends Controller {

    /**
     * 
     * A controoler for all common system calls
     * Like ajax calls 
     * 
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '';

    /**
     * get cities  for particular country
     */
    public function actionGetCity() {
        $country_id = $_POST['resource_elem_id'];
        $cityList = array();

        if (!empty($country_id)) {
            $model = new LandingModel();
            $cityList = City::model()->findAll('t.c_status = 1 AND country_id=' . $country_id);
            if (count($cityList) == 1) {
                  echo CHtml::activeHiddenField($model, 'city', array("value"=>$cityList[0]['city_id']));
            } else {
                $cityList =  CHtml::listData($cityList, 'city_id', 'city_name');
                echo CHtml::activeDropDownList($model, 'city', $cityList);
            }
        }
    }

}

?>
