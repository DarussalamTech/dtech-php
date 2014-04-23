<?php

class m140324_055859_cCurrencyColumninRegionImport extends DTDbMigration {

    public function up() {
        $table = "region";
        $this->addColumn($table, "currency_code", "varchar(20) DEFAULT NULL after iso_code_3");

        Yii::import("ext.phpexcel.XPHPExcel");

        $file = Yii::app()->basePath . "/data/currency_code_from.xls";
        $objPHPExcel = XPHPExcel::loadExcelFile($file);

        $sheetData = $objPHPExcel->getSheet(0)->toArray();
        foreach ($sheetData as $sheet) {

            $sql = "SELECT id,name FROM " . $table . " WHERE lower(name) like '%" . strtolower($sheet[0]) . "%'";

            $country = $this->getQueryRow($sql);
            if (!empty($country)) {
                $this->update($table, array("currency_code" => $sheet[3]), 'id =' . $country['id']);
            }
        }
        
    }

    public function down() {
        $table = "region";
        $this->dropColumn($table, "currency_code");
    }

}