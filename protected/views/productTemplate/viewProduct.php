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
        <h1>View Product  #<?php echo $model->universal_name; ?></h1>
        <div class="clear"></div>
        <h1>City = <?php echo $model->city->city_name; ?></h1>

    </div>

    <?php /* Convert to Monitoring Log Buttons */ ?>

</div>
<div class="clear"></div>


<?php
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
?>

<div class="subsection-header">
    <div class="left_float">
        <h1>View This Product Profiles</h1>
    </div>


</div>
<div class="clear"></div>
<?php
$relationName = "productProfile";
$mName = "ProductProfile";
?>

<div class=" child" >
<?php
$config = array(
    'criteria' => array(
        'condition' => 'product_id=' . $model->primaryKey,
    )
);

$mNameobj = new $mName;
$mName_provider = new CActiveDataProvider($mName, $config);
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => $mName . '-grid',
    'dataProvider' => $mName_provider,
    'columns' => array(
        array(
            'name' => 'item_code',
            'value' => '$data->item_code',
            "type" => "raw",
        ),
        array(
            'name' => 'title',
            'value' => '$data->title',
            "type" => "raw",
        ),
        array(
            'name' => 'isbn',
            'value' => '$data->isbn',
            "type" => "raw",
        ),
        array(
            'name' => 'language_id',
            'value' => '!empty($data->productLanguage)?$data->productLanguage->language_name:""',
            "type" => "raw",
        ),
        array(
            'name' => 'translator_id',
            'value' => '!empty($data->translator_rel)?$data->translator_rel->name:""',
            "type" => "raw",
        ),
        array(
            'name' => 'compiler_id',
            'value' => '!empty($data->compiler_rel)?$data->compiler_rel->name:""',
            "type" => "raw",
        ),
        array(
            'name' => 'binding',
            'value' => '!empty($data->binding_rel)?$data->binding_rel->title:""',
            "type" => "raw",
        ),
        array(
            'name' => 'dimension',
            'value' => '!empty($data->dimension_rel)?$data->dimension_rel->title:""',
            "type" => "raw",
        ),
        array(
            'name' => 'paper',
            'value' => '!empty($data->paper_rel)?$data->paper_rel->title:""',
            "type" => "raw",
        ),
        array(
            'name' => 'printing',
            'value' => '!empty($data->printing_rel)?$data->printing_rel->title:""',
            "type" => "raw",
        ),
        array(
            'name' => 'edition',
            'value' => '$data->edition',
            "type" => "raw",
        ),
        array(
            'name' => 'no_of_pages',
            'value' => '$data->no_of_pages',
            "type" => "raw",
        ),
        array(
            'name' => 'price',
            'value' => '$data->price',
            "type" => "raw",
        ),
        array(
            'name' => 'quantity',
            'value' => '$data->quantity',
            "type" => "raw",
        ),
        array(
            'name' => 'weight',
            'value' => '!empty($data->weight)?$data->weight." ".$data->weight_unit:""',
            "type" => "raw",
        ),
        array(
            'name' => 'is_shippable',
            'value' => '$data->is_shippable == 1?"Yes":"No"',
            "type" => "raw",
        ),
    ),
));
?>
</div>


