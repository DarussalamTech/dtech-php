<?php
$dir = "other";
$fields_div_id = $dir . '_fields';
$heading = "Other";
$mName = "Other";

/* when page is rediretc it contains #relation name use same name to go at that child at page */
$relationName = $dir;
echo '<a name="' . $relationName . '"></a>';

$plusImage = "<div class='left_float' style='padding-top:2px'>" .
        CHtml::image(Yii::app()->theme->baseUrl . '/images/icons/plus.gif', 'bingo', array('class' => 'rotate_iamge', 'id' => $relationName . '-plus', 'class' => 'plus')) .
        "</div>";

/* Hide or show this div */
$basic_feature_div = "none";
$basic_cont_div = "none";
if (isset($_POST[$mName]) || ($this->action->id == 'create' && count($model->$relationName) > 0)) {
    $basic_feature_div = "block";
    $basic_cont_div = "block";
} else if ($this->action->id == 'view') {
    $basic_cont_div = "block";
}
?>

<div class="child-container" id ="<?php echo $dir; ?>" style="display:<?php echo $basic_cont_div ?>">
    <div class="subsection-header">
        <div class="left_float">
            <?php
            if ($this->action->id == 'view') {
                echo CHtml::link($plusImage . ' ' . $heading, 'javascript:;', array('class' => $relationName . '-buttonsc'));
            }
            else
                echo $plusImage . " " . $heading;
            ?>
        </div>
        <div class="right_float">
            <?php
            echo CHtml::link('Add New', '#', array(
                'onclick' => "
					
                    u = '" . $this->createUrl("loadChildByAjax", array("mName" => "$mName", "dir" => $dir, "load_for" => $this->action->id,)) . "&index=' +  " . $relationName . "_index_sc;
                    u+='&parent_cat='+$('#Product_parent_cateogry_id').val(); 
                    
                    add_new_child_row(u, '" . $dir . "', '" . $fields_div_id . "', 'grid_fields', true);
                    jQuery('#" . $relationName . "-plus').attr('class', 'plus_rotate');
              
                     
                    " . $relationName . "_index_sc++;
                        
                    return false;
                    ",
                "class" => "plus_bind",
                "style" => "display:none",
            ))
            ?>
        </div>
        <div class="clear"></div>
    </div>

    <?php
    $relateModelobj = new $mName;
    ?>
    <div id="<?php echo $relationName ?>-form" class="subform" style="display:<?php echo $basic_feature_div; ?>">
        <div class="main">
            <!--        <div class="head">Field Force Labors</div>-->
            <div class="form_body">
                <div class="grid_title">
                    <div class="title" style="width:200px"><?php echo CHtml::activeLabel($relateModelobj, 'price'); ?></div>
                    <div class="title" style="width:200px"><?php echo CHtml::activeLabel($relateModelobj, 'attribute'); ?></div>
                    <div class="title" style="width:200px"><?php echo CHtml::activeLabel($relateModelobj, 'attribute_value'); ?></div>


                </div>
                <div class="clear"></div>
                <?php
                /* If type is form then set form html tag */
                if ($type == "form") {
                    /* Start Form */
                    $form = $this->beginWidget('CActiveForm', array(
                        'action' => '#' . $relationName,
                        'id' => $relationName,
                        'enableAjaxValidation' => true,
                        'htmlOptions' => array('enctype' => 'multipart/form-data'),
                    ));
                }
                ?>
                <div id="<?php echo $fields_div_id; ?>" class="form">
                    <?php
                    /* for loading with js */
                    $relationName_index_sc = -1;
                    if (isset($_POST[$mName]) || ($this->action->id == 'create' && count($model->$relationName) > 0)) {
                        foreach ($model->$relationName as $key => $relationModel) {

                            $this->renderPartial($dir . '/_fields_row', array('index' => $key, 'model' => $relationModel,
                                "load_for" => $this->action->id,
                                'display' => 'block',
                                'dir' => $dir,
                                'fields_div_id' => $fields_div_id));
                            $relationName_index_sc = $key;
                        }
                    }
                    ?>

                </div>

                <?php
                /* End form */
                if ($type == "form") {
                    ?>
                    <div class="form submit-btn-div">
                        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn')); ?>
                        or
                        <?php
                        echo CHtml::link('Cancel', '#', array('onClick' => "
                                jQuery(this).parent().parent().parent().parent().parent().animate({opacity: 1, left: '+=50', height: 'toggle'}, 500,
                                    function() {
                                        jQuery('#" . $fields_div_id . "').html('');
                                    });

                                        return false;"));
                        ?>
                    </div>
                    <div class='clear'></div>
                    <?php
                    $this->endWidget();
                }
                ?>
            </div>
        </div>
    </div>
    <?php
    /* Load grid if page is open in detail view mode */
    if ($this->action->id == "view") {
        $this->renderPartial($dir . "/_grid", array('model' => $model, "dir" => $dir,));
    }

    /* Only need when new record is being created. so that's why it is in this if. */
    Yii::app()->clientScript->registerScript($relationName . '_sc_script_define', $relationName . "_index_sc =  " . $relationName_index_sc . " + 1;
                add_mode = true;", CClientScript::POS_HEAD
    );
    Yii::app()->clientScript->registerScript($relationName . '_sc_script', "
            jQuery('.$relationName-buttonsc').click(function(){
               
                jQuery('#" . $relationName . "-plus').toggleClass('plus_rotate');
                jQuery('.$relationName').animate(
                        {opacity: 'toggle', left: '+=50', height: 'toggle'}, 500, 
                        function(){}
                    );
                return false;
            });
            ");
    ?>
</div>
