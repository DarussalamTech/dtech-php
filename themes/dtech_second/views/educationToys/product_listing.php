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
<div class="general_content">
    <div class="under_heading">
        <h2 id="heading_filter">Education Toys</h2>
        <?php
        echo CHtml::image(Yii::app()->theme->baseUrl . "/images/under_heading_07.png") . '<br>';
        ?>
    </div>

    <div id="right_main_content">
        <?php
        $this->renderPartial("//educationToys/_product_list", array(
            "products" => $products,
            'dataProvider' => $dataProvider,
        ))
        ?>
    </div>
</div>