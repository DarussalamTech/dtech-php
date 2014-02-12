<?php
/* @var $this SelfSiteController */
/* @var $model SelfSite */

$this->breadcrumbs = array(
    'Self Sites' => array('index'),
    $model->site_id,
);

if (!(Yii::app()->user->isGuest)) {
    $this->renderPartial("/common/_left_menu");
}
?>


<div class="pading-bottom-5">
    <div class="left_float">
        <h1>View Self Site #<?php echo $model->site_id; ?></h1>
    </div>

    <?php /* Convert to Monitoring Log Buttons */ ?>
    <div class = "right_float">
        <span class="creatdate">
            <?php
            echo CHtml::link("Edit", $this->createUrl("update", array("id" => $model->primaryKey)), array('class' => "print_link_btn"))
            ?>
        </span>
    </div>
</div>
<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'site_name',
        'site_descriptoin',
        array(
            'name' => 'status',
            'type' => 'Raw',
            'value' => isset($model->_statuses[$model->status])?$model->_statuses[$model->status]:"",
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            )
        ),
        'fb_key',
        'fb_secret',
        'google_key',
        'google_secret',
        'twitter_key',
        'twitter_secret',
        'linkedin_key',
        'linkedin_secret',
    ),
));
?>
