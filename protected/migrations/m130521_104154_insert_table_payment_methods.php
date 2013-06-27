<?php

class m130521_104154_insert_table_payment_methods extends CDbMigration {

    public function up() {
        $table = "payment_methods";
        $columns = array(
            "name" => "PayPal",
            "create_time" => date("Y-m-d h:m:s"),
            "create_user_id" => "1",
            "update_time" => date("Y-m-d h:m:s"),
            "update_user_id" => "1",
        );

        $this->insert($table, $columns);
        $table = "payment_methods";
        $columns = array(
            "name" => "Credit Card",
            "create_time" => date("Y-m-d h:m:s"),
            "create_user_id" => "1",
            "update_time" => date("Y-m-d h:m:s"),
            "update_user_id" => "1",
        );

        $this->insert($table, $columns);
        $table = "payment_methods";
        $columns = array(
            "name" => "Cash On Delievery",
            "create_time" => date("Y-m-d h:m:s"),
            "create_user_id" => "1",
            "update_time" => date("Y-m-d h:m:s"),
            "update_user_id" => "1",
        );

        $this->insert($table, $columns);
    }

    public function down() {
         $table = "payment_methods";
         $this->delete($table,'name="PayPal"');
         $this->delete($table,'name="Credit Card"');
         $this->delete($table,'name="Cash On Delievery"');
    }

}