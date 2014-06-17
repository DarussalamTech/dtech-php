
<a href="javascript:void(0)" 
   class="button logout-btn" style="margin-top: 9px;">
       <?php echo Yii::app()->user->UserDisplayName; ?>
</a>
<div style="clear:both"></div>  
<div class="logout logoutPopup">
    <div>
        <?php
        if (isset(UserProfile::model()->findByPk(Yii::app()->user->id)->avatar)) {
            echo CHtml::image(UserProfile::model()->findByPk(Yii::app()->user->id)->uploaded_img, "", array('style' => 'width:65px;height:75px;'));
        } else {
            echo CHtml::image(Yii::app()->baseUrl . "/images/noImage.png", "");
        }
        ?>
    </div>                         
   <?php
if (!Yii::app()->user->isGuest) {
    echo CHtml::link(Yii::t('header_footer', 'Logout', array(), NULL, $this->currentLang), $this->createUrl('/site/logout'), array('style' => 'color:black;font-weight:bold'));
    
    echo CHtml::link(Yii::t('header_footer', 'My Profile', array(), NULL, $this->currentLang), $this->createUrl('/web/userProfile/index', array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'])), array('style' => 'color:black;'));
    
    echo CHtml::link(Yii::t('header_footer', 'Change Password', array(), NULL, $this->currentLang), $this->createUrl('/web/user/changePass', array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'])), array('style' => 'color:black;'));
    
    
    echo CHtml::link(Yii::t('header_footer', 'Order History', array(), NULL, $this->currentLang), $this->createUrl('/web/user/customerHistory', array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'])), array('style' => 'color:black;'));
}
?>

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