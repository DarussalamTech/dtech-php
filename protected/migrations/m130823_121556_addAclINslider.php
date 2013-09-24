<?php

class m130823_121556_addAclINslider extends CDbMigration {

    public function up() {
        $table = "authitem";
        $columns = array(
            "name" => "Product.Slider",
            "type" => "0",
            "bizrule" => "",
            "data" => "N;",
        );
        $this->insert($table, $columns);

        $columns = array(
            "name" => "Product.CreateSlider",
            "type" => "0",
            "bizrule" => "",
            "data" => "N;",
        );
        $this->insert($table, $columns);

        $columns = array(
            "name" => "Product.RemoveSlider",
            "type" => "0",
            "bizrule" => "",
            "data" => "N;",
        );
        $this->insert($table, $columns);

        $columns = array(
            "name" => "Product.SliderSetting",
            "type" => "0",
            "bizrule" => "",
            "data" => "N;",
        );
        $this->insert($table, $columns);



        //------------- *****//
        $table = "authitemchild";
        $columns = array(
            "parent" => "Product.*",
            "child" => "Product.Slider",
        );
        $this->insert($table, $columns);

        $columns = array(
            "parent" => "Product.Slider",
            "child" => "Product.CreateSlider",
        );
        $this->insert($table, $columns);

        $columns = array(
            "parent" => "Product.Slider",
            "child" => "Product.SliderSetting",
        );
        $this->insert($table, $columns);
        //-------------
        $columns = array(
            "parent" => "Product.Slider",
            "child" => "Product.RemoveSlider",
        );
        $this->insert($table, $columns);
        //-------------
        
        

        $table = "rights";
        $columns = array(
            "itemname" => "Product.Slider",
            "type" => "0",
        );
        $this->insert($table, $columns);

        $table = "rights";
        $columns = array(
            "itemname" => "Product.SliderSetting",
            "type" => "0",
        );
        $this->insert($table, $columns);

        $table = "rights";
        $columns = array(
            "itemname" => "Product.RemoveSlider",
            "type" => "0",
        );
        $this->insert($table, $columns);


        $table = "rights";
        $columns = array(
            "itemname" => "Product.CreateSlider",
            "type" => "0",
        );
        $this->insert($table, $columns);
    }

    public function down() {
        $table = "authitem";
        

        $this->delete($table, "name='Product.Slider'");
        $this->delete($table, "name='Product.RemoveSlider'");
        $this->delete($table, "name='Product.CreateSlider'");
        $this->delete($table, "name='Product.SliderSetting'");


        $table = "authitemchild";

        $this->delete($table, "child='Product.Slider'");
        $this->delete($table, "child='Product.RemoveSlider'");
        $this->delete($table, "child='Product.CreateSlider'");
        $this->delete($table, "child='Product.SliderSetting'");

        $table = "rights";

        $this->delete($table, "itemname='Product.Slider'");
        $this->delete($table, "itemname='Product.RemoveSlider'");
        $this->delete($table, "itemname='Product.CreateSlider'");
        $this->delete($table, "itemname='Product.SliderSetting'");
    }

}