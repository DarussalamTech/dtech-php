<?php

class m130830_124419_insertOrderStatus extends DTDbMigration {

    public function up() {
        $table = "status";
        $columns = array(
            "title"=>"Pending",
            'module' =>'Order'
        );
        $this->insertRow($table, $columns);
        
        $columns = array(
            "title"=>"Process",
            'module' =>'Order'
        );
        $this->insertRow($table, $columns);
        
        
        $columns = array(
            "title"=>"Shipped",
            'module' =>'Order'
        );
        $this->insertRow($table, $columns);
        
        $columns = array(
            "title"=>"Completed",
            'module' =>'Order'
        );
        $this->insertRow($table, $columns);
        
        $columns = array(
            "title"=>"Canceled",
            'module' =>'Order'
        );
        $this->insertRow($table, $columns);
        
        $columns = array(
            "title"=>"Declined",
            'module' =>'Order'
        );
        $this->insertRow($table, $columns);
        
        $columns = array(
            "title"=>"Refunded",
            'module' =>'Order'
        );
        $this->insertRow($table, $columns);
    }

    public function down() {
        $table = "status";
        
        $this->delete($table, 'status = "Pending" AND module = "Order"');
        $this->delete($table, 'status = "Process" AND module = "Order"');
        $this->delete($table, 'status = "Shipped" AND module = "Order" ');
        $this->delete($table, 'status = "Canceled" AND module = "Order" ');
        $this->delete($table, 'status = "Refunded" AND module = "Order" ');
        $this->delete($table, 'status = "Declined" AND module = "Order" ');
    }

}