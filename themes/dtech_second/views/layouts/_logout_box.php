
<a href="javascript:void(0)" 
   class="button logout-btn" style="margin-top: 9px;">
       <?php echo Yii::app()->user->name ?>
</a>
<div style="clear:both"></div>  

<div class="logoutPopup" >
    <table/>
    <tr>
        <td>
            <?php
            if (isset(UserProfile::model()->findByPk(Yii::app()->user->id)->avatar)) {
                echo CHtml::image(UserProfile::model()->findByPk(Yii::app()->user->id)->uploaded_img, "", array('style' => 'width:65px;height:75px;'));
            } else {
                echo CHtml::image(Yii::app()->baseUrl . "/images/noImage.png", "");
            }
            ?>
        </td>
    </tr></table>

<?php
if (!Yii::app()->user->isGuest) {
    echo CHtml::link(Yii::t('header_footer', 'Logout', array(), NULL, $this->currentLang), $this->createUrl('/site/logout'), array('style' => 'color:black;font-weight:bold'));
    echo '<br>';
    echo CHtml::link(Yii::t('header_footer', 'My Profile', array(), NULL, $this->currentLang), $this->createUrl('/web/userProfile/index', array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'])), array('style' => 'color:black;'));
    echo '<br>';
    echo CHtml::link(Yii::t('header_footer', 'Change Password', array(), NULL, $this->currentLang), $this->createUrl('/web/user/changePass', array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'])), array('style' => 'color:black;'));
    echo '<br>';
    echo CHtml::link(Yii::t('header_footer', 'Order History', array(), NULL, $this->currentLang), $this->createUrl('/web/user/customerHistory', array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'])), array('style' => 'color:black;'));
}
?>

</div>
<style>
    .logoutPopup{
        display: none;
    }
</style>
<script>

    var mouse_is_inside_logout = false;
    jQuery(document).ready(function()
    {
        jQuery('.logout-btn').hover(function() {
            mouse_is_inside_logout = true;
            jQuery('.logoutPopup').toggle();

            if (jQuery(".logoutPopup").is(':visible') == true) {

                //dtech_new.onShowLogin();
            }
            else {
               // dtech_new.onHideLogin();
            }

        }, function() {
            mouse_is_inside_logout = false;
            //jQuery('.logoutPopup').hide();
        });

        jQuery("body").mouseup(function() {
            if (!mouse_is_inside_logout)
                jQuery('.logoutPopup').hide();
        });
    });

</script>