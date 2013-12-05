<?php
/* @var $this ProductController */
/* @var $model Product */
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/gridform.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/functions.js');




$this->breadcrumbs = array(
    'Products' => array('index'),
    $model->product_id,
);

if (!(Yii::app()->user->isGuest)) {
    $this->renderPartial("/common/_left_menu");
}
?>


<div class="pading-bottom-5">
    <div class="left_float">
        <h1>View Product #<?php echo $model->product_id; ?></h1>
    </div>

    <?php /* Convert to Monitoring Log Buttons */ ?>
    <div class = "right_float">
        <span class="creatdate">
            <?php
            if (isset($this->OpPermission[ucfirst($this->id) . ".Update"]) && $this->OpPermission[ucfirst($this->id) . ".Update"]) {
                echo CHtml::link("Select Shippable Countries", $this->createUrl("update", array("id" => $model->primaryKey,"shipingcountry"=>"countries")), array('class' => "print_link_btn"));
                echo CHtml::link("Edit", $this->createUrl("update", array("id" => $model->primaryKey)), array('class' => "print_link_btn"));
                echo CHtml::link("Language Translation", $this->createUrl("/product/language", array("id" => $model->primaryKey)), array('class' => "print_link_btn"));
            }
            $controller = array(
                "Others" => "others",
                "Books" => "product",
                "Quran" => "quran",
                "Educational Toys" => "educationToys",
            );

            echo CHtml::link("Preview", $this->createUrl("/web/product/productPreview", array("product_id" => $model->primaryKey)), array(
                'class' => "print_link_btn",
                "onclick" => "dtech.popupwindow(jQuery(this).attr('href'),'Preview','900','600');return false;"
            ));
            ?>
        </span>
    </div>
</div>
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
            'name' => 'create_time',
            'value' => $model->create_time,
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
        array(
            'name' => 'shippable_countries',
            'value' => zHtml::showComaSeperatedData($model->shippable_countries),
            "type"=>"raw",
        ),
    ),
));
/* * *
 * Pcm:
 * will only be use for some purposes
 * so dnt delete this line
 */
echo CHtml::hiddenField("parent_cat_id", $model->parent_cateogry_id);

/**
 * to handle parent cateogry flow
 */
if ($model->parent_category->category_name == "Others") {
    $this->renderPartial('other/_container', array('model' => $model, "type" => "form"));
} else if ($model->parent_category->category_name == "Books") {
    $this->renderPartial('productProfile/_container', array('model' => $model, "type" => "form"));
} else if ($model->parent_category->category_name == "Quran") {
    $this->renderPartial('quranProfile/_container', array('model' => $model, "type" => "form"));
} else {
    $this->renderPartial('other/_container', array('model' => $model, "type" => "form"));
}
$this->renderPartial('productCategories/_container', array('model' => $model, "type" => "form"));
$this->renderPartial('discount/_container', array('model' => $model, "type" => "form"));
?>
