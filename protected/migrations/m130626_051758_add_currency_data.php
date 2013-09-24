<?php

class m130626_051758_add_currency_data extends CDbMigration {

    public function up() {
        $table = "currency";
        $this->truncateTable($table);

        /*
         * data taken from
         * www.xe.com/iso4217.php
         */

        $currency_name_symbol = array(
            0 => array("symbol" => "PKR", "name" => "Pakistan Rupee"),
            1 => array("symbol" => "SAR", "name" => "Saudi Arabia Riyal"),
            2 => array("symbol" => "GBP", "name" => "United Kingdom Pound"),
            3 => array("symbol" => "USD", "name" => "United States Dollar"),
            4 => array("symbol" => "AED", "name" => "United Arab Emirates Dirham"), //AED	United Arab Emirates Dirham
            5 => array("symbol" => "CAD", "name" => "Canada Dollar"), //CAD	Canada Dollar
            6 => array("symbol" => "EGP", "name" => "Egypt Pound"), //EGP	Egypt Pound
            7 => array("symbol" => "IDR", "name" => "Indonesia Rupiah"), // /IDR	Indonesia Rupiah
            8 => array("symbol" => "INR", "name" => "India Rupee"), //INR	India Rupee
            9 => array("symbol" => "MYR", "name" => "Malaysia Ringgit"), //MYR	Malaysia Ringgit
            10 => array("symbol" => "OMR", "name" => "Oman Rial"), //OMR	Oman Rial
            11 => array("symbol" => "SYP", "name" => "Syria Pound"), //SYP	Syria Pound
            12 => array("symbol" => "YER", "name" => "Yemen Rial"), //YER	Yemen Rial
            13 => array("symbol" => "DKK", "name" => "Denmark Krone"), //DKK	Denmark Krone
            14 => array("symbol" => "BHD", "name" => "Bahrain Dinar"), //BHD	Bahrain Dinar
        );
        foreach ($currency_name_symbol as $currency) {
            $columns = array(
                "name" => $currency['name'],
                "symbol" => $currency['symbol'],
                "create_time" => date("Y-m-d H:i:s"),
                "create_user_id" => 1,
                "update_time" => date("Y-m-d H:i:s"),
                "update_user_id" => 1,
            );

            $this->insert($table, $columns);
        }
    }

    public function down() {
        $table = "currency";
        $this->truncateTable($table);
    }

}