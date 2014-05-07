<?php
$this->breadcrumbs = array(
    'Zones' => array('index'),
    'History',
);

if (Yii::app()->user->isAdmin || Yii::app()->user->isSuperAdmin) {
    $this->renderPartial("/common/_left_menu");
}
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'zone-grid',
    'dataProvider' => $dataProvider,
    'columns' => array(
        'rate',
        'create_time'
    ),
));
?>
