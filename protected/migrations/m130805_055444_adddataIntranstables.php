<?php

class m130805_055444_adddataIntranstables extends DTDbMigration {

    public function up() {
        $table = "dt_messages";
        $folder = Yii::app()->basePath . DIRECTORY_SEPARATOR . "messages" . DIRECTORY_SEPARATOR . "ar" . DIRECTORY_SEPARATOR;
        require_once($folder . "common.php");

        foreach ($common_t as $key => $tr) {
            $columns = array(
                "category" => "common",
                "message" => $key,
            );
            $this->insertRow($table, $columns);
        }

        require_once($folder . "header_footer.php");

        foreach ($header_footer_t as $key => $tr) {
            $columns = array(
                "category" => "header_footer",
                "message" => $key,
            );
            $this->insertRow($table, $columns);
        }

        require_once($folder . "model_labels.php");

        foreach ($model_labels_t as $key => $tr) {
            $columns = array(
                "category" => "model_labels",
                "message" => $key,
            );
            $this->insertRow($table, $columns);
        }

        require_once($folder . "product_detail.php");

        foreach ($product_detail_t as $key => $tr) {
            $columns = array(
                "category" => "product_detail",
                "message" => $key,
            );
            $this->insertRow($table, $columns);
        }
        
    
    }

    public function down() {
      return true;
    }

}