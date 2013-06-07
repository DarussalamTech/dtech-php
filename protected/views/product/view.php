<?php
/* @var $this ProductController */
/* @var $model Product */
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/gridform.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/functions.js');

$this->breadcrumbs = array(
    'Products' => array('index'),
    $model->product_id,
);

if(!(Yii::app()->user->isGuest)) {
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
            echo CHtml::link("Edit", $this->createUrl("update", array("id" => $model->primaryKey)), array('class' => "print_link_btn"))
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
            'name' => 'product_description',
            'value' => $model->product_description,
            
        ),
        array(
            'name' => 'parent_cateogry_id',
            'value' => !empty($model->parent_category)?$model->parent_category->category_name:"",
            
        ),
        array(
            'name' => 'authors',
            'value' => implode("/",$model->getAuthors()),
        ),

        array(
            'name' => 'create_time',
            'value' => $model->create_time,
        ),
        array(
            'name' => 'is_featured',
            'value' => $model->is_featured,
        ),

    ),
));
/***
 * Pcm:
 * will only be use for some purposes
 * so dnt delete this line
 */
echo CHtml::hiddenField("parent_cat_id",$model->parent_cateogry_id);
/**
 * to handle parent cateogry flow
 */
if($model->parent_category->category_name == "Others"){
    $this->renderPartial('other/_container', array('model' => $model, "type" => "form"));
}
else if($model->parent_category->category_name == "Books") {
     $this->renderPartial('productProfile/_container', array('model' => $model, "type" => "form"));
}
else if($model->parent_category->category_name == "Quran") {
     $this->renderPartial('quranProfile/_container', array('model' => $model, "type" => "form"));
}
else if($model->parent_category->category_name == "Educational Toys") {
     $this->renderPartial('educationToys/_container', array('model' => $model, "type" => "form"));
}
$this->renderPartial('productCategories/_container', array('model' => $model, "type" => "form"));
//$this->renderPartial('productImages/_container', array('model' => $model, "type" => "form"));
?>
