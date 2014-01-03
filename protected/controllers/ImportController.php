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
            $phpExcel = XPHPExcel::createPHPExcel('');

            $file = DTUploadedFile::getRecurSiveDirectories(array("import")) . $_GET['file_name'];
            // $objReader = PHPExcel_IOFactory::createReader();
            $inputFileType = PHPExcel_IOFactory::identify($file);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($file);
            
            CVarDumper::dump($objPHPExcel->getSheet(0)->toArray(),10,true);
            die;
            $this->render("step2", array("sheetData" => $sheetData, "file" => $file));
        } else {
            $this->render("invalid_step");
        }
    }

    /**
     * 
     */
    public function handleStep3() {
        
    }

    /**
     * 
     */
    public function handleStep4() {
        
    }

}

?>
