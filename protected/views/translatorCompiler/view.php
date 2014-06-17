<?php
/* @var $this TranslatorCompilerController */
/* @var $model TranslatorCompiler */

$this->breadcrumbs = array(
    'Translator Compilers' => array('index'),
    $model->name,
);

if (!(Yii::app()->user->isGuest)) {
    $this->renderPartial("/common/_left_menu");
}
?>

<div class="pading-bottom-5">
    <div class="left_float">
        <h1>View <?php echo $model->type; ?> #<?php echo $model->id; ?></h1>
    </div>

    <?php /* Convert to Monitoring Log Buttons */ ?>
    <div class = "right_float">
        <span class="creatdate">
            <?php
            if (isset($this->OpPermission[ucfirst($this->id) . ".Update"]) && $this->OpPermission[ucfirst($this->id) . ".Update"]) {
                echo CHtml::link("Edit", $this->createUrl("update", array("id" => $model->primaryKey)), array('class' => "print_link_btn"));
            }
            ?>
        </span>
    </div>
</div>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'name',
        'type',
    ),
));
?>
