<?php
/* @var $this TranslatorCompilerController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Translator Compilers',
);

if(!(Yii::app()->user->isGuest)) {
        $this->renderPartial("/common/_left_menu");
}


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#translator-compiler-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Translator Compilers</h1>

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
if(isset($this->OpPermission[ucfirst($this->id).".View"]) && $this->OpPermission[ucfirst($this->id).".View"]){
    $template.= "{view}";
}
if(isset($this->OpPermission[ucfirst($this->id).".Update"]) && $this->OpPermission[ucfirst($this->id).".Update"]){
    $template.= "{update}";
}
if(isset($this->OpPermission[ucfirst($this->id).".Delete"]) && $this->OpPermission[ucfirst($this->id).".Delete"]){
    $template.= "{delete}";
}

$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $model->search(),
    'id' => 'translator-compiler-grid',
    'filter' => $model,
    'columns' => array(
        array(
            'name' => 'name',
            'type' => 'Raw',
            'value' => '$data->name',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            )
        ),
        array(
            'name' => 'type',
            'type' => 'Raw',
            'value' => '$data->type',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            )
        ),
        array(
            'class' => 'CButtonColumn',
            'template'=>$template
        ),
    )
));
?>
