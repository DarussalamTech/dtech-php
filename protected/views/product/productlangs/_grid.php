<?php
$relationName = "productlangs";
$mName = "ProductLang";
?>

<div class="<?php echo $relationName; ?> child" style="<?php echo 'display:' . (isset($_POST[$mName]) ? 'block' : 'none'); ?>">
    <?php
    $config = array(
        'criteria' => array(
            'condition' => 'product_id=' . $model->primaryKey,
        )
    );

    $mNameobj = new $mName;
    $mName_provider = new CActiveDataProvider($mName, $config);
    $this->widget('DtGridView', array(
        'id' => $mName . '-grid',
        'dataProvider' => $mName_provider,
        'columns' => array(
            array(
                'name' => 'product_name',
                'value' => '$data->product_name',
                "type" => "raw",
            ),
            array(
                'name' => 'lang_id',
                'value' => '$data->lang_id',
                "type" => "raw",
            ),
            array(
                'name' => 'product_overview',
                'value' => '$data->product_overview',
                "type" => "raw",
            ),
            array(
                'name' => 'product_description',
                'value' => '$data->product_description',
                "type" => "raw",
            ),
            array
                (
                'class' => 'CButtonColumn',
                'template' => '{update} {delete} {viewimage}',
                'buttons' => array
                    (
                    'update' => array
                        (
                        'label' => 'update',
//                                'url' => 'Yii::app()->controller->createUrl("laborForm",array("id"=> $data->id, "daily_report_id"=>' . $model->id . '))',
                        'url' => 'Yii::app()->controller->createUrl("editChild", array(
                                        "id"=> $data->primaryKey, 
                                        "mName"=>get_class($data), 
                                        "dir" => "' . $dir . '",
                                        
                                        ))
                                        
                                        ',
                        'click' => "js:function() {
                                            $('#loading').toggle();
                                            $.ajax({
                                                url: $(this).attr('href'),
                                                success: function(response)
                                                {
                                                    $('#$relationName-form').css('display', 'block');
                                                    $('#" . $dir . "_fields').html(response);
                                                    $('#" . $dir . "_fields .grid_fields').last().animate({
                                                            opacity:1, left: '+50', height: 'toggle'
                                                        });
                                                    $('#loading').toggle();
                                                    add_mode = false;
                                                }
                                            }); return false; }",
                    ),
                    'delete' => array(
                        'label' => 'Delete',
                        'url' => 'Yii::app()->controller->createUrl("deleteChildByAjax",array("id" => $data->primaryKey, "mName" => "' . $mName . '"))',
                    ),
                    'viewimage' => array(
                        'label' => 'View Image',
                        'url' => 'Yii::app()->controller->createUrl("viewImage",array("id" => $data->id))',
                        'imageUrl' => Yii::app()->theme->baseUrl . "/images/icons/viewimage.jpeg",
                    ),
                ),
            ),
        ),
    ));
    ?>
</div>
<div class="clear"></div>
<div id="image_area">

</div>

