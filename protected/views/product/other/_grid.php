<?php
$relationName = "other";
$mName = "Other";
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
                'name' => 'price',
                'value' => '$data->price',
                "type" => "raw",
            ),
            array(
                'name' => 'attribute',
                'value' => '$data->attribute',
                "type" => "raw",
            ),
            array(
                'name' => 'attribute_value',
                'value' => '$data->attribute_value',
                "type" => "raw",
            ),
            array
                (
                'class' => 'CButtonColumn',
                'template' => '{update} {viewimage}',
                'buttons' => array
                    (
                    'update' => array
                        (
                        'label' => 'update',
//                                'url' => 'Yii::app()->controller->createUrl("laborForm",array("id"=> $data->id, "daily_report_id"=>' . $model->id . '))',
                        'url' => 'Yii::app()->controller->createUrl(
                            "editChild", array("id"=> $data->primaryKey, 
                            "mName"=>get_class($data), 
                            "dir" => "' . $dir . '",
                            "parent_cat"=>!empty($data->product)?$data->product->parent_cateogry_id:""           
                            ))',
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
    <?php
    $this->widget('ext.lyiightbox.LyiightBox2', array(
    ));
    ?>