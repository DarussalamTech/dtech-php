<?php
/* @var $this ProductTemplateController */
/* @var $model ProductTemplate */

$this->breadcrumbs = array(
    'Product Templates' => array('index'),
    $model->product_id,
);

$this->menu = array(
    array('label' => 'List ProductTemplate', 'url' => array('index')),
    array('label' => 'Create ProductTemplate', 'url' => array('create')),
    array('label' => 'Update ProductTemplate', 'url' => array('update', 'id' => $model->product_id)),
    array('label' => 'Delete ProductTemplate', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->product_id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage ProductTemplate', 'url' => array('admin')),
);
?>

<h1>View ProductTemplate #<?php echo $model->product_id; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        array(
            'name' => 'product_name',
            'value' => $model->product_name,
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
