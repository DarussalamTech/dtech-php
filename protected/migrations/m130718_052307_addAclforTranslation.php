<?php

class m130718_052307_addAclforTranslation extends DTDbMigration {

    public function up() {
        $table = "authitem";
        $columns = array(
            "name" => "Product.Language",
            "type" => "0",
            "bizrule" => "",
            "data" => "N;",
        );
        $this->insert($table, $columns);

        //-------------
        $table = "authitem";
        $columns = array(
            "name" => "Product.LanguageDelete",
            "type" => "0",
            "bizrule" => "",
            "data" => "N;",
        );
        $this->insert($table, $columns);
        //-------------
        $table = "authitem";
        $columns = array(
            "name" => "Product.ProfileLanguage",
            "type" => "0",
            "bizrule" => "",
            "data" => "N;",
        );
        $this->insert($table, $columns);
        //-------------
        $table = "authitem";
        $columns = array(
            "name" => "Product.ProfileLanguageDelete",
            "type" => "0",
            "bizrule" => "",
            "data" => "N;",
        );
        $this->insert($table, $columns);

        //------------- *****//
        $table = "authitemchild";
        $columns = array(
            "parent" => "Product.Update",
            "child" => "Product.Language",
        );
        $this->insert($table, $columns);
        //-------------
        $table = "authitemchild";
        $columns = array(
            "parent" => "Product.Update",
            "child" => "Product.LanguageDelete",
        );
        $this->insert($table, $columns);
        //-------------
        $table = "authitemchild";
        $columns = array(
            "parent" => "Product.Update",
            "child" => "Product.ProfileLanguage",
        );
        $this->insert($table, $columns);
        //-------------
        $table = "authitemchild";
        $columns = array(
            "parent" => "Product.Update",
            "child" => "Product.ProfileLanguageDelete",
        );
        $this->insert($table, $columns);

        //-------------

        $table = "rights";
        $columns = array(
            "itemname" => "Product.Language",
            "type" => "0",
        );
        $this->insert($table, $columns);

        //-------------
        $table = "rights";
        $columns = array(
            "itemname" => "Product.LanguageDelete",
            "type" => "0",
        );
        $this->insert($table, $columns);
        //-------------
        $table = "rights";
        $columns = array(
            "itemname" => "Product.ProfileLanguage",
            "type" => "0",
        );
        $this->insert($table, $columns);
        //-------------
        $table = "rights";
        $columns = array(
            "itemname" => "Product.ProfileLanguageDelete",
            "type" => "0",
        );
        $this->insert($table, $columns);
    }

    public function down() {
        $table = "authitem";
        $this->delete($table, "name='Product.Language'");
        $this->delete($table, "name='Product.LanguageDelete'");
        $this->delete($table, "name='Product.ProfileLanguage'");
        $this->delete($table, "name='Product.ProfileLanguageDelete'");

        $table = "authitemchild";
        $this->delete($table, "child='Product.Language'");
        $this->delete($table, "child='Product.LanguageDelete'");
        $this->delete($table, "child='Product.ProfileLanguage'");
        $this->delete($table, "child='Product.ProfileLanguageDelete'");

        $table = "rights";
        $this->delete($table, "itemname='Product.Language'");
        $this->delete($table, "itemname='Product.LanguageDelete'");
        $this->delete($table, "itemname='Product.ProfileLanguage'");
        $this->delete($table, "itemname='Product.ProfileLanguageDelete'");
    }

}