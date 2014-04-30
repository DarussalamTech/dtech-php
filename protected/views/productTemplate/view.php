<?php
/* @var $this ProductTemplateController */
/* @var $model ProductTemplate */

$this->breadcrumbs = array(
    'Product Templates' => array('index'),
    $model->product_id,
);

$this->renderPartial("/common/_left_menu");
?>
<div class="pading-bottom-5">
    <div class="left_float">
        <h1>View Product Template #<?php echo $model->product_name; ?></h1>
    </div>

    <?php /* Convert to Monitoring Log Buttons */ ?>
    <div class = "right_float">

    </div>
</div>
<div class="clear"></div>


<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/gridform.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/functions.js');
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        array(
            'name' => 'product_name',
            'value' => $model->product_name,
        ),
        array(
            'name' => 'universal_name',
            'value' => $model->universal_name,
            'type' => 'raw',
        ),
        array(
            'name' => 'product_overview',
            'value' => $model->product_overview,
            'type' => 'raw',
        ),
        array(
            'name' => 'product_description',
            'value' => $model->product_description,
            'type' => 'raw',
        ),
        array(
            'name' => 'parent_cateogry_id',
            'value' => !empty($model->parent_category) ? $model->parent_category->category_name : "",
        ),
        array(
            'name' => 'authors',
            'value' => implode("/", $model->getAuthors()),
            'visible' => $model->parent_category->category_name == "Books" ? true : false,
        ),
        array(
            'name' => 'is_featured',
            'value' => $model->is_featured,
            'value' => ($model->is_featured == 1) ? "Yes" : "No",
        ),
        array(
            'name' => 'status',
            'value' => $model->status,
            'value' => ($model->status == 1) ? "Active" : "No",
        ),
    ),
));

$this->renderPartial('productTemplateProfile/_container', array('model' => $model, "type" => "form"));
?>
