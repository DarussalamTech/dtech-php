<?php

class m140226_104033_alter_table_productprofile extends CDbMigration {

    public function up() {
        $sql = 'ALTER TABLE product_profile CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci';
        $this->execute($sql);
        return true;
    }

    public function down() {
        echo "m140226_104033_alter_table_productprofile does not support migration down.\n";
        return true;
    }


}