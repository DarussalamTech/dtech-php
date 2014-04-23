<?php

class m140318_061114_importZones extends DTDbMigration {

    public function up() {
        $table = "zone";
        Yii::import("ext.phpexcel.XPHPExcel");
        echo "\n";
        echo $file = Yii::app()->basePath . "/data/dhl_rate.xlsx";
        $objPHPExcel = XPHPExcel::loadExcelFile($file);
        echo "\n";
        $sheetData = $objPHPExcel->getSheet(1)->toArray();
        unset($sheetData[0]);
        unset($sheetData[1]);
        unset($sheetData[2]);
        foreach ($sheetData as $zoneInfo) {
            echo $sql = "SELECT name FROM zone WHERE name ='{$zoneInfo[3]}'";
            echo "\n";
            $data = $this->getQueryRow($sql);
            if (empty($data)) {
                $columns = array("name" => $zoneInfo[3]);
                $this->insertRow($table, $columns);
            }
        }
    }

    public function down() {
        $table = "zone";
        $this->truncateTable($table);
    }

}