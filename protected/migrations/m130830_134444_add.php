<?php

class m130830_134444_add extends DTDbMigration {

    public function up() {
        $table = "order_history";
        $status = $this->getQueryAll("Select id,title from status where module ='Order'");
        $new_status = array();
        foreach ($status as $data) {
            $new_status[$data['title']] = $data['id'];
        }

        $table = "order_history";
        $orders = $this->getQueryAll("Select order_id,status FROM " . $this->getDBName() . ".order_history ");

        $this->alterColumn($table, 'status', "int(10) NOT NULL");

        foreach ($orders as $data) {
            if (isset($new_status[ucfirst($data['status'])])) {
                $this->update($table, array("status" => $new_status[ucfirst($data['status'])]), "order_id =" . $data['order_id']);
            }
        }
    }

    public function down() {
        $table = "order_history";
        $this->alterColumn($table, 'status', "enum('pending','process', 'completed', 'declined')");
    }

}