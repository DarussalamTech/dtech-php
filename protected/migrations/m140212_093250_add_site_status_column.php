<?php

class m140212_093250_add_site_status_column extends CDbMigration {

    public function up() {
        $table = "site";
        $this->addColumn($table, "status", "tinyint(1) NOT NULL DEFAULT 1 after site_headoffice");
    }

    public function down() {
        $table = "order";
        $this->dropColumn($table, "status");
    }

    /*
      // Use safeUp/safeDown to do migration with transaction
      public function safeUp()
      {
      }

      public function safeDown()
      {
      }
     */
}