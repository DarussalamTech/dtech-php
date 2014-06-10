<?php
/* mean it is called by ajax. */
if (!isset($display)) {
    $display = 'none';
}
$mName = "Other";
$relationName = "other";
?>
<div class="grid_fields" style="display:<?php echo $display; ?>">


    <div class="field" style="width:15%">
        <?php
        if ($load_for == "view") {
            echo CHtml::activeHiddenField($model, '[' . $index . ']id');
        }
        $criteria = new CDbCriteria();
        $criteria->select = "language_id";
        $criteria->condition = "LOWER(language_name) = LOWER('english') ";
        $language = Language::model()->find($criteria);



        echo CHtml::activeHiddenField($model, '[' . $index . ']language_id', array("value" => $language->language_id));
        echo CHtml::activeTextField($model, '[' . $index . ']price');
        ?>
    </div>
    <div class="field" style="width:15%">
        <?php
        echo CHtml::activeTextField($model, '[' . $index . ']quantity')
        ?>
    </div>
    <div class="field" style="width:15%">
      <?php
      
        echo CHtml::activeTextField($model, '[' . $index . ']weight',array("style"=>"width:35px"));
        echo " ";
        echo CHtml::activeDropDownList($model, '[' . $index . ']weight_unit',
                array("g"=>"g","kg"=>"kg"),array("style"=>"width:38px"));
        ?>
    </div>
    <div class="field" style="width:10%">
        <?php
 echo CHtml::activeDropDownList($model, '[' . $index . ']is_shippable', array("0" => "No", "1" => "Yes"));
        ?>
    </div>
    <div class="field" style="width:15%">
        <?php
        echo CHtml::activeTextField($model, '[' . $index . ']slag')
        ?>
    </div>
    <div class="field" style="width:15%">
        <?php
        $criteria = new CDbCriteria();
        $criteria->select = "language_id,language_name";
        $languages = Language::model()->findAll($criteria);
        echo CHtml::activeDropDownList($model, '[' . $index . ']language_id', CHtml::listData($languages, "language_id", "language_name"));
        ?>
    </div>



    <div class="del del-icon" >

    </div>

    <div class="clear"></div>
</div>
<div class="clear"></div>
