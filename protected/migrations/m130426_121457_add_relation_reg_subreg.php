<?php

class m130426_121457_add_relation_reg_subreg extends CDbMigration {

    public function up() {
        $table = "subregion";
        $this->addForeignKey("fk_region_subregion", $table, 'region_id', 'region', 'id', 'CASCADE', 'CASCADE');
    }

    public function down() {
        $table = "subregion";
        $this->dropForeignKey("fk_region_subregion", $table);
    }

}