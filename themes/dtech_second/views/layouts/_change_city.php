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
    /*
     *  selecting just status = 1
     * dats is enabled by user
     */
    $criteria = new CDbCriteria;
    $criteria->addCondition("t.c_status = 1");
    $model->country = Yii::app()->session['country_id'];
    echo $form->dropDownList($model, 'country', CHtml::listData(Country::model()->with(
                                                        array('cities' => array('join' => 'JOIN city ON city.country_id = t.country_id',))
                                                )->findAll($criteria), 'country_id', 'country_name'), array(
        'onchange' => '
                            dtech.updateElementCountry("' . $this->createDTUrl('/CommonSystem/getCity') . '","cities","LandingModel_country")',
    ));
    ?>
</div>
<div class="cities" id="cities">
    <?php
    $cityList = City::model()->findAll('t.c_status = 1 AND country_id=' . Yii::app()->session['country_id']);

    if (count($cityList) == 1) {
        echo CHtml::activeHiddenField($model, 'city', array("value" => $cityList[0]['city_id']));
    } else {
        $cityList = CHtml::listData($cityList, 'city_id', 'city_name');
        $model->city = Yii::app()->session['city_id'];
        echo CHtml::activeDropDownList($model, 'city', $cityList, array('onchange' => 'jQuery("#country_selection_form").submit();'));
    }
    ?>
</div>


<?php $this->endWidget(); ?>