
<?php
echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/wishlist_img_03.png"), $this->createUrl('/web/wishList/viewwishlist'));

$ip = Yii::app()->request->getUserHostAddress();
if (isset(Yii::app()->user->id)) {
    $tot = Yii::app()->db->createCommand()
            ->select('count(*) as total_pro')
            ->from('wish_list')
            ->where('city_id=' . Yii::app()->session['city_id'] . ' AND user_id=' . Yii::app()->user->user_id)
            ->queryRow();
} else {
    $tot = Yii::app()->db->createCommand()
            ->select('count(*) as total_pro')
            ->from('wish_list')
            ->where('city_id=' . Yii::app()->session['city_id'] . ' AND session_id="' . $ip . '"')
            ->queryRow();
}
$wishlistCount = ($tot['total_pro'] > 0) ? $tot['total_pro'] : 0;
?>
<div class="wishlist_counter">
    <span><?php echo $wishlistCount ?></span>
</div>