<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/form.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/uploadify/uploadify.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/uploadify/jquery.uploadify.min.js');
?>
<script type="text/javascript">
<?php $timestamp = time(); ?>
    $(function() {
        $('#UserProfile_temp_avatar').uploadify({
            'formData': {
                'timestamp': '<?php echo $timestamp; ?>',
                'token': '<?php echo md5('unique_salt' . $timestamp); ?>',
                'user_Id': '<?php echo Yii::app()->user->id ?>',
                'bastPath': '<?php echo Yii::app()->basePath ?>'
            },
            'swf': '<?php echo Yii::app()->baseUrl . '/uploadify/' ?>uploadify.swf',
            'uploader': '<?php echo Yii::app()->baseUrl . '/uploadify/' ?>uploadify.php',
            'buttonImage': '<?php echo $model->uploaded_img ?>',
            'fileTypeDesc': 'Image Files',
            'fileTypeExts': '*.gif; *.jpg; *.png',
            'onSWFReady': function() {
                $('#UserProfile_temp_avatar-button').css('background-image', 'none');
                $('#UserProfile_temp_avatar-button').css('text-indent', '0');

                $('#UserProfile_temp_avatar-button').html('<img src ="<?php echo $model->uploaded_img ?>" />');
            },
            'onUploadSuccess': function(file, data, response) {
                path = '<?php echo Yii::app()->baseUrl . '/uploadify/temp/' . Yii::app()->user->id ?>/';

                $('#UserProfile_temp_avatar-button').css('background-image', 'none');
                $('#UserProfile_temp_avatar-button').css('text-indent', '0');

                $('#UserProfile_temp_avatar-button').html('<img src ="' + path + file.name + '" />');
                $('#UserProfile_avatar').val(file.name);

            }
        });
    });
</script>
<?php
$form = $this->beginWidget(
        'CActiveForm', array('id' => 'upload-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
        )
);
?>
<div class="form_container">
    <div class="row_left_form row_center_form">

        <?php
        if (Yii::app()->user->hasFlash('profie_success')) {
            echo CHtml::openTag("span", array("class" => "flash"));
            echo Yii::app()->user->getFlash('profie_success');
            echo CHtml::closeTag("span");
        }
        ?>
        <div class="shipping_address_heading">
            <h2>My Account Detail</h2>
            <div class="clear"></div>
            <article><span>*</span>Mandatory Fields</article>
        </div>

        <?php
        echo CHtml::submitButton("Save", array("class" => "row_button"))
        ?>
        <div class="row_input">
            <div class="row_text">
                <article>
                    <?php echo $form->labelEx($model, 'avatar'); ?>
                </article>
            </div>
            <div class="row_input_type">
                <?php
//                echo CHtml::image($model->uploaded_img, '', array(
//                    "width" => "80",
//                    "height" => "80",
//                    "style" => "cursor:pointer",
//                    "onclick" => "$('#UserProfile_avatar').trigger('click')",
//                ));
                ?>
                <?php echo $form->hiddenField($model, 'avatar', array("style" => "display:none")); ?>
                <?php echo $form->fileField($model, 'temp_avatar', array("style" => "display:none")); ?>
            </div>
        </div>
        <div class="row_input">
            <div class="row_text">
                <article>
                    <?php echo $form->labelEx($model, 'first_name'); ?>
                </article>
            </div>
            <div class="row_input_type">

                <?php echo $form->textField($model, 'first_name', array('class' => 'row_text_type')); ?>
            </div>
        </div>
        <div class="row_input">
            <div class="row_text">
                <article>
                    <?php echo $form->labelEx($model, 'last_name'); ?>
                </article>
            </div>
            <div class="row_input_type">
                <?php echo $form->textField($model, 'last_name', array('class' => 'row_text_type')); ?>
            </div>
        </div>
        <div class="row_input">
            <div class="row_text">
                <article>
                    <?php echo $form->labelEx($model, 'gender'); ?>
                </article>
            </div>
            <div class="row_input_type">
                <?php
                echo $form->dropDownList($model, 'gender', array('male' => 'Male', 'female' => 'Female'), $htmlOptions = array('class' => 'row_drop_down', 'options' => array('1' => array('selected' => true))));
                ?>
            </div>
        </div>
        <div class="row_input">
            <div class="row_text">
                <article>
                    <?php echo $form->labelEx($model, 'date_of_birth'); ?> 
                </article>
            </div>
            <div class="row_input_type">
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $model,
                    'attribute' => 'date_of_birth',
                    'options' => array(
                        'mode' => 'focus',
                        'dateFormat' => Yii::app()->params['dateformat'],
                        'buttonImage' => Yii::app()->baseUrl . '/images/date_picker.png',
                        'buttomImageOnly' => true,
                        'buttonText' => '',
                        'showAnim' => 'fold',
                        'showOn' => 'button',
                        'showButtonPanel' => false,
                        'showAnim' => 'slideDown',
                        'changeYear' => true,
                        'changeMonth' => true,
                        'yearRange' => '1930',
                    ),
                    'htmlOptions' => array(
                        'size' => '15', // textField size
                        //'value' => date("d F, Y"),
                        'maxlength' => '10', // textField maxlength
                        'class' => 'row_text_type', // textField maxlength
                        'readOnly' => TRUE,
                        'style' => 'width:210px',
                    ),
                ));
                ?>
            </div>
        </div>
        <div class="row_input">
            <div class="row_text">
                <article>
                    <?php echo $form->labelEx($model, 'address'); ?>
                </article>
            </div>
            <div class="row_input_type">
                <?php echo $form->textField($model, 'address', array('class' => 'row_text_type')); ?>
            </div>
        </div>
        <div class="row_input">
            <div class="row_text">
                <article>
                    <?php echo $form->labelEx($model, 'address_2'); ?>
                </article>
            </div>
            <div class="row_input_type">
                <?php echo $form->textField($model, 'address_2', array('class' => 'row_text_type')); ?>
            </div>
        </div>

        <div class="row_input">
            <div class="row_text">
                <article>
                    <?php echo $form->labelEx($model, 'country'); ?>
                </article>
            </div>
            <div class="row_input_type">
                <?php $lstData = CHtml::listData(Country::model()->findAll(), 'country_name', 'country_name') ?>
                <?php echo $form->dropDownList($model, 'country', $lstData, $htmlOptions = array('class' => 'row_drop_down')); ?>
            </div>
        </div>
        <div class="row_input">
            <div class="row_text">
                <article>
                    <?php echo $form->labelEx($model, 'city'); ?>
                </article>
            </div>
            <div class="row_input_type">
                <?php echo $form->textField($model, 'city', array('class' => 'row_text_type')); ?>
            </div>
        </div>
        <div class="row_input">
            <div class="row_text">
                <article>
                    <?php echo $form->labelEx($model, 'state_province'); ?>
                </article>
            </div>
            <div class="row_input_type">
                <?php echo $form->textField($model, 'state_province', array('class' => 'row_text_type')); ?>
            </div>
        </div>
        <div class="row_input">
            <div class="row_text">
                <article>
                    <?php echo $form->labelEx($model, 'zip_code'); ?>
                </article>
            </div>
            <div class="row_input_type">
                <?php echo $form->textField($model, 'zip_code', array('class' => 'row_text_type')); ?>
            </div>
        </div>
        <div class="row_input">
            <div class="row_text">
                <article>
                    <?php echo $form->labelEx($model, 'contact_number'); ?>
                </article>
            </div>
            <div class="row_input_type">
                <?php echo $form->textField($model, 'contact_number', array('class' => 'row_text_type')); ?>
            </div>
        </div>
        <div class="row_input">
            <div class="row_text">
                <article>
                    <?php echo $form->labelEx($model, 'mobile_number'); ?>
                </article>
            </div>
            <div class="row_input_type">
                <?php echo $form->textField($model, 'mobile_number', array('class' => 'row_text_type')); ?>
            </div>
        </div>
        <div class="row_input">
            <div class="row_text">
                <article>
                    <?php echo $form->labelEx($model, 'is_shipping_address'); ?>
                </article>
            </div>
            <div class="row_input_type">
                <?php echo $form->checkBox($model, 'is_shipping_address', array('class' => 'account_text')); ?>
            </div>
        </div>
    </div>

</div>
<?php $this->endWidget(); ?> 
<style>
    .ui-datepicker-trigger {
        width:25px;
        margin-left: 2px;
    }
    #upload-form table td.account_right {
        width: 240px;
    }
</style>