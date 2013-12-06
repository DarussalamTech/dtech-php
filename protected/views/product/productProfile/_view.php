<div class="pading-bottom-5">
    <div class="left_float">
        <h1>View Profile <?php echo $model->item_code; ?></h1>
    </div>

    <?php /* Convert to Monitoring Log Buttons */ ?>
    <div class = "right_float">
        <span class="creatdate">
            <?php
            if (isset($this->OpPermission[ucfirst($this->id) . ".Update"]) && $this->OpPermission[ucfirst($this->id) . ".Update"]) {
                echo CHtml::link("Update Book", $this->createUrl("update", array("id" => $model->product->product_id)), array('class' => "print_link_btn"));

                echo CHtml::link("Update Translations", $this->createUrl("/product/profileLanguage", array("id" => $model->id)), array('class' => "print_link_btn"));
            }
            ?>
        </span>
        <span class="creatdate">
            <?php
            echo CHtml::link("View Book", $this->createUrl("view", array("id" => $model->product->product_id)), array('class' => "print_link_btn"))
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
            'name' => 'isbn',
            'value' => $model->isbn,
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
        array(
            'name' => 'weight',
            'value' => isset($model->weight_rel) ? $model->weight_rel->title : "",
            "type" => "raw",
        ),
        array(
            'name' => 'is_shippable',
            'value' => $model->is_shippable == 1?"Yes":"No",
            "type" => "raw",
        ),
    ),
));

$this->renderPartial('productAttributes/_container', array('model' => $model, "type" => "form"));
$this->renderPartial("productAttributes/_grid", array("id" => $model->id, "dir" => "productAttributes"));
$this->renderPartial('productImages/_container', array('model' => $model, "type" => "form"));
?>