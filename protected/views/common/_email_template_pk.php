<div style="width:90%; background:#EBEBEB; padding:30px; font-family:Arial, Helvetica, sans-serif; margin:0 auto;">
    <a href="<?php echo Yii::app()->request->hostInfo . Yii::app()->baseUrl ?>" style="text-align:center; display:block;">

        <?php
        echo CHtml::image(Yii::app()->request->hostInfo . Yii::app()->baseUrl . "/images/logo/emailLogo.png", '', array('width' => '75', 'height' => '106'))
        ?>
    </a>

    <center>
        <h1 style="text-align:center; font-size:14px; color:#089AD4; 
            color:#089AD4;">Your Authentic Source of Knowledge
        </h1>
    </center>

    <h2><?php echo $email['Subject'] ?></h2>
    <p style="color:#575757; font-size:13px;">
        <?php
        echo $email['Body'];
        ?>
    </p>

    <p style="color:#575757; font-size:13px;">If we can be of any further assistance, please let us know.</p><br />
    <span style="color:#575757; font-size:13px; font-weight:bold;">Darussalam Publishers &amp; Distributors</span><br />
    
    <span style="color:#575757; font-size:13px;">Phone: +92-42-37240024, 37232400, 37111023, 37110081</span><br />
    <span style="color:#575757; font-size:13px;">Fax: +92-42-37354072</span><br />
    <span style="color:#575757; font-size:13px;">
        <a href="<?php echo Yii::app()->request->hostInfo . Yii::app()->baseUrl ?>" style="color:#39F;">
            <?php echo Yii::app()->request->hostInfo . Yii::app()->baseUrl; ?>
        </a>
    </span><br />
    <span style="color:#575757; font-size:13px;">

        <?php
        echo CHtml::link("www.facebook.com/darussalam.sns", "www.facebook.com/darussalam.sns");
        ?>
    </span>
    <br />
    <span style="color:#575757; font-size:13px;">

        <?php
        /*echo CHtml::mailto("info@darussalampk.com", "info@darussalampk.com");*/
        echo CHtml::mailto("info@darussalamublishers.com", "info@darussalamublishers.com");
        ?>
    </span>
</div>