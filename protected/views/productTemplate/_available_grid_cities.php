<div class="child-container">
    <div class="subsection-header">
        <div class="left_float">
            <a href="javascript:void(0)">
                <div class="left_float" style="padding-top:2px"></div>
                Cities
            </a>
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>

    <div class="child">
        <?php
        $config = array(
            'criteria' => array(
                'condition' => 't.city_id <> :city_id AND c_status = :status AND site.site_headoffice<>0',
                "with" => array("site" => array('joinType' => 'INNER JOIN')),
                'params' => array(
                   // ':universal_name' => $model->universal_name,
                    ':city_id' => City::model()->getCityId("Super")->city_id,
                    ':status' => 1,
                )
               
            ),
            'sort'=>array(
                    'defaultOrder'=>'t.city_name ASC,site.site_headoffice DESC',
            )
        );

        $mName_provider = new CActiveDataProvider("City", $config);
        $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'cities-grid',
            'dataProvider' => $mName_provider,
            'columns' => array(
                array(
                    'name' => 'city_name',
                    'value' => '$data->city_name',
                    "type" => "raw",
                ),
                array(
                    'header' => 'Availability',
                    'value' => '$data->getProductAvailability("'.$model->universal_name.'",$data->city_id)',
                    "type" => "raw",
                ),
               
              
            ),
        ));
        ?>
    </div>


</div>
