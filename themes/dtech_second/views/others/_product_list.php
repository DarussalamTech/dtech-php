<div class="pagingdiv">
<?php
$this->widget('DTPager', array(
    'pages' => $dataProvider->pagination,
    'ajax' => true,
    'append_param' => (!empty($_REQUEST['serach_field'])) ? "serach_field=" . $_REQUEST['serach_field'] : "",
    'jsMethod' => 'dtech.updatePaginationFilter(this);return false;',
        )
);
?>
</div>
<div class="clear"></div>
<?php
foreach ($products as $product) {
    $name = $product['product_name'];

    $image = $product['no_image'];
    if (isset($product['image'][0]['image_small'])) {
        $image = $product['image'][0]['image_small'];
    }
    echo CHtml::openTag("div", array("class" => "featured_books", 'style' => 'padding:28px 50px'));

    echo CHtml::link(CHtml::image($image, $name, array('style' => 'width:92px; height:138px;margin:0 0 17px 0px; box-shadow: 0 0 5px 5px #888; padding:2px 2px')), $this->createDTUrl('', array("pid" => $product['product_id'])), array("class" => "topopup"));

    echo CHtml::openTag("h3");
    echo implode(' ', array_slice(explode(' ', $name), 0, 4));
    echo CHtml::closeTag("h3");
    echo CHtml::openTag("p");
    echo $product['product_description'];
    echo CHtml::closeTag("p");
    /*
     * 
     * temprary rendering ajax data work will be done here
     * because each product has its own data /image so with
     * ajax pass of product id will return to popup page with all data...
     */


    $this->renderPartial('//product/_popup_product', array('image' => $image));
    ?>

    <div class = "loader"></div>
    <div id = "backgroundPopup"></div>
    <?php
    echo CHtml::closeTag("div");
}

if (empty($products)) {
    echo '<center><tt>';
    echo "Sorry Your searched  did not Matched.Try again";
    echo '</tt></center>';
}
?>
<div class="clear"></div>    
<div class="pagingdiv">

    <?php
    $this->widget('DTPager', array(
        'pages' => $dataProvider->pagination,
        'ajax' => true,
        'append_param' => (!empty($_REQUEST['serach_field'])) ? "serach_field=" . $_REQUEST['serach_field'] : "",
        'jsMethod' => 'dtech.updatePaginationFilter(this);return false;',
            )
    );
    ?>  
</div>
<div class="clear"></div>  
<div class="clear"></div>  
