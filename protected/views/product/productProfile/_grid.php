<?php
$relationName = "productProfile";
$mName = "ProductProfile";
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
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => $mName . '-grid',
        'dataProvider' => $mName_provider,
        'columns' => array(
            array(
                'name' => 'item_code',
                'value' => '$data->item_code',
                "type" => "raw",
            ),
            array(
                'name' => 'title',
                'value' => '$data->title',
                "type" => "raw",
            ),
            array(
                'name' => 'isbn',
                'value' => '$data->isbn',
                "type" => "raw",
            ),
            array(
                'name' => 'language_id',
                'value' => '!empty($data->productLanguage)?$data->productLanguage->language_name:""',
                "type" => "raw",
            ),
            array(
                'name' => 'translator_id',
                'value' => '!empty($data->translator_rel)?$data->translator_rel->name:""',
                "type" => "raw",
            ),
            array(
                'name' => 'compiler_id',
                'value' => '!empty($data->compiler_rel)?$data->compiler_rel->name:""',
                "type" => "raw",
            ),
            array(
                'name' => 'binding',
                'value' => '!empty($data->binding_rel)?$data->binding_rel->title:""',
                "type" => "raw",
            ),
            array(
                'name' => 'dimension',
                'value' => '!empty($data->dimension_rel)?$data->dimension_rel->title:""',
                "type" => "raw",
            ),
            array(
                'name' => 'paper',
                'value' => '!empty($data->paper_rel)?$data->paper_rel->title:""',
                "type" => "raw",
            ),
            array(
                'name' => 'printing',
                'value' => '!empty($data->printing_rel)?$data->printing_rel->title:""',
                "type" => "raw",
            ),
            array(
                'name' => 'edition',
                'value' => '$data->edition',
                "type" => "raw",
            ),
            array(
                'name' => 'no_of_pages',
                'value' => '$data->no_of_pages',
                "type" => "raw",
            ),
            array(
                'name' => 'price',
                'value' => '$data->price',
                "type" => "raw",
            ),
            array(
                'name' => 'quantity',
                'value' => '$data->quantity',
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

