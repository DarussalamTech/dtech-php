<?php

class m130515_080940_alter_order_and_orderDetail extends CDbMigration {

    public function up() {
        $this->truncateTable("order_detail");
        $this->delete("order");

        $table = "order_detail";
        $this->dropForeignKey("order_detail_ibfk_1", $table);

        $this->renameColumn($table, "product_id", "product_profile_id");

        $this->addForeignKey("fk_order_detail_profile", $table, "product_profile_id", "product_profile", "id");
    }

    public function down() {
        $table = "order_detail";
        $this->dropForeignKey("fk_order_detail_profile", $table);

        $this->renameColumn($table, "product_profile_id", "product_id");

        $this->addForeignKey("order_detail_ibfk_1", $table, "product_id", "product", "product_id");
    }

}