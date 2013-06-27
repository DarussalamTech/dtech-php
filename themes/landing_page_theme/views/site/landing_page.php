<!DOCTYPE html>
<html>
    <head>
        <title>Darussalam Landing Page</title>
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl ?>/packages/jui/js/jquery.js"></script>
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" />
        <script src="<?php echo Yii::app()->baseUrl; ?>/media/js/dtech.js"></script>
        <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
        <link href='<?php echo Yii::app()->theme->baseUrl; ?>/images/favicon.ico' rel='icon' type='image/x-icon'/>
        <style type="text/css"> 

            .ribbon-wrapper {
                margin: 0px 0 0 20px;
                width: 100%;
                position: relative;
                z-index: 90;
            }

            .ribbon-wrapper-green {
                width: 85px;
                height: 88px;
                overflow: hidden;
                position: absolute;
                top: -3px;
                right: -3px;
            }

            .ribbon-green {
                font: bold 15px Sans-Serif;
                color: #333;
                text-align: center;
                -webkit-transform: rotate(45deg);
                -moz-transform:    rotate(45deg);
                -ms-transform:     rotate(45deg);
                -o-transform:      rotate(45deg);
                position: relative;
                padding: 7px 0;
                left: -5px;
                top: 15px;
                width: 120px;
                background-color: #e74c3c;
                background-image: -webkit-gradient(linear, left top, left bottom, from(#e74c3c), to(#e74c3c)); 
                background-image: -webkit-linear-gradient(top, #e74c3c, #e74c3c); 
                background-image:    -moz-linear-gradient(top, #e74c3c, #e74c3c); 
                background-image:     -ms-linear-gradient(top, #e74c3c, #e74c3c); 
                background-image:      -o-linear-gradient(top, #e74c3c, #e74c3c); 
                color: #FFF;
            }

            .ribbon-green:before, .ribbon-green:after {
                content: "";
                border-top:   3px solid #e74c3c;   
                border-left:  3px solid transparent;
                border-right: 3px solid transparent;
                position:absolute;
                bottom: -3px;
            }

            .ribbon-green:before {
                left: 0;
            }
            .ribbon-green:after {
                right: 0;
            }
        </style>
    </head>

    <body>
        <div class="landing_page_wrap">
            <?php
            echo $this->renderPartial('_landing_banner', array('model' => $model));
            echo $this->renderPartial('_landing_content', array('model' => $model));
            ?>
        </div>
    </body>
</html>