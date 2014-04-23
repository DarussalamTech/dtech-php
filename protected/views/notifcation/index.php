<?php
/* @var $this NotifcationController */
/* @var $model Notifcation */
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/gridview.css');
$this->breadcrumbs = array(
    'Notifcations' => array('index'),
    'List',
);



Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#notifcation-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");

?>

<div class="pading-bottom-5">
    <div class="left_float">
        <h1>Your <?php echo $model->type; ?> Notifications</h1>
    </div>

    <?php /* Convert to Monitoring Log Buttons */ ?>
    <div class = "right_float">
        <?php
        
        echo CHtml::link("Compose New", $this->createUrl("/notifcation/create"), array(
            'class' => "print_link_btn",
        ));
        ?>
        <?php
        echo ColorBox::link("Create Folder", $this->createUrl("/notifcation/createFolder"), 
                array('class' => "print_link_btn colorbox"), array("height"=>"300","width"=>"400"));
       
        ?>
    </div>
</div>
<div class='clear'></div>
<?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->PcmWidget['filter'] = array('name' => 'ItstLeftFilter',
    'attributes' => array(
        'model' => $model,
        'filters' => $this->filters,
        'keyUrl' => true,
        'action' => Yii::app()->createUrl($this->route),
        'grid_id' => 'notifcation-grid',
        ));
?>
<?php
$this->widget('DtGridView', array(
    'id' => 'notifcation-grid',
    'dataProvider' => $model->search(),
    'rowCssClassExpression' => '$data->is_read ==0?"not_read":""',
    'columns' => array(
        array(
            'header' => '<input type="checkbox" id="parent_checkbox" onclick="
                  dtech.checkUnCheckUnder(this)
             " />',
            'class' => 'CCheckBoxColumn',
            
        ),
        array(
            'name' => 'subject',
            'value' => 'CHtml::link($data->subject,Yii::app()->controller->createUrl("/notifcation/view",array("id"=>$data->id)))',
            "type" => 'raw',
        ),
        array(
            'name' => 'to',
            'value' => '$data->to',
            "visible" => $model->type == "sent" ? true : false
        ),
        array(
            'name' => 'from',
            'value' => '$data->from_rel->user_email',
            "visible" => $model->type == "inbox" ? true : false
        ),
    ),
));
?>
