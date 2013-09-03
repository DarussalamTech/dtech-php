<?php

/**
 * Send Back Stock to acutal product
 */
class SendBackStock extends CFormModel {

    public $order_quantity, $stock_quanity, $notify;

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
           
            array('order_quantity, stock_quanity', 'required'),
            array('stock_quanity', 'compareStock'),
            array('stock_quanity', 'numerical', 'integerOnly' => true),
            array('notify','safe'),
    
        );
    }
    /**
     * to validate admin send back
     * quanity should be same 
     * or less then quantiy in order
     */
    public function compareStock(){
        
        if($stock_quanity>$this->order_quantity){
            $this->addError("stock_quanity", "Should be equal or less then order quantity");
        }
    }
    
    

}

?>
