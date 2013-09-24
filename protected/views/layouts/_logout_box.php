<h1>
    <a href="javascript:void(0)" 
       class="button logout-btn" style="margin-top: -7px;">
           <?php echo Yii::app()->user->name ?>
    </a>
</h1>

<div class="logoutPopup" >
    <table/>
    <tr>
        <td>
            <?php
            if (isset(UserProfile::model()->findByPk(Yii::app()->user->id)->avatar)) {
                echo CHtml::image(UserProfile::model()->findByPk(Yii::app()->user->id)->uploaded_img, "",array('style'=>'width:65px;height:75px;'));
            } else {
                echo CHtml::image(Yii::app()->theme->baseUrl . "/images/talha_mujahid_img_03.png", "");
            }
            ?>
        </td>
    </tr></table>
<?php
if (!Yii::app()->user->isGuest) {
    echo CHtml::link('Logout', $this->createUrl('/site/logout'));
    echo '<br>';
    echo CHtml::link('My Account', $this->createUrl('/web/userProfile', array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'])));
    echo '<br>';
    echo CHtml::link('Change Password', $this->createUrl('/web/user/changePass', array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'])));
    echo '<br>';
    echo CHtml::link('Order History', $this->createUrl('/web/user/customerHistory', array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'])));
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
            jQuery('.logoutPopup').show();
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