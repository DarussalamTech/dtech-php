<?php
/* @var $this ProductController */
/* @var $model Product */

$this->breadcrumbs = array(
    'Products' => array('index'),
    'Manage',
);

$this->renderPartial("/common/_left_menu");

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#product-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");

$this->PcmWidget['filter'] = array('name' => 'ItstLeftFilter',
    'attributes' => array(
        'model' => $model,
        'filters' => $this->filters,
        'keyUrl' => true,
        'action' => Yii::app()->createUrl($this->route),
        'grid_id' => 'product-grid',
        ));
?>


<div class="pading-bottom-5">
    <div class="left_float">
        <h1>Manage Products</h1>
    </div>

    <?php /* Convert to Monitoring Log Buttons */ ?>
    <div class = "right_float">

    </div>
</div>
<div class="clear"></div>
<?php
if (Yii::app()->user->hasFlash('success')) {
    echo CHtml::openTag("div", array("class" => "flash-success"));
    echo Yii::app()->user->getFlash("success");
    echo CHtml::closeTag("div");
}
echo '<div class="clear"></div>';
if (Yii::app()->user->hasFlash('errorIntegrity')) {
    echo CHtml::openTag("div", array("class" => "flash-error"));
    echo Yii::app()->user->getFlash("errorIntegrity");
    echo CHtml::closeTag("div");
}
echo '<div class="clear"></div>';

?>
<p>
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$template = "";
if (isset($this->OpPermission[ucfirst($this->id) . ".Update"]) && $this->OpPermission[ucfirst($this->id) . ".Update"]) {
    $template.= "{enableimg} {disableimg} {enable} {disable} &nbsp;&nbsp;&nbsp; ";
}
if (isset($this->OpPermission[ucfirst($this->id) . ".View"]) && $this->OpPermission[ucfirst($this->id) . ".View"]) {
    $template.= "{view}";
}
if (isset($this->OpPermission[ucfirst($this->id) . ".Update"]) && $this->OpPermission[ucfirst($this->id) . ".Update"]) {
    $template.= "{update} ";
}

if (isset($this->OpPermission[ucfirst($this->id) . ".Delete"]) && $this->OpPermission[ucfirst($this->id) . ".Delete"]) {
    $template.= "{delete}";
}
$this->widget('DtGridView', array(
    'id' => 'product-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'pager' => array(
        'cssFile' => Yii::app()->theme->baseUrl . '/css/pager.css',
    ),
    'columns' => array(
        array(
            'name' => 'product_name',
            'type' => 'Raw',
            'value' => '$data->product_name',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            )
        ),
        array(
            'name' => 'universal_name',
            'type' => 'Raw',
            'value' => '$data->universal_name',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            )
        ),
        array(
            'name' => 'product_overview',
            'type' => 'Raw',
            'value' => '$data->product_overview',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            )
        ),
        array(
            'name' => 'parent_cateogry_id',
            'value' => '!empty($data->parent_category)?$data->parent_category->category_name:""',
        ),
        array(
            'header' => 'City',
            'type' => 'Raw',
            'value' => '!empty($data->city)?$data->city->city_name:""',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            )
        ),
        array(
            'name' => 'is_featured',
            'type' => 'Raw',
            'value' => '($data->is_featured==1)?"Yes":"No"',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            )
        ),
        array(
            'name' => 'status',
            'type' => 'Raw',
            'value' => '($data->status==1)?"Active":"Disabled"',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            )
        ),
        array(
            'name' => 'create_time',
            'type' => 'Raw',
            'value' => '$data->create_time',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            )
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => $template,
            'deleteConfirmation' => 'Are You Sure? You Want to delete this Product,its images and profile',
            'afterDelete' => 'window.location.reload()',
            'buttons' => array(
                'enable' => array(
                    'label' => '[ Disable ]',
                    'url' => 'Yii::app()->controller->createUrl("/product/toggleEnabled",array("id"=>$data->product_id))',
                    'visible' => '$data->status==1',
                    'click' => "function(event){
                                event.preventDefault();
                                $.ajax({
                                    url: $(this).attr('href'),
                                    success:function(msg){
                                        $('#product-grid').yiiGridView.update('product-grid');
                                    }
                                });
                                
                              }",
                ),
                'disable' => array(
                    'label' => '[ Enable ]',
                    'url' => 'Yii::app()->controller->createUrl("/product/toggleEnabled",array("id"=>$data->product_id))',
                    'visible' => '$data->status==0',
                    'click' => "function(event){
                                event.preventDefault();
                                $.ajax({
                                    url: $(this).attr('href'),
                                    success:function(msg){
                                        $('#product-grid').yiiGridView.update('product-grid');
                                    }
                                });
                              }",
                ),
                'enableimg' => array(
                    'label' => 'Enabled',
                    'imageUrl' => Yii::app()->request->baseUrl . '/images/enable.png',
                    'visible' => '$data->status==1',
                ),
                'disableimg' => array(
                    'label' => 'Disabled',
                    'imageUrl' => Yii::app()->request->baseUrl . '/images/disable.png',
                    'visible' => '$data->status==0',
                ),
            ),
            'htmlOptions' => array('style' => 'width:144px;')
        ),
    ),
));
?>