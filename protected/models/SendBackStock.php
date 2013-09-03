<?php

/**
 * Send Back Stock to acutal product
 */
class SendBackStock extends CFormModel {

    public $order_quantity, $back_quanity, $notify;

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
           
            array('order_quantity, back_quanity', 'required'),
            array('back_quanity', 'compareStock'),
            array('back_quanity', 'numerical', 'integerOnly' => true),
            array('notify','safe'),
    
        );
    }
    /**
     * to validate admin send back
     * quanity should be same 
     * or less then quantiy in order
     */
    public function compareStock(){
        
        if($this->back_quanity>$this->order_quantity){
            $this->addError("back_quanity", "Should be equal or less then order quantity");
        }
    }
    
    

}

?>
