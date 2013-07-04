<?php
$this->webPcmWidget['filter'] = array('name' => 'DtechSecondSidebar',
    'attributes' => array(
        'cObj' => $this,
        'cssFile' => Yii::app()->theme->baseUrl . "/css/side_bar.css",
        'is_cat_filter' => 1,
        ));
?>
<?php
$this->webPcmWidget['best'] = array('name' => 'DtechBestSelling',
    'attributes' => array(
        'cObj' => $this,
        'cssFile' => Yii::app()->theme->baseUrl . "/css/side_bar.css",
        'is_cat_filter' => 0,
        ));
?>
<div class="books_content">

    <?php
    echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/quran_bw.png", '', array(
                "hover_img" => Yii::app()->theme->baseUrl . "/images/quran.png",
                "unhover_img" => Yii::app()->theme->baseUrl . "/images/quran_bw.png"
            )), $this->createUrl('/web/quran/index'));
    ?>


    <h1>Quran</h1>
    <p>Darussalam has stock of Holy Quran with it's tafseer written by Scholars</p>

    <?php
    echo CHtml::button("Shop Now", array(
        "class" => "shop_now_arrow",
        "onclick" => "window.location ='" . $this->createUrl('/web/quran/index') . "'"
    ));
    ?>
</div>
<div class="books_content">
    <?php
    echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/books_bw.png", '', array(
                "hover_img" => Yii::app()->theme->baseUrl . "/images/books.png",
                "unhover_img" => Yii::app()->theme->baseUrl . "/images/books_bw.png"
            )), $this->createUrl('/web/product/allproducts'));
    ?>
    <h1>Books</h1>
    <p>Darussalam is Global Islamic Books Publishers and Distributors</p>

    <?php
    echo CHtml::button("Shop Now", array(
        "class" => "shop_now_arrow",
        "onclick" => "window.location ='" . $this->createUrl('/web/product/allproducts') . "'"
    ));
    ?>
</div>
<div class="books_content">

    <?php
    echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/toys_bw.png", '', array(
                "hover_img" => Yii::app()->theme->baseUrl . "/images/toys.png",
                "unhover_img" => Yii::app()->theme->baseUrl . "/images/toys_bw.png"
            )), $this->createUrl('/web/educationToys/index'));
    ?>
    <h1>Educational Toys</h1>
    <p>Darussalam also provides Eductaional toys for Children promoting islamic soul in them</p>

    <?php
    echo CHtml::button("Shop Now", array(
        "class" => "shop_now_arrow",
        "onclick" => "window.location ='" . $this->createUrl('/web/educationToys/index') . "'"
    ));
    ?>
</div>
<div class="books_content">
    <?php
    echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/other_bw.png", '', array(
                "hover_img" => Yii::app()->theme->baseUrl . "/images/other.png",
                "unhover_img" => Yii::app()->theme->baseUrl . "/images/other_bw.png"
            )), $this->createUrl('/web/others/index'));
    ?>
    <h1>Other Products</h1>
    <p>In other products of Darussalam there are Electronic pen, quran, DVD and many more</p>

    <?php
    echo CHtml::button("Shop Now", array(
        "class" => "shop_now_arrow",
        "onclick" => "window.location ='" . $this->createUrl('/web/others/index') . "'"
    ));
    ?>
</div>
<?php
$this->renderPartial("//product/_featured_products", array('featured_products' => $featured_products,
    'best_sellings' => $bestSellings,
    'segments_footer_cats' => $segments_footer_cats,
    'dataProvider' => $dataProvider,
));
?>
<div class="under_content">
    <div class="left_under_content">
        <h4>Create An Account</h4>
        <p>You will Get A</p>
        <h5>$20 Discount</h5>
        <article>With a $100 or more purchase</article>
        <input type="button" value="Create Now  >" class="shop_now_arrow" />
    </div>
    <div class="middle_under_content">
        <p>Wondering what to give to your friends, Parents, wife, childern !</p>
        <h5>Its the Book</h5>
    </div>
    <div class="right_under_content">
        <h5>Bookshelf Favorites</h5>
        <h6>Save <span>up to</span> 50%</h6>
        <article>on Selected Books</article>
        <p>>Learn more</p>
    </div>
</div>
</div>