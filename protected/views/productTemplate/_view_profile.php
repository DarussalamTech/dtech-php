<div class="pading-bottom-5">
    <div class="left_float">
        <h1>View Profile <?php echo $model->item_code; ?></h1>
    </div>

    <?php /* Convert to Monitoring Log Buttons */ ?>
    <div class = "right_float">
        <span class="creatdate">
            <?php
            if (isset($this->OpPermission[ucfirst($this->id) . ".Update"]) && $this->OpPermission[ucfirst($this->id) . ".Update"]) {
                echo CHtml::link("Update", $this->createUrl("update", array("id" => $model->product->product_id)), array('class' => "print_link_btn"));
            }
            ?>
        </span>
        <span class="creatdate">
            <?php
            echo CHtml::link("View", $this->createUrl("view", array("id" => $model->product->product_id)), array('class' => "print_link_btn"))
            ?>
        </span>
    </div>
</div>
<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/gridform.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/functions.js');
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        array(
            'name' => 'item_code',
            'value' => $model->item_code,
        ),
        array(
            'name' => 'title',
            'value' => $model->title,
        ),
        array(
            'name' => 'weight',
            'value' => $model->weight." ".$model->weight_unit,
        ),
        
        array(
            'name' => 'language_id',
            'value' => $model->productLanguage->language_name,
        ),
        
    ),
));


$this->renderPartial('productImages/_container', array('model' => $model, "type" => "form"));
?>