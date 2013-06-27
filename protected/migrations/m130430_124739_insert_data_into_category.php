<?php

class m130430_124739_insert_data_into_category extends CDbMigration {

    public function up() {
        $table = "categories";
     /*
      first delete data form category and product category table manually then run the migration
      */

        $columns = array(
            "category_name" => "Aqeedah",
            "added_date" => time(),
            "parent_id" => "0",
            "city_id" => 1,
        );
        $this->insert($table, $columns);
        
        $columns = array(
            "category_name" => "Biography",
            "added_date" => time(),
            "parent_id" => "0",
            "city_id" => 1,
        );
        $this->insert($table, $columns);

        $columns = array(
            "category_name" => "Biography of the Prophet",
            "added_date" => time(Yii::app()->params['dateformat']),
            "parent_id" => "0",
            "city_id" => 1,
        );
        $this->insert($table, $columns);
        $columns = array(
            "category_name" => "Children",
            "added_date" => time(Yii::app()->params['dateformat']),
            "parent_id" => "0",
            "city_id" => 1,
        );
        $this->insert($table, $columns);
        $columns = array(
            "category_name" => "Fatawa",
            "added_date" => time(Yii::app()->params['dateformat']),
            "parent_id" => "0",
            "city_id" => 1,
        );
        $this->insert($table, $columns);
        $columns = array(
            "category_name" => "Fiqh",
            "added_date" => time(Yii::app()->params['dateformat']),
            "parent_id" => "0",
            "city_id" => 1,
        );
        $this->insert($table, $columns);
        $columns = array(
            "category_name" => "General",
            "added_date" => time(Yii::app()->params['dateformat']),
            "parent_id" => "0",
            "city_id" => 1,
        );
        $this->insert($table, $columns);
        $columns = array(
            "category_name" => "Hadith",
            "added_date" => time(Yii::app()->params['dateformat']),
            "parent_id" => "0",
            "city_id" => 1,
        );
        $this->insert($table, $columns);
        $columns = array(
            "category_name" => "History",
            "added_date" => time(Yii::app()->params['dateformat']),
            "parent_id" => "0",
            "city_id" => 1,
        );
        $this->insert($table, $columns);
        $columns = array(
            "category_name" => "Islamic Culture",
            "added_date" => time(Yii::app()->params['dateformat']),
            "parent_id" => "0",
            "city_id" => 1,
        );
        $this->insert($table, $columns);
        $columns = array(
            "category_name" => "Non-Muslim",
            "added_date" => time(Yii::app()->params['dateformat']),
            "parent_id" => "0",
            "city_id" => 1,
        );
        $this->insert($table, $columns);
        $columns = array(
            "category_name" => "Worship",
            "added_date" => time(Yii::app()->params['dateformat']),
            "parent_id" => "0",
            "city_id" => 1,
        );
        $this->insert($table, $columns);
        $columns = array(
            "category_name" => "Packet or Set",
            "added_date" => time(Yii::app()->params['dateformat']),
            "parent_id" => "0",
            "city_id" => 1,
        );
        $this->insert($table, $columns);
        $columns = array(
            "category_name" => "Qur'an",
            "added_date" => time(Yii::app()->params['dateformat']),
            "parent_id" => "0",
            "city_id" => 1,
        );
        $this->insert($table, $columns);
        $columns = array(
            "category_name" => "Stories",
            "added_date" => time(Yii::app()->params['dateformat']),
            "parent_id" => "0",
            "city_id" => 1,
        );
        $this->insert($table, $columns);
        $columns = array(
            "category_name" => "Supplication and Forgiveness",
            "added_date" => time(Yii::app()->params['dateformat']),
            "parent_id" => "0",
            "city_id" => 1,
        );
        $this->insert($table, $columns);
        $columns = array(
            "category_name" => "Tafsir",
            "added_date" => time(Yii::app()->params['dateformate']),
            "parent_id" => "0",
            "city_id" => 1,
        );
        $this->insert($table, $columns);
        $columns = array(
            "category_name" => "Women",
            "added_date" => time(Yii::app()->params['dateformate']),
            "parent_id" => "0",
            "city_id" => 1,
        );
        $this->insert($table, $columns);
        
    }

    public function down() {
       //$this->truncateTable('product_categories');
       //$this->truncateTable('categories');
       return TRUE;
        
    }

}