<?php

class m130426_112940_install_log_columns_on_tables extends CDbMigration
{

    public function up()
    {
        $tables = array(
            "author", "cart",
            "categories", "city",
            "country",
            "language", "layout",
            "log", "order",
            "order_detail", "product",
            "product_categories", "product_discount",
            "product_profile","product_reviews",
            "product_image", "product_language",
            "site", "social",
            "status", "user",
            "user_profile", "user_role",
            "region", "subregion"
        );
        foreach ($tables as $table)
        {
            $this->addColumn($table, "create_time", "datetime NOT NULL");
            $this->addColumn($table, "create_user_id", "int(11) unsigned NOT NULL");
            $this->addColumn($table, "update_time", "datetime NOT NULL");
            $this->addColumn($table, "update_user_id", "int(11) unsigned NOT NULL");
            $this->addColumn($table, "activity_log", "text DEFAULT NULL");
        }
    }

    public function down()
    {
        $tables = array(
            "author", "cart",
            "categories", "city",
            "country",
            "language", "layout",
            "log", "order",
            "order_detail", "product",
            "product_categories", "product_discount",
            "product_profile","product_reviews",
            "product_image", "product_language",
            "site", "social",
            "status", "user",
            "user_profile", "user_role",
            "region", "subregion"
        );
        foreach ($tables as $table)
        {
            $this->dropColumn($table, "create_time");
            $this->dropColumn($table, "create_user_id");
            $this->dropColumn($table, "update_time");
            $this->dropColumn($table, "update_user_id");
            $this->dropColumn($table, "activity_log");
        }
    }

}