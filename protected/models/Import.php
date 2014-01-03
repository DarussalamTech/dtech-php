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

}

?>
