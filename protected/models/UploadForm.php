<?php

/**
 * purpose of this class to upload pictures
 * for different places
 * alonely like
 * it is using in tiny mc
 */
class UploadForm extends CFormModel {

    public $upload_file;

    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('upload_file', 'safe'),
        );
    }

}

?>
