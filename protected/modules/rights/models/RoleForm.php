<?php

/**
 * Role change Form
 */
class RoleForm extends CFormModel {

    public $role, $auth_item;

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
            array('role,auth_item', 'safe'),
        );
    }

}

?>
