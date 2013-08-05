<?php

class m130805_061812_insertTranslation extends DTDbMigration {

    public function up() {
        $table = "dt_messages_translations";
        $folder = Yii::app()->basePath . DIRECTORY_SEPARATOR . "messages" . DIRECTORY_SEPARATOR . "ar" . DIRECTORY_SEPARATOR;
        require_once($folder . "common.php");
        $data = $this->getQueryAll("SELECT id,category,message FROM dt_messages WHERE category='common'");

        foreach ($data as $key => $tr) {
            $columns = array(
                "id" => $tr['id'],
                "language" => "ar",
                "message" => isset($common_t[$tr['message']]) ? $common_t[$tr['message']] : "",
            );
           
            $this->insertRow($table, $columns);
        }

        require_once($folder . "header_footer.php");

        $data = $this->getQueryAll("SELECT id,category,message FROM dt_messages WHERE category='header_footer'");

        foreach ($data as $key => $tr) {
            $columns = array(
                "id" => $tr['id'],
                "language" => "ar",
                "message" => isset($header_footer_t[$tr['message']]) ? $header_footer_t[$tr['message']] : "",
            );
           
            $this->insertRow($table, $columns);
        }

        require_once($folder . "model_labels.php");

        $data = $this->getQueryAll("SELECT id,category,message FROM dt_messages WHERE category='model_labels'");

        foreach ($data as $key => $tr) {
            $columns = array(
                "id" => $tr['id'],
                "language" => "ar",
                "message" => isset($model_labels_t[$tr['message']]) ? $model_labels_t[$tr['message']] : "",
            );

            $this->insertRow($table, $columns);
        }

        require_once($folder . "product_detail.php");

        $data = $this->getQueryAll("SELECT id,category,message FROM dt_messages WHERE category='product_detail'");

        foreach ($data as $key => $tr) {
            $columns = array(
                "id" => $tr['id'],
                "language" => "ar",
                "message" => isset($product_detail_t[$tr['message']]) ? $product_detail_t[$tr['message']] : "",
            );

            $this->insertRow($table, $columns);
        }
    }

    public function down() {
        return true;
    }

}