<div id="book_content">
    <div id="book_main_content">
        <?php $this->renderPartial("/product/_subheader"); ?>
    </div>
</div>
<?php
?>
<div id="shopping_cart" style="height:308px;text-align:center;  ">
    <div id="main_shopping_cart">
        <div class="left_right_cart">
            Your Order successfully completed....
            <?php if (Yii::app()->user->hasFlash('orderMail')) { ?>
                <div class="flash-success" style="color:green">
                    <?php echo '<br/><tt>' . Yii::app()->user->getFlash('orderMail') . '</tt>'; ?>
                </div>
            <?php } ?>
        </div>
    </div>                                        
</div>
<?php
?>