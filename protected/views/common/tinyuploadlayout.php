<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Upload an image</title>
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/packages/tinymc/js/dialog-v4.js"></script>
        <link href="<?php echo Yii::app()->baseUrl; ?>/packages/tinymc/css/dialog-v4.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'upl',
            'enableAjaxValidation' => false,
            'htmlOptions' =>
            array(
                'enctype' => 'multipart/form-data',
                'name' => 'upl',
                'onsubmit' => "jbImagesDialog.inProgress();",
                'class' => 'form-inline',
                //'action' => 'ci/index.php/upload/english',
                'target' => "upload_target"
            ),
        ));
        ?>

        <div id="upload_in_progress" class="upload_infobar">
            <img src="<?php echo Yii::app()->baseUrl; ?>/packages/tinymc/img/spinner.gif" width="16" height="16" class="spinner">Upload in progress&hellip; <div id="upload_additional_info"></div></div>
        <div id="upload_infobar" class="upload_infobar"></div>	

        <p id="upload_form_container">

            <?php
            echo $form->fileField($model, 'upload_file', array(
                "id" => "uploader",
                "class" => "jbFileBox",
                "id" => "uploader",
                'onChange' => 'document.upl.submit();jbImagesDialog.inProgress();'
                    )
            );
            ?>
        </p>

        <?php $this->endWidget(); ?>
        <iframe id="upload_target" name="upload_target" src="<? echo $this->createUrl("/commonSystem/tinyuploadtarget"); ?>"></iframe>

    </body>
</html>