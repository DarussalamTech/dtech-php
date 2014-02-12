<?php

/**
 * 
 */
class m131231_102108_tax_amount_inOrder extends DTDbMigration {

    public function up() {
        $table = "order";
        $this->addColumn($table, "tax_amount", "double(12,3) DEFAULT 0 after shipping_price");
    }

    public function down() {
        $table = "order";
        $this->dropColumn($table, "tax_amount");
    }

}

?>