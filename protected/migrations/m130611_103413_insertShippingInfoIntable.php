<?php

class m130611_103413_insertShippingInfoIntable extends DTDbMigration {

    public function up() {
        $sql = "SELECT
                u.id as user_id,
                o.order_id,
                u.`shipping_prefix`,
                u.`shipping_first_name`,
                u.`shipping_last_name`,
                u.`shipping_address1`,
                u.`shipping_address2`,
                u.`shipping_country`,
                u.`shipping_state`,
                u.`shipping_city`,
                u.`shipping_zip`,
                u.`shipping_phone`
               FROM `user_profile` u
               INNER JOIN ".$this->getDBName().".order o
               ON o.`user_id` = u.`id`";
        $shippingInfo = $this->getQueryAll($sql);

        foreach($shippingInfo as $ship){
            $columns = $ship;
            
            $this->insertRow("user_order_shipping", $columns);
        }
  
        
    }

    public function down() {
        return true;
    }

}