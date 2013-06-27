<div id="book_content">
    <div id="book_main_content">
        <?php $this->renderPartial("/product/_subheader"); ?>
    </div>
</div>
<div id="cart_container">
    <?php
        $this->renderPartial("/cart/_view_cart",array("cart"=>$cart));
    ?>
</div>