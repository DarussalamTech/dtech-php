<?php

class m140320_071202_addRegiontoCountryInsteadDataMigrations extends DTDbMigration {

     public function up() {
        $table = "region";
        Yii::import("ext.phpexcel.XPHPExcel");

        $file = Yii::app()->basePath . "/data/dhl_rate.xlsx";
        $objPHPExcel = XPHPExcel::loadExcelFile($file);

        $sheetData = $objPHPExcel->getSheet(1)->toArray();
        unset($sheetData[0]);
        unset($sheetData[1]);
        unset($sheetData[2]);

        foreach ($sheetData as $zoneInfo) {

            $zone = $this->getZone($zoneInfo[3]);

            $sql = 'SELECT id,TRIM(name) as name FROM  region WHERE name ="' . $zoneInfo[0] . '"';
            $data = $this->getQueryRow($sql);



            if (empty($data)) {
                $columns = array(
                    "name" => trim($zoneInfo[0]),
                    "status" => 1,
                    "dhl_code" => $zoneInfo[1],
                    "iso_code_2" => $zoneInfo[1],
                    "iso_code_3" => $zoneInfo[1],
                    "zone_id" => $zone,
                );
                $this->insert($table, $columns);
            } else {
                $columns = array(
                    "dhl_code" => $zoneInfo[1],
                    "zone_id" => $zone,
                );
                $this->update($table, $columns, "id = " . $data['id']);
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