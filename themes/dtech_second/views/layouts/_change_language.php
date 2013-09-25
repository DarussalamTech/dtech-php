<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'lang_change_form',
    'action' => $this->createDTUrl('/site/changeLang'),
    'enableClientValidation' => FALSE,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
        ));
?>

<a href="javascript:void(0)" 
   class="countries_img flag"

   onclick ="dtech_new.changeLang(this)"
   lang = "ar"
   >
       <?php
       echo CHtml::image(Yii::app()->theme->baseUrl . "/images/saudi_arabia_flag_03.png");
       ?>
</a>
<a href="javascript:void(0)" class="flag"
   onclick ="dtech_new.changeLang(this)"
   lang = "en"
   >

    <?php
    echo CHtml::image(Yii::app()->theme->baseUrl . "/images/USA_flag_03.png");
    ?>
</a>
<a href="javascript:void(0)" class="flag"
   onclick ="dtech_new.changeLang(this)"
   lang = "ur"
   >

    <?php
    echo CHtml::image(Yii::app()->theme->baseUrl . "/images/pak_icon.png");
    ?>
</a>
<input type="hidden" id="lang_h" name="lang_h" value="" />
<?php $this->endWidget(); ?>
