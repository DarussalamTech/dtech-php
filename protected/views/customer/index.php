<?php
/* @var $this UserController */
/* @var $model User */


$user_id = Yii::app()->user->id;
//$this->layout='column2';
if (Yii::app()->user->isAdmin || Yii::app()->user->isSuperAdmin) {
    $this->renderPartial("/common/_left_single_menu");
}

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


<div class="pading-bottom-5">
    <div class="left_float">
        <h1>Manage Customers</h1>

        <?php /* Convert to Monitoring Log Buttons */ ?>
        <div class = "right_float">
            <span class="creatdate">

            </span>
        </div>
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
        'model' => $model
    ));
    ?>
</div><!-- search-form -->

<?php
$button_template = ' ';

if (isset($this->OpPermission[ucfirst($this->id) . ".Update"]) && $this->OpPermission[ucfirst($this->id) . ".Update"]) {
    $button_template.= "{enableimg} {disableimg} {enable} {disable}";
}
if (isset($this->OpPermission[ucfirst($this->id) . ".Delete"]) && $this->OpPermission[ucfirst($this->id) . ".Delete"]) {
    $button_template.= "{delete}";
}
$this->widget('DtGridView', array(
    'id' => 'user-grid',
    'dataProvider' => $model->searchCustomer(),
    'filter' => $model,
    'columns' => array(
        array(
            'name' => 'user_email',
            'type' => 'Raw',
            'value' => '$data->user_email',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            )
        ),
        array(
            'name' => 'user_name',
            'type' => 'Raw',
            'value' => '$data->user_name',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            )
        ),
        array(
            'name' => 'status_id',
            'type' => 'Raw',
            'value' => '($data->status_id==1)?$data->status->title:"Inactive"',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            )
        ),
        array(
            'name' => 'city_id',
            'type' => 'Raw',
            'value' => '!empty($data->city)?$data->city->city_name:""',
            //'value' => '$data->city_id',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            )
        ),
        /*
          'activation_key',
          'is_active',
          'site_id',
         */
        array(
            'class' => 'CLinkColumn',
            'label' => 'view',
            'urlExpression' => 'Yii::app()->createUrl("/customer/ordersList",array("id"=>$data->user_id,"country" => Yii::app()->session["country_short_name"], "city" => Yii::app()->session["city_short_name"], "city_id" => Yii::app()->session["city_id"]))',
            'header' => 'Purchase History',
            'htmlOptions' => array('style' => 'width:144px;text-align:center')
        ),
        /*
         * enalb and disable custormer by:ubd
         */
        array(
            'class' => 'CButtonColumn',
            'template' => $button_template,
            'deleteConfirmation' => 'Are You Sure? You Want to delete this profile and orders',
            'afterDelete' => 'window.location.reload()',
            'buttons' => array(
                'enable' => array(
                    'label' => '[ Disable ]',
                    'url' => 'Yii::app()->controller->createUrl("/user/toggleEnabled",array("id"=>$data->user_id))',
                    'visible' => '$data->status_id==1',
                    'click' => "function(event){
                                event.preventDefault();
                                $.ajax({
                                    url: $(this).attr('href'),
                                    success:function(msg){
                                        $('#user-grid').yiiGridView.update('user-grid');
                                    }
                                });
                                
                              }",
                ),
                'disable' => array(
                    'label' => '[ Enable ]',
                    'url' => 'Yii::app()->controller->createUrl("/user/toggleEnabled",array("id"=>$data->user_id))',
                    'visible' => '$data->status_id==2',
                    'click' => "function(event){
                                event.preventDefault();
                                $.ajax({
                                    url: $(this).attr('href'),
                                    success:function(msg){
                                        $('#user-grid').yiiGridView.update('user-grid');
                                    }
                                });
                              }",
                ),
                'enableimg' => array(
                    'label' => 'Enabled',
                    'imageUrl' => Yii::app()->request->baseUrl . '/images/enable.png',
                    'visible' => '$data->status_id==1',
                ),
                'disableimg' => array(
                    'label' => 'Disabled',
                    'imageUrl' => Yii::app()->request->baseUrl . '/images/disable.png',
                    'visible' => '$data->status_id==2',
                ),
            ),
            'htmlOptions' => array('style' => 'width:144px;text-align:center')
        ),
       
    ),
));
?>
