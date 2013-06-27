<?php

class m130502_124102_update_product_fields extends CDbMigration {

    public function up() {
        $table = "product";
        $this->update($table, array("authors" => "2"));
        $this->update($table, array("isbn" => "546546-654-14"), "product_id=1");
        $this->update($table, array("isbn" => "546546-644-14"), "product_id=2");
        $this->update($table, array("languages" => "3"), "product_id=2");
        $this->update($table, array("languages" => "2"), "product_id=1");
    }

    public function down() {
        return true;
    }

}