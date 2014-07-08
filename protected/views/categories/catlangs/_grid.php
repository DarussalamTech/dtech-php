<?php
$relationName = "catlangs";
$mName="CategoriesLang";
?>

<div class="<?php echo $relationName; ?> child" style="<?php echo 'display:' . (isset($_POST[$mName]) ? 'block' : 'none'); ?>">
    <?php
    
    $config = array(
        'criteria' => array(
           'condition' => 'category_id 	=' . $model->primaryKey." AND lang_id <> '".Yii::app()->params['defaultLanguage']."'",
        )
    );
    $mNameobj = new $mName;
    $mName_provider = new CActiveDataProvider($mName, $config);
    $this->widget('DtGridView', array(
        'id' => $mName.'-grid',
        'dataProvider' => $mName_provider,
        'columns' => array(
           array(
                'name' => 'category_name',
                'value'=>'$data->category_name',
                "type"=>"raw",
            ),
           array(
                'name' => 'lang_id',
                'value'=>'$data->lang_id',
                "type"=>"raw",
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
                        'url' => 'Yii::app()->controller->createUrl("editChild", array("id"=> $data->primaryKey, "mName"=>get_class($data), "dir" => "' . $dir . '"))',
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
                        'url' => 'Yii::app()->controller->createUrl("deleteChildByAjax",array("id" => $data->primaryKey, "mName" => "'.$mName.'"))',
                    ),
                ),
            ),
        ),
    ));
    ?>
</div>
