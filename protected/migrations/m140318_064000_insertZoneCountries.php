<?php

class m140318_064000_insertZoneCountries extends DTDbMigration {

    public function up() {
        $table = "country";
        Yii::import("ext.phpexcel.XPHPExcel");

        $file = Yii::app()->basePath . "/data/dhl_rate.xlsx";
        $objPHPExcel = XPHPExcel::loadExcelFile($file);

        $sheetData = $objPHPExcel->getSheet(1)->toArray();
        unset($sheetData[0]);
        unset($sheetData[1]);
        unset($sheetData[2]);

        foreach ($sheetData as $zoneInfo) {

            $zone = $this->getZone($zoneInfo[3]);

            $sql = 'SELECT country_id,country_name FROM country WHERE country_name ="' . $zoneInfo[0] . '"';
            $data = $this->getQueryRow($sql);



            if (empty($data)) {
                $columns = array(
                    "country_name" => $zoneInfo[0],
                    "site_id" => 1,
                    "c_status" => 0,
                    "dhl_code" => $zoneInfo[1],
                    "short_name" => $zoneInfo[1],
                    "zone_id" => $zone,
                );
                $this->insertRow($table, $columns);
            } else {
                $columns = array(
                    "dhl_code" => $zoneInfo[1],
                    "zone_id" => $zone,
                );
                $this->update($table, $columns, "country_id = " . $data['country_id']);
            }
        }
    }

    public function down() {
        return true;
    }

    /**
     * zone related record to 
     * find
     * @param type $zoneName
     */
    public function getZone($zoneName) {
        $sql = "SELECT id FROM zone WHERE name ='{$zoneName}'";
        $data = $this->getQueryRow($sql);
        return $data['id'];
    }

}