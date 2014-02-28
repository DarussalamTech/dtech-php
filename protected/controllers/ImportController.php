<?php

/**
 * @author Ali <ali.abbas@darussalampk.com>
 * @abstract purpose to make import module for data 
 * and export purpose
 */
class ImportController extends Controller {

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            // 'accessControl', // perform access control for CRUD operations
            'rights',
            'https + index + view + update + create',
        );
    }

    public function allowedActions() {
        return '@';
    }

    public function beforeAction($action) {
        Yii::app()->theme = "admin";
        parent::beforeAction($action);

        $operations = array('status');
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
            case 5:
                $this->handleStep5();
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
     * step 2 handle to import columns
     * 
     */
    public function handleStep2() {
        if (isset($_GET['file_name'])) {
            Yii::import("ext.phpexcel.XPHPExcel");

            $model = new ImportMapping();

            $file = DTUploadedFile::getRecurSiveDirectories(array("import")) . $_GET['file_name'];
            /**
             * Excel module area to get Columns list
             */
            Yii::import("ext.phpexcel.XPHPExcel");


            $objPHPExcel = XPHPExcel::loadExcelFile($file);

            if (isset($_POST['ImportMapping'])) {
                $model->attributes = $_POST['ImportMapping'];

                $model->file_path = $file;
                $model->file_name = $_GET['file_name'];
                $model->module = "product";

                if ($category = Categories::model()->find("city_id = " . $model->city_id . " AND category_name = 'Books'")) {
                    $model->category = $category->category_id;
                }

                if ($model->save()) {
                    $this->redirect($this->createUrl("/import/index", array(
                                "step" => 3,
                                "id" => $model->id,
                    )));
                }
            }

            $this->render("step2", array("model" => $model, "sheets" => $objPHPExcel->getSheetNames()));
        } else {
            $this->render("invalid_step");
        }
    }

    /**
     * handle step 3
     * to display column list
     */
    public function handleStep3() {
        //if the model id is present then it will be show step 3
        if (isset($_GET['id'])) {
            $mapping = ImportMapping::model()->findByPk($_GET['id']);

            Yii::import("ext.phpexcel.XPHPExcel");
            /**
             * Excel module area to get Columns list
             */
//            CVarDumper::dump($mapping->file_path, 10, true);
            $objPHPExcel = XPHPExcel::loadExcelFile($mapping->file_path);

            $sheetData = $objPHPExcel->getSheet($mapping->sheet)->toArray();

            $headers = array_filter($sheetData[0]);
//            if (strpos($mapping->file_path, '.csv') !== false) {
//                $header = array();
//                $header = explode('|', $headers[0]);
//                $headers = $header;
//            }

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

                $mapping->headers_json = CJSON::encode($headers, true);
                $mapping->db_cols_json = CJSON::encode($mapped_color, true);
                $mapping->save();
                $this->redirect($this->createUrl("/import/index", array(
                            "step" => 4,
                            "id" => $mapping->id,
                )));
            }
            $this->render("step3", array(
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
     * handle step 4
     * relation name will be displayed here
     */
    public function handleStep4() {
        $id = $_REQUEST['id'];
        $model = ImportMapping::model()->findByPk($id);
        $relations = Product::model()->getRelationNames() + ProductProfile::model()->getRelationNames();

        $Impr_arr = array();
        $countError = 0;

        $headers = CJSON::decode($model->headers_json);

        //excluding those columns who are  already in db columns

        $dbCols = CJSON::decode($model->db_cols_json);

        foreach ($dbCols as $key => $cName) {
            unset($headers[$key]);
        }
        $mapped_rel = array();
        for ($index = 0; $index < count($headers); $index++) {
            $importModel = new ImportColumns();
            if (isset($_POST['ImportColumns'][$index])) {
                $importModel->attributes = $_POST['ImportColumns'][$index];
                $mapped_rel[$importModel->header] = $importModel->dbRelations;
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
        if (isset($_POST['ImportColumns']) && count($headers) - $countError <= 0) {

            $importModel->addError("error_field", "Atleast 1 rows should be mapped");
        } else if (isset($_POST['ImportColumns']) && count($headers) - $countError > 0) {

            $model->updateByPk($id, array("relational_json" => CJSON::encode($mapped_rel, true)));
            $this->redirect($this->createUrl("/import/index", array(
                        "step" => 5,
                        "id" => $model->id,
            )));
        }


        $this->render("step4", array(
            "model" => $model,
            "relations" => $relations,
            "headers" => $headers,
            "Impr_arr" => $Impr_arr
        ));
    }

    /**
     * step 5 step that will start importing 
     * data and taking all dependencies
     */
    public function handleStep5() {
        $model = ImportMapping::model()->findByPk($_REQUEST['id']);

        Yii::import("ext.phpexcel.XPHPExcel");
        /**
         * Excel module area to get Columns list
         */
        $objPHPExcel = XPHPExcel::loadExcelFile($model->file_path);
        //convert sheet to array  
//        CVarDumper::dump($model->file_path,10,true);
//                die;

        $sheetData = $objPHPExcel->getSheet(0)->toArray();
//        $header = array();
//        $counter=0;
//        if (strpos($model->file_path, '.csv') !== false) {
//            foreach ($sheetData as $row){
//        
//            
//            $header[$counter++] = explode('|', $row[0]);
//             
//            }
//            $sheetData=$header;
//        }
//        


        $this->render("step5", array("sheetData" => $sheetData, "model" => $model));
    }

    /**
     * insert to db
     * it is an import process
     */
    public function actionInsert($id) {
        Yii::app()->params['auto_item_code'] = 0;
        $model = ImportMapping::model()->findByPk($id);
        $dbCols = CJSON::decode($model->db_cols_json, true);
        $relationCols = CJSON::decode($model->relational_json, true);
        $headers = CJSON::decode($model->headers_json, true);

        $productRelations = Product::model()->relationColumns();
        $productProfRelations = ProductProfile::model()->relationColumns();

        //process of excel data to db
        if (isset($_POST['data'])) {
            foreach ($_POST['data'] as $post) {

                $pModel = new Product;
                $pModel->city_id = $model->city_id;
                $prModel = new ProductProfile;


                foreach ($headers as $headerKey => $header) {
                    if (isset($dbCols[$headerKey])) {
                        if (strstr($dbCols[$headerKey], "Product_")) {
                            $attr = str_replace("Product_", "", $dbCols[$headerKey]);
                            if (!empty($post[$headerKey]))
                                $pModel->$attr = $post[$headerKey];

                            if (isset($productRelations[$attr])) {
                                $criteria = new CDbCriteria;
                                $criteria->addCondition($productRelations[$attr]['key'] . " = '" . $post[$headerKey] . "'");
                                if ($relModlel = $productRelations[$attr]['model']::model()->find($criteria)) {
                                    $pModel->$attr = $relModlel->primaryKey;
                                }
                            }
                        } else if (strstr($dbCols[$headerKey], "ProductProfile_")) {
                            $attr = str_replace("ProductProfile_", "", $dbCols[$headerKey]);
                            if (!empty($post[$headerKey]))
                                $prModel->$attr = $post[$headerKey];
                            if (isset($productProfRelations[$attr])) {
                                $criteria = new CDbCriteria;
                                $criteria->addCondition($productProfRelations[$attr]['key'] . " = '" . $post[$headerKey] . "'");
                                if (isset($productProfRelations[$attr]['condition'])) {
                                    $criteria->addCondition($productProfRelations[$attr]['condition']);
                                }
                                if ($relModlel = $productProfRelations[$attr]['model']::model()->find($criteria)) {
                                    $prModel->$attr = $relModlel->primaryKey;
                                }
                            }
                        }
                    }
                }
                $pModel->parent_cateogry_id = $model->category;
                $pModel->is_featured = 0;
                if ($pModel->save()) {

                    $prModel->product_id = $pModel->primaryKey;
//                    CVarDumper::dump($prModel->attributes,10,true);

                    $short_name = City::model()->findByAttributes(
                            array(), 'city_id=:city_id', array(':city_id' => $pModel->city_id)
                    );
                   
                    $prModel->item_code = $short_name['short_name'].$prModel->product_id;


                    $prModel->save();
                    
                    foreach ($headers as $headerKey => $header) {
                        if (isset($relationCols[$headerKey])) {
                            $relatonName = $relationCols[$headerKey];

                            $activeRelation = $pModel->getActiveRelation($relatonName);
                            if ($activeRelation instanceOf CHasManyRelation) {
                                if ($activeRelation->name == "productCategories") {

                                    if ($category = Categories::model()->find("category_name = '" . $post[$headerKey] . "'")) {
                                        $prodcat = new ProductCategories();
                                        $prodcat->category_id = $category->primaryKey;
                                        $prodcat->product_id = $pModel->primaryKey;
                                        $prodcat->save();
                                    } else {
                                        $category = new Categories;
                                        $category->category_name = $post[$headerKey];
                                        $category->parent_id = $model->category;

                                        $category->save();

                                        $prodcat = new ProductCategories();
                                        $prodcat->category_id = $category->primaryKey;
                                        $prodcat->product_id = $pModel->primaryKey;
                                        $prodcat->save();
                                    }
                                }
                            }
                        }
                    }
                }//end of product save
            }

            $model->updateByPk($model->id, array(
                "total_steps" => $_POST['total_steps'],
                "completed_steps" => $_POST['index'])
            );
        }
    }

    /**
     * mapping list
     */
    public function actionMappingList() {
        $model = new ImportMapping('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['ImportMapping']))
            $model->attributes = $_GET['ImportMapping'];
        $this->render("list", array("model" => $model));
    }

    /**
     *  end result of file and status
     */
    public function actionStatus($id) {
        if ($model = ImportMapping::model()->findByPk($id)) {
            Yii::import("ext.phpexcel.XPHPExcel");
            //if the completed steps is only less then then 1 then the update to complete

            if ($model->completed_steps + 1 == $model->total_steps) {
//                CVarDumper::dump($model->completed_steps,10,true);
//                die();
                $model->completed_steps++;
                $model->updateByPk($id, array("completed_steps" => $model->total_steps));
            }
            $this->render("status", array("model" => $model, "sheet" => XPHPExcel::loadExcelFile($model->file_path)->getSheetNames()));
        } else {
            $this->render("invalid_step");
        }
    }

}

?>
