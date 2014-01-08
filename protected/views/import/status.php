

<div class="pading-bottom-5">
    <div class="left_float">
        <h1>View Import #<?php echo $model->id; ?></h1>
    </div>
</div>
<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/packages/jui/css/base/jquery-ui.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/packages/jui/js/jquery-ui.min.js');

$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        array(
            'name' => 'file_name',
            'value' => $model->file_name,
            'type' => 'raw'
        ),
        array(
            'name' => 'file_path',
            'value' => $model->file_path,
            'type' => 'raw'
        ),
        array(
            'name' => 'total_steps',
            'value' => $model->total_steps,
            'type' => 'raw'
        ),
        array(
            'name' => 'completed_steps',
            'value' => $model->completed_steps,
            'type' => 'raw'
        ),
        array(
            'name' => 'Percentage Completed',
            'value' => "<span id='perc_comp_imp'>".$model->completed_steps*100/$model->total_steps."</span>",
            'type' => 'raw'
        ),
        array(
            'name' => 'sheet',
            'value' => isset($sheet[$model->sheet])?$sheet[$model->sheet]:"",
            'type' => 'raw'
        ),
        array(
            'name' => 'city',
            'value' => isset($model->city) ? $model->city->city_name : "",
            'type' => 'raw'
        )
    ),
));
?>
<div class="pading-bottom-5">
    <div class="left_float">
        <h1>Completed Status
    </div>
</div>
<div class="clear"></div>
<div id="progressbar"></div>
<script>
    jQuery(function(){
        jQuery("#progressbar").progressbar({
            value: parseFloat(jQuery("#perc_comp_imp").html())
        });
    })
</script>