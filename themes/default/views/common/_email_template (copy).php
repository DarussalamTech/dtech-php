<div style="margin:0px; padding:0px 0px 15px 0px; background:#F7F8F7">

    <?php /* =================== Header Logo Area Start Here =================== */ ?>
    <div style="width:900px; margin:0px auto;
         font-family:Arial,Microsoft New Tai Lue, verdana, Helvetica,sans-serif;
         text-align:left;
         border-bottom: 1px solid #D2D2D2;
         border-top: 2px solid #292929;
         color:#000000;background-color:#F1F1F1;"><div style="float:left;width:130px;padding:20px 0px;"><img width="49" height="30" alt="" src="<?php echo Yii::app()->request->hostInfo . Yii::app()->baseUrl . Yii::app()->params->site_logo; ?>" /></div>
        <div style="float:left"><h1 style="font-size:21px;padding-left:5px"><?php echo Yii::app()->name ?></h1></div>
        <div style="clear:both"></div>
    </div>
    <?php /* =================== Header Logo Area Close Here =================== */ ?>


    <?php /* ===================== Content Area Start Here ===================== */ ?>
    <div style=" background:#FFFFFF; width:900px; margin:0px auto; color:#2c2c2c;border-top:1px solid #B5B5B6;
         font-family:Microsoft New Tai Lue, verdana, Helvetica,sans-serif;">

        <?php /* ===================== Welcome Text Start Here ===================== */ ?>
        <div style=" background: none repeat scroll 0 0 #FFFFFF; padding:0 15px; border-bottom:1px solid #666666;">
            <h1 style=" border: medium none;color: #DD4B39;font-size:16px;font-weight:bold;padding-bottom:0;"><?php $heading; ?></h1>  
        </div>
        <?php /* ===================== Welcome Text Close Here ===================== */ ?>


        <?php /* ====================== Thank Text Start Here ====================== */ ?>
        <?php /*  <div style="  border-bottom: 1px solid #C4C4C4;clear: both;color: #595959;font-size: 13px;
          font-weight: bold; margin-top: 15px;">
          Subject
          </div> */ ?>

        <div style="background:#fafcfd; border:1px solid #ecf0f4; padding:10px 25px; color:#7c7e80; font-size:12px;">
            <?php echo nl2br($email["Body"]); ?>
        </div>

        <?php /* ========================= Text Start Here ========================= */ ?>

        <?php /* ========================= Text Close Here ========================= */ ?>

        <?php /* ===================== Footer Area Close Here ====================== */ ?>

        <p style="background-color: #F1F1F1;
           border-bottom: 1px solid #D2D2D2;
           border-top: 1px solid #D2D2D2;
           color: #7E7E7E;
           padding: 5px;
           margin:0;
           font-size:12px;
           text-align: center;">
            Copyright (c) <?php echo date("Y"); ?> cabuy.com. All Rights Reserved.
            <br />
            Powered by Itst. 
            <img alt="" style="vertical-align: middle;height:28px" src="<?php echo Yii::app()->request->hostInfo . Yii::app()->baseUrl; ?>/images/logo2.png" />
        </p>
    </div>
    <?php /* ===================== Footer Area Close Here ====================== */ ?>

</div>
<?php /* ===================== Content Area Close Here ===================== */ ?>
</div>
