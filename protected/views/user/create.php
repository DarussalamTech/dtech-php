<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs = array(
    'Users' => array('index'),
    'Create',
);
if (!(Yii::app()->user->isGuest)) {
    $this->renderPartial("/common/_left_menu");
}
?>

<div class="pading-bottom-5">
    <div class="left_float">
        <h1>User Creation</h1>
    </div>

</div>
<div class="clear"></div>
<?php echo $this->renderPartial('_form', array('model' => $model, 'cityList' => $cityList,)); ?>