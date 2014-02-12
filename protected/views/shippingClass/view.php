<?php
/* @var $this ShippingClassController */
/* @var $model ShippingClass */

$this->breadcrumbs = array(
    'Shipping Classes' => array('index'),
    $model->title,
);

if (!(Yii::app()->user->isGuest)) {
    $this->renderPartial("/common/_left_menu");
}
?>


<div class="pading-bottom-5">
    <div class="left_float">
        <h1>View Shipping Class [<?php echo $model->title; ?>]</h1>
    </div>

    <?php /* Convert to Monitoring Log Buttons */ ?>
    <div class = "right_float">
        <span class="creatdate">
            <?php
            if (isset($this->OpPermission[ucfirst($this->id) . ".Update"])) {
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
        array(
            'name' => 'source_city',
            'value' => isset($model->source_city_rel) ? $model->source_city_rel->city_name : ""
        ),
        array(
            'name' => 'destination_city',
            'value' => isset($model->dest_city_rel) ? $model->dest_city_rel->city_name : "Out Of Source"
        ),
        'title',
        array(
            'name' => 'is_fix_shpping',
            'value' => ($model->is_fix_shpping == 1) ? "Enabled" : "Disabled",
            'visible' => ($model->is_fix_shpping == 1) ? true : false,
        ),
        array(
            'name' => 'fix_shipping_cost',
            'value' => $model->fix_shipping_cost,
            'visible' => ($model->is_fix_shpping == 1) ? true : false,
        ),
        array(
            'name' => 'is_pirce_range',
            'value' => ($model->is_pirce_range == 1) ? "Enabled" : "Disabled",
            'visible' => ($model->is_pirce_range == 1) ? true : false,
        ),
        array(
            'name' => 'price_range_shipping_cost',
            'value' => $model->price_range_shipping_cost,
            'visible' => ($model->is_pirce_range == 1) ? true : false,
        ),
        array(
            'name' => 'start_price',
            'value' => $model->start_price,
            'visible' => ($model->is_pirce_range == 1) ? true : false,
        ),
        array(
            'name' => 'end_price',
            'value' => $model->end_price,
            'visible' => ($model->is_pirce_range == 1) ? true : false,
        ),
        array(
            'name' => 'weight_range_shipping_cost',
            'value' => $model->weight_range_shipping_cost,
            'visible' => ($model->is_weight_based == 1) ? true : false,
        ),
        array(
            'name' => 'is_weight_based',
            'value' => ($model->is_weight_based == 1) ? "Enabled" : "Disabled",
            'visible' => ($model->is_weight_based == 1) ? true : false,
        ),
        array(
            'name' => 'min_weight_id',
            'value' => $model->min_weight_id,
            'visible' => ($model->is_weight_based == 1) ? true : false,
        ),
        array(
            'name' => 'max_weight_id',
            'value' => $model->max_weight_id,
            'visible' => ($model->is_weight_based == 1) ? true : false,
        ),
        array(
            'name' => 'categories',
            'value' => $model->getCategoriesNames(),
        ),
        array(
            'name' => 'class_status',
            'value' => ($model->class_status == 1) ? "Enabled" : "Disabled",
        ),
    ),
));
?>
