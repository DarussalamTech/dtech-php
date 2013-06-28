<?php
/* @var $this AuthorController */
/* @var $model Author */

$this->breadcrumbs = array(
    'Authors' => array('index'),
    'Manage',
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
	$('#author-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Add  Authors</h1>

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
if(isset($this->OpPermission["Author.View"]) && $this->OpPermission["Author.View"]){
    $template.= "{view}";
}
if(isset($this->OpPermission["Author.Update"]) && $this->OpPermission["Author.Update"]){
    $template.= "{update}";
}
if(isset($this->OpPermission["Author.Delete"]) && $this->OpPermission["Author.Delete"]){
    $template.= "{delete}";
}
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'author-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        array(
            'name' => 'author_name',
            'type' => 'Raw',
            'value' => '$data->author_name',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            )
        ),
        array(
            'class' => 'CButtonColumn',
            'template'=>$template
        ),
    ),
));
?>
