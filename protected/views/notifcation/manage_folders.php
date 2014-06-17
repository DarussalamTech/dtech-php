<?php
/* @var $this NotifcationController */
/* @var $model Notifcation */
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/gridview.css');

$this->breadcrumbs = array(
    'Manage Folders' => array('index'),
    'List',
);
?>

<div class="pading-bottom-5">
    <div class="left_float">
        <h1>Manage Your Folders</h1>
    </div>

    <?php /* Convert to Monitoring Log Buttons */ ?>
    <div class = "right_float">
        <?php
        echo CHtml::link("Compose New", $this->createUrl("/notifcation/create"), array(
            'class' => "print_link_btn",
        ));
        ?>
        <?php
        echo ColorBox::link("Create Folder", $this->createUrl("/notifcation/createFolder"), array('class' => "print_link_btn colorbox"), array("height" => "300", "width" => "400"));
        ColorBox::generate("update", array("height" => "300", "width" => "400"));
        ?>
    </div>
</div>
<div class='clear'></div>
<?php
$template = "{delete} {update}";
$this->widget('DtGridView', array(
    'id' => 'notifcation-folder-grid',
    'dataProvider' => $model->search(),
    'columns' => array(
        array(
            'name' => 'name',
            'value' => '$data->name',
            "type" => 'raw',
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => $template,
            'buttons' => array(
                'delete' => array(
                    'label' => 'Delete',
                    'url' => 'Yii::app()->controller->createUrl("deleteFolder",array("id" => $data->primaryKey))',
                ),
                'update' => array(
                    'label' => 'Update',
                    'url' => 'Yii::app()->controller->createUrl("createFolder",array("id" => $data->primaryKey))',
                    
                ),
            ),
            'htmlOptions' => array('style' => 'width:144px;')
        )
    ),
));
?>
