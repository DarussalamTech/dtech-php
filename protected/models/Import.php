<?php

/**
 * @author Ali <ali.abbas@darussalampk.com>
 * @abstract purpose to make import module for data 
 * and export purpose
 */
class Import extends CFormModel {

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
     * 
     */
    public function getColumnsList() {

        $curdb = explode('=', Yii::app()->db->connectionString);
        $notIn = "('create_time','create_user_id','update_time','update_user_id','slag','slug')";
        $sql = "SELECT CONCAT('Product_',COLUMN_NAME) as col_key,COLUMN_NAME as col_name
            FROM information_schema.COLUMNS
            WHERE (TABLE_SCHEMA = '" . $curdb[2] . "')
              AND (TABLE_NAME = 'product')
              AND (COLUMN_KEY <> 'PRI') AND
            COLUMN_NAME NOT IN $notIn
                ORDER BY COLUMN_NAME
            ";

        $columns_prod = Yii::app()->db->createCommand($sql)->queryAll();

        $sql = "SELECT CONCAT('ProductProfile_',COLUMN_NAME) as col_key,COLUMN_NAME as col_name
            FROM information_schema.COLUMNS
            WHERE (TABLE_SCHEMA = '" . $curdb[2] . "')
              AND (TABLE_NAME = 'product_profile')
              AND (COLUMN_KEY <> 'PRI') AND
            COLUMN_NAME NOT IN $notIn
            ORDER BY COLUMN_NAME
            ";

        $columns_prod_profile = Yii::app()->db->createCommand($sql)->queryAll();

        return array_merge($columns_prod, $columns_prod_profile);
    }

}

?>
