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

<div id="country_container">
    <?php
    echo $form->dropDownList($model, 'country', CHtml::listData(Country::model()->findAll(), 'country_id', 'country_name'), array(
        'onchange' => '
                            dtech.updateElementCountry("' . $this->createDTUrl('/CommonSystem/getCity') . '","cities","LandingModel_country")',
        'style' => 'width:180px'
    ));
    ?>
</div>

<div id="cities">
    <?php
    $cityList = City::model()->findAll('country_id=' . Yii::app()->session['country_id']);
    if (count($cityList) == 1) {
        echo CHtml::activeHiddenField($model, 'city', array("value" => $cityList[0]['city_id']));
    } else {
        $cityList = CHtml::listData($cityList, 'city_id', 'city_name');
        echo CHtml::activeDropDownList($model, 'city', $cityList, array('style' => 'width:100px'));
    }
    ?>
</div>
<div class="country_submit">
    <?php
    echo CHtml::submitButton("Change", array("class" => "btn-submit"))
    ?>
</div>

<?php $this->endWidget(); ?>