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
            'name' => 'language_id',
            'value' => $model->productLanguage->language_name,
        ),
        array(
            'name' => 'price',
            'value' => $model->price,
        ),
        array(
            'name' => 'discount_type',
            'value' => $model->discount_type,
        ),
        array(
            'name' => 'discount_value',
            'value' => $model->discount_value,
        ),
        array(
            'name' => 'size',
            'value' => $model->size,
        ),
        array(
            'name' => 'no_of_pages',
            'value' => $model->no_of_pages,
        ),
        array(
            'name' => 'translator_id',
            'value' => !empty($model->translator_rel) ? $model->translator_rel->name : "",
            "type" => "raw",
        ),
        array(
            'name' => 'compiler_id',
            'value' => !empty($model->compiler_rel) ? $model->compiler_rel->name : "",
            "type" => "raw",
        ),
        array(
            'name' => 'binding',
            'value' => !empty($model->binding_rel) ? $model->binding_rel->title : "",
            "type" => "raw",
        ),
        array(
            'name' => 'dimension',
            'value' => !empty($model->dimension_rel) ? $model->dimension_rel->title : "",
            "type" => "raw",
        ),
        array(
            'name' => 'paper',
            'value' => !empty($model->paper_rel) ? $model->paper_rel->title : "",
            "type" => "raw",
        ),
        array(
            'name' => 'printing',
            'value' => !empty($model->printing_rel) ? $model->printing_rel->title : "",
            "type" => "raw",
        ),
        array(
            'name' => 'edition',
            'value' => $model->edition,
            "type" => "raw",
        ),
        array(
            'name' => 'quantity',
            'value' => $model->quantity,
            "type" => "raw",
        ),
    ),
));

$this->renderPartial('productImages/_container', array('model' => $model, "type" => "form"));
?>