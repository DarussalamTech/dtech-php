<?php

class m130530_124848_insert_data_to_site_table extends DTDbMigration {

    public function up() {


        $table = "site";
        $sql = "INSERT INTO " . $table . " SET site_name ='dtechsystems.info'  ";
        $sql.= ", site_descriptoin ='dtechsystems.info' , site_headoffice='1'";
        $sql.= ", create_time ='" . date("Y-m-d H:i:s") . "' , create_user_id='1' ";
        $sql.= ", update_time ='" . date("Y-m-d H:i:s") . "' , update_user_id='1' ";
        $sql.= ", activity_log ='by admin'  ";

        $this->execute($sql);



        $sql = "INSERT INTO " . $table . " SET site_name ='54.214.251.208' ";
        $sql.= ", site_descriptoin ='54.214.251.208' , site_headoffice='1'";
        $sql.= ", create_time ='" . date("Y-m-d H:i:s") . "' , create_user_id='1' ";
        $sql.= ", update_time ='" . date("Y-m-d H:i:s") . "' , update_user_id='1' ";
        $sql.= ", activity_log ='by admin'  ";

         $this->execute($sql);
    }

    public function down() {
        $table = "site";
        $this->delete($table, 'site_name="54.214.251.208"');
        $this->delete($table, 'site_name="dtechsystems.info"');
    }

}