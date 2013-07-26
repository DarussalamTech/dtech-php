<?php
/* @var $this CategoriesController */
/* @var $model Categories */
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/gridform.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/functions.js');

$this->breadcrumbs = array(
    'Categories' => array('index'),
    $model->category_id,
);

if (!(Yii::app()->user->isGuest)) {
    $this->renderPartial("/common/_left_menu");
}
?>



<div class="pading-bottom-5">
    <div class="left_float">
        <h1>View Categories #<?php echo $model->category_id; ?></h1>
    </div>

    <?php /* Convert to Monitoring Log Buttons */ ?>
    <div class = "right_float">
        <span class="creatdate">
            <?php
            if (isset($this->OpPermission[ucfirst($this->id) . ".Update"]) && $this->OpPermission[ucfirst($this->id) . ".Update"]) {
                $action = "update";
                if ($model->parent_id == '0') {
                    $action = "updateParent";
                }
                echo CHtml::link("Edit", $this->createUrl($action, array("id" => $model->primaryKey)), array('class' => "print_link_btn"));
            }
            ?>
        </span>
    </div>
</div>

<?php
$this->widget('ext.lyiightbox.LyiightBox2', array());
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'category_name',
        'category_image',
        'added_date',
        array(
            'label' => 'category_image',
            'type' => 'raw',
            'value' => CHtml::link($model->category_image, $model->cat_image_url,array("rel" => "lightbox[_default]")),
            'visible' => empty($model->category_image)?false:true,
        ),
    ),
));

$this->renderPartial('catlangs/_container', array('model' => $model, "type" => "form"));
?>
