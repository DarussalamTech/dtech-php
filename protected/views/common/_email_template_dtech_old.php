

<div id="wraper" style="width:536px; padding: 0; margin: 0 auto; background:#f3f3f3; font-family:Arial, Helvetica, sans-serif;">
    
        <?php echo CHtml::image(Yii::app()->request->hostInfo.Yii::app()->theme->baseUrl . '/images/banner_img_02.jpg'); ?>
        <div id="main_header">
            <h1><?php echo $email['Subject'] ?></h1>
            <p>
                <?php
                 echo $email['Body'];
                ?>
            </p>
            
        </div>
 
  
   
            <ul>
                <li style="display:inline"><a href="#" >About Us</a></li>
                <li style="display:inline"<a href="#" style="display:inline">Contact Us</a></li>
                <li style="display:inline"><a href="#" style="display:inline">Careers</a></li>
                <li style="display:inline"><a href="#" style="display:inline">FAQ's</a></li>
                <li style="display:inline"><a href="#" style="display:inline">Terms &amp; Conditions</a></li>
                <li style="display:inline"><a href="#" style="display:inline">Shipping Rates &amp; Policies</a></li>
            </ul>
  
        <div class="right_footer">
            <table>
                <tr class="footer_tr">
                    <td class="left_td" style="width:25px; padding: 0; margin: 0; line-height:17px;">
                        <?php echo CHtml::image(Yii::app()->theme->baseUrl . '/images/phone_img_03.jpg'); ?>
                    </td>
                    <td class="right_td" style="width:255px; padding: 0; margin: 0; color:#888888; font-size:12px; line-height:17px;">+(92) 42 35254654 - 54</td>
                </tr>
                <tr class="footer_tr">
                    <td class="left_td" style="width:25px; padding: 0; margin: 0; line-height:17px;">
                        <?php echo CHtml::image(Yii::app()->theme->baseUrl . '/images/email_img_03.jpg'); ?>
                    </td>
                    <td class="right_td" style="width:255px; padding: 0; margin: 0; color:#888888; font-size:12px; line-height:17px;">support@darussalam.com</td>
                </tr>
                <tr class="footer_tr">
                    <td class="left_td" style="width:25px; padding: 0; margin: 0; line-height:17px;">
                        <?php echo CHtml::image(Yii::app()->theme->baseUrl . '/images/home_img_03.jpg'); ?>
                    </td>
                    <td class="right_td" style="width:255px; padding: 0; margin: 0; color:#888888; font-size:12px; line-height:17px;">Darussalam Publishers</td>
                </tr>
                <tr class="footer_tr">
                    <td class="left_td" style="width:25px; padding: 0; margin: 0; line-height:17px;"></td>
                    <td class="righ_td" style="width:255px; padding: 0; margin: 0; color:#888888; font-size:12px; line-height:17px;">is a multilingual international Islamic publishing house, with headquarters in Riyadh, Kingdom of Saudi Arabia.</td>
                </tr>
            </table>
        </div>
   
</div>

