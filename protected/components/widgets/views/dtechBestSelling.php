<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<a href="javascript:void(0)" onClick="dtech_new.showBestSeller()">

    <?php
    echo CHtml::image(Yii::app()->theme->baseUrl . "/images/best_sellers_img_03.png");
    ?>
</a>
<div class="under_best_seller">

    <?php
    echo CHtml::image(Yii::app()->theme->baseUrl . "/images/crown_img_03.png", '', array("class" => "crown_img"));
    ?>
    <h1>
        <?php echo Yii::t('header_footer', 'Featured Books', array(), NULL, Yii::app()->controller->currentLang) ?>
    </h1>

    <?php
    $order_detail = new OrderDetail;
    $dataProvider = $order_detail->bestSellings(5);
    $bestSellings = $order_detail->getBestSelling($dataProvider);

//                                $this->dtdump($bestSellings);
//                                die;

    foreach ($bestSellings as $bests) {

        $pro_name = $bests['product_name'];
        $orders = $bests['totalOrder'];
        $image = $bests['no_image'];

        if (isset($bests['image'][0]['image_small'])) {
            $image = $bests['image'][0]['image_small'];
        }
        echo CHtml::openTag("div", array("class" => "quran_pen"));
        echo CHtml::openTag("div", array("class" => "quran_img"));
        echo CHtml::link(CHtml::image($image, $pro_name, array('style' => 'width:90px;height:140px')), $this->cObj->createUrl('/web/product/productDetail', array('product_id' => $bests['product_id'])), array('title' => $pro_name));
        echo CHtml::closeTag("div");
        echo CHtml::openTag("div", array("class" => "quran_text"));
        echo CHtml::openTag("h2");
        echo CHtml::link(implode(' ', array_slice(explode(' ', $pro_name), 0, 4)), $this->cObj->createUrl('/web/product/productDetail', array('product_id' => $bests['product_id'])));
        echo CHtml::closeTag("h2");
        echo CHtml::openTag("p");
        echo $bests[product_overview];
        echo CHtml::closeTag("p");
        echo CHtml::openTag("article");
        echo CHtml::image(Yii::app()->theme->baseUrl . "/images/good_stars_img_03.png");
        echo CHtml::closeTag("article");
        echo CHtml::closeTag("div");
        echo CHtml::closeTag("div");

        echo CHtml::openTag("div", array("class" => "shop_up"));



        echo CHtml::button(Yii::t('common', 'Shop Now', array(), NULL, Yii::app()->controller->currentLang), array('onclick' => '
                            window.location.href = "' . $this->cObj->createUrl('/web/product/productDetail', array('product_id' => $bests['product_id'])) . '";
                      ', 'class' => 'shop_now_arrow'));


        // echo CHtml::button('Shop Now', array('class' => 'shop_now_arrow'));
        echo CHtml::closeTag("div");
    }
    ?>



    <!--    <div class="quran_pen">
            <div class="quran_img">
    
    <?php
    //echo CHtml::image(Yii::app()->theme->baseUrl . "/images/quran_pen_img_03.png");
    ?>
            </div>
            <div class="quran_text">
                <h2>Quran Pen</h2>
                <p>Lorem ipsum color sit bla bla thhm ipoum deona eio a ea sho moxnt</p>
                <article>
    
    <?php
    // echo CHtml::image(Yii::app()->theme->baseUrl . "/images/good_stars_img_03.png");
    ?>
                    (7)
                </article>
            </div>
        </div>
        <div class="shop_up">
            <input class="shop_now_arrow" type="button" value="Shop Now >" />
        </div>-->
</div>
