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
     * 
     * get Total Items
     * @param type $category
     * @return type
     */
    public function getTotalItems($category = "", $notequal = false) {

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

}

?>
