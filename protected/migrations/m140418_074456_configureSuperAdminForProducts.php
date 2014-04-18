<?php

class m140418_074456_configureSuperAdminForProducts extends DTDbMigration {

    public function up() {
        $super_user = $this->getSuperUserId();


        //creating super country and super city for super user

        $columns = array(
            "country_name" => "Super",
            "short_name" => "sup",
            "c_status" => "0",
            "site_id" => "1",
        );
        $this->insertRow("country", $columns);

        //finding super country id
        $sql = "SELECT country_id FROM country WHERE country_name = 'Super'";
        $country = $this->getQueryRow($sql);



        $columns = array(
            "city_name" => "Super",
            "short_name" => "sup",
            "c_status" => "0",
            "country_id" => $country['country_id'],
        );
        $this->insertRow('city', $columns);
        //finding super city id
        $sql = "SELECT city_id FROM city WHERE city_name = 'Super'";
        $city = $this->getQueryRow($sql);

        $this->update("user", array(
            "city_id" => $city['city_id'],
        ));
    }

    public function down() {

        //deleting city id super
        $this->execute("SET FOREIGN_KEY_CHECKS=0");
        $columns = array(
            "country_name" => "Super",
            "short_name" => "sup",
            "c_status" => "0",
            "site_id" => "1",
        );
        $this->delete("city", 'city_name = "Super"');
        $this->delete("country", 'country_name = "Super"');
        $city = $this->getLahoreCityId();
      
        $this->update("user", array(
            "city_id" => $city[0],
        ));
        $this->execute("SET FOREIGN_KEY_CHECKS=1");
        return true;
    }

}