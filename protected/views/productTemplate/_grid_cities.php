<div class="child-container">
    <div class="subsection-header">
        <div class="left_float">
            <a href="javascript:void(0)">
                <div class="left_float" style="padding-top:2px"></div>
                View This Product in Different Cites
            </a>
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>

    <div class="child">
        <?php
        $config = array(
            'criteria' => array(
                'condition' => 'universal_name= :universal_name AND city_id <> :city_id',
                "with" => array("productProfile" => array('joinType' => 'INNER JOIN')),
                'params' => array(
                    ':universal_name' => $model->universal_name,
                    ':city_id' => City::model()->getCityId("Super")->city_id,
                )
            )
        );

        $mName_provider = new CActiveDataProvider("Product", $config);
        $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'product-cities-grid',
            'dataProvider' => $mName_provider,
            'columns' => array(
                array(
                    'name' => 'product_name',
                    'value' => '$data->product_name',
                    "type" => "raw",
                ),
                array(
                    'name' => 'city',
                    'value' => '!empty($data->city)?$data->city->city_name:""',
                    "type" => "raw",
                ),
                array
                    (
                    'class' => 'CButtonColumn',
                    'template' => '{view}',
                    'buttons' => array(
                        'view' => array(
                            'url' => 'Yii::app()->controller->createUrl("/productTemplate/viewProduct",array("id"=>$data->product_id,"template"=>1))'
                        )
                    ),
                ),
            ),
        ));
        ?>
    </div>


</div>
