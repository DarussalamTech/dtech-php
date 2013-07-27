<?php

class m130727_094932_insert_slag_for_seo extends DTDbMigration {

    public function up() {
        $this->addColumn('product', 'slag', 'varchar(30) DEFAULT NULL  after product_name');
        $this->addColumn('product_profile', 'slag', 'varchar(30) DEFAULT NULL  after title');
    }

    public function down() {
        $this->dropColumn('product', 'slag');
        $this->dropColumn('product_profile', 'slag');
    }

}