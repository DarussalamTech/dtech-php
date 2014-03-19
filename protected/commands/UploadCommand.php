<?php

class UploadCommand extends CConsoleCommand {

    public function run($args) {
        Yii::import("ext.phpexcel.XPHPExcel");
        echo "\n";
        echo $file = Yii::app()->basePath . "/data/dhl_rate.xlsx";
        $objPHPExcel = XPHPExcel::loadExcelFile($file);
        echo "\n";
        $sheets = $objPHPExcel->getSheetNames();
        $sheetData = $objPHPExcel->getSheet(1)->toArray();
        print_r($sheetData);
        echo "\n";
    }

}

?>
