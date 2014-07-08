<?php
$relationName = "messages";
$mName="DtMessagesTranslations";
?>

<div class="<?php echo $relationName; ?> child" style="<?php echo 'display:' . (isset($_POST[$mName]) ? 'block' : 'none'); ?>">
    <?php
    
    $config = array(
        'criteria' => array(
           'condition' => 'id 	=' . $model->primaryKey,
        )
    );

    $mNameobj = new $mName;
    $mName_provider = new CActiveDataProvider($mName, $config);
    $this->widget('DtGridView', array(
        'id' => $mName.'-grid',
        'dataProvider' => $mName_provider,
        'columns' => array(
           array(
                'name' => 'language',
                'value'=>'$data->language',
                "type"=>"raw",
            ),
           array(
                'name' => 'message',
                'value'=>'$data->message',
                "type"=>"raw",
            ),
       
            array
                (
                'class' => 'CButtonColumn',
                'template' => '{update}',
                'buttons' => array
                    (
                    'update' => array
                        (
                        'label' => 'update',
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
             
                ),
            ),
        ),
    ));
    ?>
</div>
