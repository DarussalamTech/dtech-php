<?php

/* @var $this CategoriesController */
/* @var $model Categories */

$this->breadcrumbs = array(
    'Categories' => array('index'),
    'Create',
);

if (!(Yii::app()->user->isGuest)) {
    $this->renderPartial("/common/_left_menu");
}
?>



<?php
/**
 * for differntitating parent and childs
 */
if ($this->action->id != "createParent") {
    echo '<h1>Create Categories</h1>';
    echo $this->renderPartial('_form', array('model' => $model,
        'categoriesList' => $categoriesList,
        'cityList' => $cityList));
} else {
    echo '<h1>Create Parent Categories</h1>';
    echo $this->renderPartial('_form_parent', array('model' => $model,
    ));
}
?>