<?php

/**
 * @author Ali Abbas
 * Cform model
 */
class ImportColumns extends CFormModel {

    public $header, $dbColumn ,$dbRelations;

    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('header,dbColumn,dbRelations', 'safe'),
        );
    }

}

?>
