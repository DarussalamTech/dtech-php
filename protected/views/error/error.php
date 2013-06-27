<!DOCTYPE html>
<html>
    <head>
        <title>Darussalam Landing Page</title>
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" />
        <script src="<?php echo Yii::app()->baseUrl; ?>/media/js/dtech.js"></script>
        <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>

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



    <?php
    /* @var $this SiteController */
    /* @var $error array */

    $this->pageTitle = Yii::app()->name . ' - Error';
    $this->breadcrumbs = array(
        'Error',
    );
    ?>





    <body>
        <div class="landing_page_wrap">
            <div id="shopping_cart" style="height:308px;text-align:left; color:gray  ">
                <div id="main_shopping_cart">
                    <div class="left_right_cart">
                        <div id="landing_banner">
                            <div class="landing_logo_part">
                                <div class="landing_logo">
                                    <?php
                                    echo Yii::app()->name;
                                    echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/landing_page_logo_img_03.png", 'Logo'), $this->createUrl('/site/storeHome'));
                                    ?>
                                </div>
                                <div class="landing_logo_right">
                                    <h1>Error <?php echo $error['code'] ?></h1>
                                    <?php
                                    echo "<b>Ooops ! No Page Found .  Invalid Request </b><br><p> Please contact ";
                                    echo $this->pageTitle = Yii::app()->name;
                                    ?>
                                    <div>
                                        <?php echo "Error" . $error['message']; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="numbers">
                                <span>15,008 Members Shopping</span>
                                <span>235,875 Active Members</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <?php echo $this->renderPartial('//site/_landing_content', array('model' => $model));
            ?>
        </div>
    </body>
</html>
