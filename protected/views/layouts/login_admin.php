<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/login_style.css" />
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>

    <body>
        <div class="login-container">

            <!-- =========================== Header Wrapper Start Here =========================== -->
            <div class="login-header-container"><div class="container">
                    <h1>Welcome To <span class="font-red"><?php echo strtolower(Yii::app()->name); ?></span></h1>
                </div>
            </div>

            <?php echo $content; ?>

            <!-- =========================== Footer Wrapper Start Here ============================ -->
            <div class="login-footer container">
                <p>Copyright © <?php echo date('Y'); ?> <a target="_blank" href="http://www.itstsolutions.com/">ITST Solution.</a> All Rights Reserved. <br/>.</p>
                <p>Powered by Itst.com.</p>
            </div>
            <!-- =========================== Footer Wrapper Close Here ============================ -->

        </div>
    </body>
</html>
