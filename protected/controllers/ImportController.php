<?php

/**
 * @author Ali <ali.abbas@darussalampk.com>
 * @abstract purpose to make import module for data 
 * and export purpose
 */
class ImportController extends Controller {

    public function beforeAction($action) {
        Yii::app()->theme = "admin";

        parent::beforeAction($action);

        $operations = array('create', 'update', 'index', 'delete');
        parent::setPermissions($this->id, $operations);
        return true;
    }

    /**
     * steps to import
     * @param type $step
     */
    public function actionIndex($step = 1) {

        switch ($step) {
            case 1:
                $this->handleStep1();
                break;
            case 2:
                $this->handleStep2();
                break;
            case 3:
                $this->handleStep3();
                break;
            case 4:
                $this->handleStep4();

                break;
            default:
                break;
        }
    }

    /**
     * step 1 to upload file
     * 
     */
    public function handleStep1() {
        $model = new Import();
        if (isset($_POST['Import'])) {
            $model->attributes = $_POST['Import'];
            //making instance of the uploaded image 
            $_file = DTUploadedFile::getInstance($model, 'upload_file');
            $model->upload_file = $_file;
            if ($model->validate()) {
                $upload_path = DTUploadedFile::creeatRecurSiveDirectories(array("import"));
                if (!empty($_file)) {
                    $_file->saveAs($upload_path . str_replace(" ", "_", $_file->name));
                    $this->redirect($this->createUrl("/import/index", array("step" => 2, "file_name" => str_replace(" ", "_", $_file->name))));
                }
            }
        }

        $this->render("step1", array("model" => $model));
    }

    /**
     * handle step 2
     * to display column list
     */
    public function handleStep2() {
        if (isset($_GET['file_name'])) {

            Yii::import("ext.phpexcel.XPHPExcel");
            /**
             * Excel module area to get Columns list
             */
            $phpExcel = XPHPExcel::createPHPExcel('');


            $cacheMethod = PHPExcel_CachedObjectStorageFactory:: cache_to_phpTemp;
            $cacheSettings = array(' memoryCacheSize ' => '20MB');
            PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);

            $file = DTUploadedFile::getRecurSiveDirectories(array("import")) . $_GET['file_name'];
            // $objReader = PHPExcel_IOFactory::createReader();
            $inputFileType = PHPExcel_IOFactory::identify($file);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($file);

            $sheetData = $objPHPExcel->getSheet(0)->toArray();
            $headers = array_filter($sheetData[0]);
            sort($headers);

            /**
             * Database Columns list
             */
            $import = new Import;
            $columns_list = $import->getColumnsList();


            $Impr_arr = array();
            $countError = 0;
            $mapped_color = array();
            for ($index = 0; $index < count($headers); $index++) {
                $importModel = new ImportColumns();
                if (isset($_POST['ImportColumns'][$index])) {
                    $importModel->attributes = $_POST['ImportColumns'][$index];
                    $mapped_color[$importModel->header] = $importModel->dbColumn;
                }

                /**
                 * error checking if column map should be more then 4
                 */
                if (count(array_filter($importModel->attributes)) == 0) {
                    $countError++;
                }
                $Impr_arr[$index] = $importModel;
            }
            /**
             * columns maping should be more than 5
             */
            if (isset($_POST['ImportColumns']) && count($headers) - $countError <= 5) {
                $import->addError("error_field", "Atleast 5 rows should be mapped");
            } else if (isset($_POST['ImportColumns']) && count($headers) - $countError > 5) {
                $mapping = new ImportMapping();
                $mapping->file_path = $file;
                $mapping->file_name = $_GET['file_name'];
                $mapping->module = "product";
                $mapping->headers_json = CJSON::encode($headers, true);
                $mapping->db_cols_json = CJSON::encode($mapped_color, true);
                $mapping->save();
                $this->redirect($this->createUrl("/import/index", array(
                            "step" => 3,
                            "id" => $mapping->id,
                )));
            }
            $this->render("step2", array(
                "dbColumns" => CHtml::listData($columns_list, 'col_key', 'col_name'),
                "headers" => $headers,
                "Impr_arr" => $Impr_arr,
                "Import" => $import,
            ));
        } else {
            $this->render("invalid_step");
        }
    }

    /**
     * handle step 3
     */
    public function handleStep3() {
        $id = $_REQUEST['id'];
        $model = ImportMapping::model()->findByPk($id);
        $relations = Product::model()->getRelationNames() + ProductProfile::model()->getRelationNames();

        $Impr_arr = array();
        $countError = 0;

        $headers = CJSON::decode($model->headers_json);
        
        //excluding those columns who are  already in db columns
        
        $dbCols = CJSON::decode($model->db_cols_json);
        
        foreach($dbCols as $key=>$cName){
            unset($headers[$key]);
        }
        
        for ($index = 0; $index < count($headers); $index++) {
            $importModel = new ImportColumns();
            if (isset($_POST['ImportColumns'][$index])) {
                $importModel->attributes = $_POST['ImportColumns'][$index];
            }

            /**
             * error checking if column map should be more then 4
             */
            if (count(array_filter($importModel->attributes)) == 0) {
                $countError++;
            }
            $Impr_arr[$index] = $importModel;
        }


        $this->render("step3", array(
            "model" => $model,
            "relations" => $relations,
            "headers" => $headers,
            "Impr_arr" => $Impr_arr
        ));
    }

    /**
     * 
     */
    public function handleStep4() {
        
    }

}

?>
