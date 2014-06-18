<?php

class m140618_095700_addHtaccessRuleForerros extends DTDbMigration {

    public function up() {
        $table = "log";
        $sql = "SELECT * FROM ".$table;
        $data = $this->getQueryAll($sql);
        foreach($data as $model){
            if (stristr($model['browser'], "bot.htm")) {
                if(strstr($model['url'],"darussalampk")){
                    $htaccess_rule = "RedirectMatch 301 " . $model['url'] . " http://www.darussalampk.com" ;
                }
                else if(strstr($model['url'],"darussalamksa")){
                    $htaccess_rule = "RedirectMatch 301 " . $model['url'] . "  http://www.darussalampk.com";
                }
                else if(strstr($model['url'],"darussalampub")){
                    $htaccess_rule = "RedirectMatch 301 " . $model['url'] . "  http://demoecom.darussalampublishers.com/";
                }
                else {
                    $htaccess_rule = "RedirectMatch 301 " . $model['url'] . "  http://localhost/darussalam";
                }
                
                $robots_txt_rule = "User-agent: * \n";
                $robots_txt_rule.=" Disallow:" . $model['url'];
                
                $this->update($table, array("robots_txt_rule"=>$robots_txt_rule,"htaccess_rule"=>$htaccess_rule),"id =".$model['id']);
            }
        }
    }

    public function down() {
        return true;
    }

}