<?php
$relationName = "productTemplateProfile";
$mName = "ProductTemplateProfile";
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
    
    $btn_template = "";
    if($this->checkViewAccess(ucfirst($this->id) . ".EditChild")){
        $btn_template.="{update}";
    }
    if($this->checkViewAccess(ucfirst($this->id) . ".ViewImage")){
        $btn_template.="{viewimage}";
    }
    $this->widget('DtGridView', array(
        'id' => $mName . '-grid',
        'dataProvider' => $mName_provider,
        'columns' => array(
            array(
                'name' => 'title',
                'value' => '$data->title',
                "type" => "raw",
            ),
            array(
                'name' => 'weight',
                'value' => '!empty($data->weight)?$data->weight." ".$data->weight_unit:""',
                "type" => "raw",
            ),
            array(
                'name' => 'language_id',
                'value' => '!empty($data->productLanguage)?$data->productLanguage->language_name:""',
                "type" => "raw",
            ),
            array
                (
                'class' => 'CButtonColumn',
                'template' => $btn_template,
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
                        'imageUrl' => Yii::app()->theme->baseUrl . "/images/icons/view.png",
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