<?php
if (empty($cart)) {
    ?>
    <div id="shopping_cart" style="height:308px;text-align:center;  ">
        <div id="main_shopping_cart">
            <div class="left_right_cart">
                You are new to this site.....Place some orders
            </div>
        </div>                                        
    </div>
    <?php
} else {


    $this->widget('ext.lyiightbox.LyiightBox2', array());

    $grand_total = 0;
    $total_quantity = 0;
    $description = '';
    foreach ($cart as $pro) {
        $total_quantity+=$pro->orderDetails->quantity;
        $description.=$pro->orderDetails->product_profile->product->product_description . ' , ';
        ?>
        <div id="customer_history">
            <div class="customer_hitory_image" id="img_detail">
                <?php
                //echo CHtml::link(CHtml::image($pro->orderDetails[0]->product_profile->productImages[0]->image_url['image_small']),array('rel'=>'lightbox[_default]'));
                //$detail_img = $pro->orderDetails[0]->product_profile->product->no_image;


                //CVarDumper::dump($pro->orderDetails[0]->product_profile->productImages[0],20,true);die;
                if (!empty($pro)) {
                    $detail_img = CHtml::image($pro->orderDetails[0]->product_profile->productImages[0]->image_url['image_large'], '');

                    echo CHtml::link($detail_img, $pro->orderDetails[0]->product_profile->productImages[0]->image_url['image_large'], array("rel" => 'lightbox[_default]',));
                } else {

                    //CVarDumper::dump($pro->orderDetails[0]->product_profile->productImages[0],20,true);die;
                    $detail_img = CHtml::image($pro->orderDetails[0]->product_profile->productImages[0]->no_image);

                    echo CHtml::link($detail_img, $pro->orderDetails[0]->product_profile->productImages[0]->no_image, array("rel" => 'lightbox[_default]',));
                }
                ?>
            </div>
            <div class="customer_hsitory_detail">
                <?php echo $pro->orderDetails[0]->product_profile->product->product_name; ?>
                <h2><?php echo $pro->orderDetails[0]->product_profile->product->product_description; ?></h2>
                Author:
                <?php
                echo!empty($pro->orderDetails[0]->product_profile->product->author->author_name) ? $pro->orderDetails[0]->product_profile->product->author->author_name : "";
                ?><br>
                Language:
                <?php
                echo!empty($pro->orderDetails[0]->product_profile->productLanguage->language_name) ? $pro->orderDetails[0]->product_profile->productLanguage->language_name : "";
                ?><br>
                Order Date:
                <?php
                echo $pro->order_date;
                ?>
                <p>
                    <span> Quantity : &nbsp; &nbsp;</span> 
                    <?php
                    echo CHtml::label($pro->orderDetails[0]->quantity, '');
                    ?>
                </p>
                <p><span>Unit Price :</span>
                    $<?php echo round($pro->orderDetails[0]->product_price, 2); ?>
                </p>

                <p>
                    <span>Sub Total :</span>
                    $<?php echo round($pro->orderDetails[0]->quantity * $pro->orderDetails[0]->product_price, 2); ?>
                </p>
            </div>
        </div>


        <?php
    }
}
?>
