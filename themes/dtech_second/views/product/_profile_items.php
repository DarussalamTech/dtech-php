<h4>Available in these features</h4>
<div class="clear"></div>
<?php
$config = array(
    'criteria' => array(
        'condition' => 'product_id=' . $product->product_id,
    )
);


$mName_provider = new CActiveDataProvider("ProductProfile", $config);
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'product-grid',
    'dataProvider' => $mName_provider,
    //'filter'=>false,
    'cssFile' => Yii::app()->theme->baseUrl . '/css/gridview.css',
    'columns' => array(
        array(
            'name' => 'language_id',
            'value' => '!empty($data->productLanguage)?$data->productLanguage->language_name:""',
            "type" => "raw",
        ),
        array(
            'name' => 'binding',
            'value' => '!empty($data->binding_rel)?$data->binding_rel->title:""',
            "type" => "raw",
        ),
        array(
            'name' => 'dimension',
            'value' => '!empty($data->dimension_rel)?$data->dimension_rel->title:""',
            "type" => "raw",
        ),
        array(
            'name' => 'paper',
            'value' => '!empty($data->paper_rel)?$data->paper_rel->title:""',
            "type" => "raw",
        ),
        array(
            'name' => 'printing',
            'value' => '!empty($data->printing_rel)?$data->printing_rel->title:""',
            "type" => "raw",
        ),
        array(
            'name' => 'price',
            'value' => '$data->price',
            "type" => "raw",
        ),
        array
            (
            'class' => 'CButtonColumn',
            'template' => '{view}',
            'buttons' => array
                (
                'view' => array(
                    'url' => 'Yii::app()->controller->createUrl("/web/product/productDetailLang", array("id" => '.$product->product_id.',"profile_id"=>$data->id)) ',
                    'click' => "js:function() {
                                            jQuery('#load_subpanel_div').toggle();
                                            jQuery.ajax({
                                                url: jQuery(this).attr('href'),
                                                dataType: 'json',
                                                
                                                success: function(response)
                                                {
                                                    jQuery('#load_subpanel_div').hide();
                                                    
                                                    jQuery('#img_detail').html(response['left_data']);
                                                    jQuery('#prod_detail').html(response['right_data']);
                                                }
                                            }); return false; }",
                )
            )
        ),
    ),
));
?>