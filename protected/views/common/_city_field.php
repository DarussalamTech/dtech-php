<?php
/**
 * It is only for admin panel
 */

if (Yii::app()->user->getIsSuperuser() && isset($cityList)):
    ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'city_id'); ?>
        <?php echo $form->dropDownList($model, 'city_id', $cityList, array('prompt' => 'Select city')); ?>
        <?php echo $form->error($model, 'city_id'); ?>
    </div>
<?php else : ?>
    <?php echo $form->hiddenField($model, 'city_id', array("value" => $_GET['city_id'])); ?>
<?php endif; ?>

