<?php
$relationName = "countries";
$mName = "Region";
?>

<div class="<?php echo $relationName; ?> child" style="<?php echo 'display:' . (isset($_POST[$mName]) ? 'block' : 'none'); ?>">
    <?php
    $config = array(
        'criteria' => array(
            'condition' => 'zone_id =' . $model->primaryKey
        ),
        'sort' => array(
            'defaultOrder' => array(
                'id' => true,
            ),
        ),
        'pagination' => array(
            'pageSize' => 40,
        ),
    );
    $mNameobj = new $mName;
    $mName_provider = new CActiveDataProvider($mName, $config);
    $this->widget('DtGridView', array(
        'id' => $mName . '-grid',
        'dataProvider' => $mName_provider,
        'columns' => array(
            array(
                'name' => 'name',
                'value' => '$data->name',
                "type" => "raw",
            ),
            array(
                'name' => 'dhl_code',
                'value' => '$data->dhl_code',
                "type" => "raw",
            ),
            array(
                'name' => 'currency_code',
                'value' => '$data->currency_code',
                "type" => "raw",
            ),
            //no need for this this will be from import script or migrations
//            array
//                (
//                'class' => 'CButtonColumn',
//                'template' => '',
//                'buttons' => array
//                    (
//                    'update' => array
//                        (
//                        'label' => 'update',
////                                'url' => 'Yii::app()->controller->createUrl("laborForm",array("id"=> $data->id, "daily_report_id"=>' . $model->id . '))',
//                        'url' => 'Yii::app()->controller->createUrl("editChild", array("id"=> $data->primaryKey, "mName"=>get_class($data), "dir" => "' . $dir . '"))',
//                        'click' => "js:function() {
//                                            $('#loading').toggle();
//                                            $.ajax({
//                                                url: $(this).attr('href'),
//                                                success: function(response)
//                                                {
//                                                    $('#$relationName-form').css('display', 'block');
//                                                    $('#" . $dir . "_fields').html(response);
//                                                    $('#" . $dir . "_fields .grid_fields').last().animate({
//                                                            opacity:1, left: '+50', height: 'toggle'
//                                                        });
//                                                    $('#loading').toggle();
//                                                    add_mode = false;
//                                                }
//                                            }); return false; }",
//                    ),
//                    'delete' => array(
//                        'label' => 'Delete',
//                        'url' => 'Yii::app()->controller->createUrl("deleteChildByAjax",array("id" => $data->primaryKey, "mName" => "' . $mName . '"))',
//                    ),
//                ),
//            ),
        ),
    ));
    ?>
</div>
