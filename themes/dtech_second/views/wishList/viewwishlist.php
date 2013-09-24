<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/wishlist.css');
?>
<div id="wishList_container">
    <?php
    
    $this->renderPartial("//wishList/_view_wish_lists", array("wishList" => $wishList));
    ?>
</div>