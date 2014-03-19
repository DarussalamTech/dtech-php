<?php
/* @var $this ZoneController */

Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/gridform.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/functions.js');



$this->breadcrumbs = array(
    'Zones' => array('index'),
    $model->name,
);

if (Yii::app()->user->isAdmin || Yii::app()->user->isSuperAdmin) {
    $this->renderPartial("/common/_left_menu");
}
?>


<div class="pading-bottom-5">
    <div class="left_float">
        <h1>View Zone #<?php echo $model->name; ?></h1>
    </div>

    <?php /* Convert to Monitoring Log Buttons */ ?>
    <div class = "right_float">
        <span class="creatdate">
            <?php
            if (isset($this->OpPermission[ucfirst($this->id) . ".View"]) && $this->OpPermission[ucfirst($this->id) . ".Update"]) {
                echo CHtml::link("Edit", $this->createUrl("update", array("id" => $model->primaryKey)), array('class' => "print_link_btn"));
            }
            ?>
        </span>
    </div>
</div>
<div class="clear"></div>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'name',
    ),
));
$this->renderPartial('countries/_container', array('model' => $model, "type" => "form"));
if (stristr(Yii::app()->session['city_short_name'], "lahore")) {

    $this->renderPartial('dhl_rates/_container', array('model' => $model, "type" => "form"));
}
?>
