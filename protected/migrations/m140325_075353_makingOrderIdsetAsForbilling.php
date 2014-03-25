<?php

class m140325_075353_makingOrderIdsetAsForbilling extends DTDbMigration {

    public function up() {
        $table = "user_order_billing";
        $billings = $this->getQueryAll("SELECT * FROM " . $table . " WHERE order_id IS  NULL OR order_id = 0");
        foreach ($billings as $billing) {
            if ($billing['order_id'] == 0) {

                $sql = "SELECT * FROM user_order_shipping WHERE ";
                $sql.= " user_id =" . $billing['user_id'] . " AND ";
                $sql.= " shipping_prefix ='" . $billing['billing_prefix'] . "' AND ";
                $sql.= " shipping_first_name ='" . $billing['billing_first_name'] . "' AND ";
                $sql.= " shipping_last_name ='" . $billing['billing_last_name'] . "' AND ";
                $sql.= " shipping_address1 ='" . $billing['billing_address1'] . "' AND ";
                $sql.= " shipping_address2 ='" . $billing['billing_address2'] . "' AND ";
                $sql.= " shipping_country ='" . $billing['billing_country'] . "' AND ";
                $sql.= " shipping_state ='" . $billing['billing_state'] . "' AND ";
                $sql.= " shipping_zip ='" . $billing['billing_zip'] . "' AND ";
                $sql.= " shipping_city ='" . $billing['billing_city'] . "'";
                
                //matching shipping row
                $shipping_row = $this->getQueryRow($sql);

                if (!empty($shipping_row) && $shipping_row['order_id'] != '' && $shipping_row['order_id'] != 0) {
                    print_r($shipping_row['order_id']);
                    echo 'id =' . $billing['id'];
                    $this->update("user_order_billing", array("order_id" => $shipping_row['order_id']), 'id =' . $billing['id']);
                }
                echo "\n";
            }
        }
        return false;
    }

    public function down() {
        
    }

}