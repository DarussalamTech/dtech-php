<?php

/**
 * @author Ali <ali.abbas@darussalampk.com>
 * @abstract purpose to make import module for data 
 * and export purpose
 * for zone import
 */
class ZoneImportRates extends CFormModel {

    /**
     * upload file
     */
    public $upload_file;

    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('upload_file', 'safe'),
            array('upload_file', 'file', 'types' => 'xls,xlsx,csv', 'allowEmpty' => false),
        );
    }

    /**
     * importing rates 
     * to database
     * @param type $file
     */
    public function importRates($file) {
        Yii::import("ext.phpexcel.XPHPExcel");

        $objPHPExcel = XPHPExcel::loadExcelFile($file);

        $sheetData = $objPHPExcel->getSheet(0)->toArray();

        //deleteing old dhl records
        $sql = "DELETE  zone_rates_history FROM   " .
                " zone_rates_history " .
                " INNER JOIN zone_rates ON zone_rates.id=zone_rates_history.rate_id WHERE zone_rates.rate_type ='dhl'";
        Yii::app()->db->createCommand($sql)->execute();

        Yii::app()->db->createCommand("DELETE FROM zone_rates WHERe  rate_type ='dhl'")->execute();

        $zones_columns = array(
            2 => 'Middle East',
            4 => 'South Asia',
            6 => 'Great Britain',
            8 => 'Rest of Western Europe',
            10 => 'Greater China',
            12 => 'Rest of Asia',
            14 => 'North America',
            16 => 'Eastern Europe',
            18 => 'Africa',
            20 => 'Central & South America',
        );
        $zone_cols_arr = array();
        foreach ($zones_columns as $key => $zone) {
            $model = new Zone;
            $model->name = $zone;
            $model->save();
            $model = $model->find("name = '" . $zone . "'");
            $zone_cols_arr[$key] = array("name" => $zone, "id" => $model->id);
        }
        //unset some rows non mandatory
        for ($i = 0; $i <= 19; $i++) {
            unset($sheetData[$i]);
        }
        //unset again unnecessary row
        unset($sheetData[80]);
        for ($i = 82; $i <= 86; $i++) {
            unset($sheetData[$i]);
        }


        foreach ($sheetData as $row) {
            $row = array_filter($row);

            foreach ($zone_cols_arr as $key => $zone) {
                $model = new ZoneRates;
                $model->weight = $row[0];
                $model->rate = $row[$key];
                $model->zone_id = $zone['id'];
                $model->city_id = $_REQUEST['city_id'];
                $model->rate_type = "dhl";
                $model->save();
            }
        }
    }

}

?>
