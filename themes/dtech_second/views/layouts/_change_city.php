<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'country_selection_form',
    'action' => $this->createDTUrl('/site/index'),
    'enableClientValidation' => FALSE,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
        ));
$model = new LandingModel();
?>
<div class="countries">
    <?php
    $model->country = Yii::app()->session['country_id'];
    echo $form->dropDownList($model, 'country', CHtml::listData(Country::model()->findAll(), 'country_id', 'country_name'), array(
        'onchange' => '
                            dtech.updateElementCountry("' . $this->createDTUrl('/CommonSystem/getCity') . '","cities","LandingModel_country")',
    ));
    ?>
</div>
<div class="cities">
    <?php
    $cityList = City::model()->findAll('country_id=' . Yii::app()->session['country_id']);
    if (count($cityList) == 1) {
        echo CHtml::activeHiddenField($model, 'city', array("value" => $cityList[0]['city_id']));
    } else {
        $cityList = CHtml::listData($cityList, 'city_id', 'city_name');
        $model->city = Yii::app()->session['city_id'];
        echo CHtml::activeDropDownList($model, 'city', $cityList, array());
    }
    ?>
</div>


<?php $this->endWidget(); ?>