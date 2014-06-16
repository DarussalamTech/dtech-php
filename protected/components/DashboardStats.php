<?php

/**
 * DashboardStats stats will be used to display some dashbaord stats
 */
class DashboardStats extends CComponent {

    /**
     * get total customer for a city
     * and super admin for all
     */
    public static function getTotalCustomers() {
        $criteria = new CDbCriteria;
        $criteria->addCondition("role_id = :role_id");
        $criteria->params = array("role_id" => User::LEVEL_CUSTOMER);
        if (!Yii::app()->user->getIsSuperuser()) {
            $criteria->addCondition("city_id = :city_id");
            $criteria->params['city_id'] = Yii::app()->request->getQuery("city_id");
        }
        return User::model()->count($criteria);
    }

    /**
     * 
     * @return type
     */
    public static function getTotalOrders($status = "") {
        $criteria = new CDbCriteria;
        if (!Yii::app()->user->getIsSuperuser()) {
            $criteria->addCondition("city_id = :city_id");
            $criteria->params['city_id'] = Yii::app()->request->getQuery("city_id");
        }
        if (!empty($status)) {
            $all_statuses = Status::model()->gettingOrderStatus();
            $criteria->addCondition("status = :status");
            $criteria->params['status'] = array_search($status, $all_statuses);
        }
        return Order::model()->count($criteria);
    }

    /**
     * get last 10 days ordes
     */
    public static function getLastTenDaysOrders() {
        $criteria = new CDbCriteria;
        if (!Yii::app()->user->getIsSuperuser()) {
            $criteria->addCondition("city_id = :city_id");
            $criteria->params['city_id'] = Yii::app()->request->getQuery("city_id");
        }
        $criteria->order = "create_time DESC"; 
        $criteria->limit = 10;
        return Order::model()->count($criteria);
    }

    /**
     * 
     * get Total Items
     * @param type $category
     * @return type
     */
    public static function getTotalItems($category = "", $notequal = false) {

        $criteria = new CDbCriteria;

        if (Yii::app()->user->getIsSuperuser()) {
            $criteria->addCondition("parent_id = :parent_id");
            $criteria->params['parent_id'] = 0;
        } else {
            $criteria->addCondition("city_id = :city_id");
            $criteria->params['city_id'] = Yii::app()->request->getQuery("city_id");
        }

        if (!empty($category)) {
            if ($notequal == false) {
                $criteria->addCondition("parent_cateogry_id = :parent_cateogry_id");
                $criteria->params['parent_cateogry_id'] = Categories::model()->getParentCategoryId($category);
            } else {

                $criteria->addCondition("parent_cateogry_id <> :parent_cateogry_id");
                $criteria->params['parent_cateogry_id'] = Categories::model()->getParentCategoryId($category);
            }
        }

        return Product::model()->count($criteria);
    }

    /**
     * 
     * @param type $type
     */
    public static function getSalesByType($type = "WEEK") {

        $oDbConnection = Yii::app()->db;

        $sql = "SELECT SUM(`total_price`) as total,create_time 
                FROM `order` GROUP BY WEEK(`create_time`) ORDER BY create_time DESC LIMIT 7 ";
        if ($type == "DAY") {
            $sql = "SELECT (
                    `total_price`
                    ) AS total, create_time, NOW( ) , DATE_SUB( NOW( ) , INTERVAL 100
                    DAY )
                    FROM `order`
                    WHERE create_time <= NOW( )
                    AND create_time >= DATE_SUB( NOW( ) , INTERVAL 30
                    DAY )
                    ORDER BY create_time DESC
                    LIMIT 7 ";
        }
        if ($type == "WEEK") {
            $sql = "SELECT SUM(`total_price`) as total,create_time 
                FROM `order` GROUP BY WEEK(`create_time`)  ORDER BY create_time DESC LIMIT 7";
        } else if ($type == "MONTH") {
            $sql = "SELECT SUM(`total_price`) as total,create_time 
                FROM `order` GROUP BY MONTH(`create_time`) ORDER BY create_time DESC LIMIT 7";
        } else if ($type == "YEAR") {
            $sql = "SELECT SUM(`total_price`) as total,create_time  
                FROM `order` GROUP BY YEAR(`create_time`)  ORDER BY create_time DESC LIMIT 7";
        }

        $oCommand = $oDbConnection->createCommand($sql);
        $oCDbDataReader = $oCommand->queryAll();
        $sum = 0;
        $values_arr = array();

        foreach ($oCDbDataReader as $data) {
            $sum+=$data['total'];
            $values_arr[] = $data['total'];
        }

        return array("total" => round($sum / count($oCDbDataReader)), "values" => implode(",", $values_arr));
    }

    /**
     * get monthly income for dash board
     */
    public static function getMonthlyIncome() {
        $oDbConnection = Yii::app()->db;
        $sql = "SELECT SUM(`total_price`) as total,create_time 
                FROM `order` GROUP BY MONTH(`create_time`) ORDER BY create_time DESC ";

        $oCommand = $oDbConnection->createCommand($sql);
        $oCDbDataReader = $oCommand->queryAll();
        $sum = 0;
        $values_arr = array();

        foreach ($oCDbDataReader as $data) {
            $sum+=$data['total'];
            $values_arr[] = $data['total'];
        }

        return array("total" => round($sum / count($oCDbDataReader)), "values" => implode(",", $values_arr));
    }

}

?>
