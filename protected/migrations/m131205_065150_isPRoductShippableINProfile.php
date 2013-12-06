<?php

class m131205_065150_isPRoductShippableINProfile extends DTDbMigration {

    public function up() {
        $table = 'product_profile';
        $this->addColumn($table, "is_shippable", "tinyint(1) DEFAULT 1 after weight");
    }

    public function down() {
        $table = 'product_profile';
         $this->dropColumn($table, "is_shippable");
    }

}