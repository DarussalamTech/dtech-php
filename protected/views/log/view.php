<?php
/* @var $this ProductTemplateController */
/* @var $model ProductTemplate */

$this->breadcrumbs = array(
    'Log' => array('index'),
    $model->id,
);

$this->renderPartial("/common/_left_single_menu");
?>
<div class="pading-bottom-5">
    <div class="left_float">
        <h1>View Log #<?php echo $model->id ?></h1>
    </div>

    <?php /* Convert to Monitoring Log Buttons */ ?>
    <div class = "right_float">

    </div>
</div>
<div class="clear"></div>



<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'ip',
        'browser',
        'url',
        'line',
        'file',
        'message',
        'type',
        'trace',
        'robots_txt_rule',
        'htaccess_rule',
    ),
));
?>
