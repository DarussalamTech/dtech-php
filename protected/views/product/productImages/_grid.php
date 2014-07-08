<?php
$relationName = "productImages";
$mName = "ProductImage";
$this->renderPartial("productProfile/_view", array("model" => $model));

?>
<div class="<?php echo $relationName; ?> child" style="<?php echo 'display:block'; ?>">
    <?php
    $config = array(
        'criteria' => array(
            'condition' => 'product_profile_id=' . $id,
        )
    );
    $mNameobj = new $mName;
    $mName_provider = new CActiveDataProvider($mName, $config);
    $this->widget('DtGridView', array(
        'id' => $mName . '-grid',
        'dataProvider' => $mName_provider,
        'columns' => array(
            array(
                'name' => 'image_small',
                'value' => 'CHtml::link($data->image_small,$data->image_url["image_large"],array("rel" => "lightbox[_default]"))',
                "type" => "raw",
            ),
            array(
                'name' => 'image_large',
                'value' => '$data->image_large'
            ),
            array(
                'name' => 'is_default',
                'value' => '($data->is_default==1)?"Yes":"No"'
            ),
            array
                (
                'class' => 'CButtonColumn',
                'template' => '{update} {delete}',
                'buttons' => array
                    (
                    'update' => array
                        (
                        'label' => 'update',
//                                'url' => 'Yii::app()->controller->createUrl("laborForm",array("id"=> $data->id, "daily_report_id"=>' . $model->id . '))',
                        'url' => 'Yii::app()->controller->createUrl("editChild", array("id"=> $data->id, "mName"=>get_class($data), "dir" => "' . $dir . '"))',
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
                        'url' => 'Yii::app()->controller->createUrl("deleteChildByAjax",array("id" => $data->id, "mName" => "' . $mName . '"))',
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