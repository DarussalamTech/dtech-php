<div id="book_content">
    <div id="book_main_content">
        <?php $this->renderPartial("/product/_subheader"); ?>
    </div>
</div>
<div id="wishList_container">
    <?php
        $this->renderPartial("_view_wish_lists",array("wishList"=>$wishList));
    ?>
</div>