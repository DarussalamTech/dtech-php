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

    echo '<div class="pading-bottom-5">
    <div class="left_float">
        <h1>Create Category</h1>
    </div>

    <?php /* Convert to Monitoring Log Buttons */ ?>
    <div class = "right_float">

    </div>
</div>
<div class="clear"></div>';
    echo $this->renderPartial('_form', array('model' => $model,
        'categoriesList' => $categoriesList,
        'cityList' => $cityList));
} else {
   
    echo '<div class="pading-bottom-5">
    <div class="left_float">
        <h1>Create Parent Categories</h1>
    </div>

    <?php /* Convert to Monitoring Log Buttons */ ?>
    <div class = "right_float">

    </div>
</div>
<div class="clear"></div>';
    echo $this->renderPartial('_form_parent', array(
        'model' => $model,
        'cityList' => $cityList
    ));
}
?>