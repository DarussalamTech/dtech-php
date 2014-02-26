<?php
if (Yii::app()->user->hasFlash('status')) {
    echo CHtml::openTag("div", array("class" => "flash-success"));
    echo Yii::app()->user->getFlash("status");
    echo CHtml::closeTag("div");
}
?>
<div class="child-container" style="display:block">
    <div class="subsection-header">
        <div class="left_float">

        </div>
        Related Products 
    </div>
</div> 
<form method="post" >


    <?php
    $criteria = new CDbCriteria;
    $criteria->join.= ' LEFT  JOIN related_product '
            . 'ON t.product_id = related_product.related_product_id ' .
            'AND related_product.product_id =  ' . $model->product_id;

    $criteria->addCondition("t.product_id <>" . $model->product_id . ' AND t.parent_cateogry_id = ' . $model->parent_cateogry_id);
    $criteria->distinct = "t.product_id";


    $dataProvider = new DTActiveDataProvider('Product', array(
        'pagination' => array(
            'pageSize' => 12,
        ),
        'criteria' => $criteria,
        'sort' => array(
            'defaultOrder' => 'related_product.related_product_id DESC'
        )
    ));

    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'product-grid',
        'dataProvider' => $dataProvider,
        'pager' => array(
            'cssFile' => Yii::app()->theme->baseUrl . '/css/pager.css',
        ),
        'columns' => array(
            array(
                'name' => 'related_product.related_product_id',
                'type' => 'Raw',
                'value' => 'isset($data->related_product)?CHtml::checkBox("related_product[]", true,array("value"=>$data->product_id)):CHtml::checkBox("related_product[]", false,array("value"=>$data->product_id))',
                'headerHtmlOptions' => array(
                    'style' => "text-align:left"
                )
            ),
            array(
                'name' => 'product_name',
                'type' => 'Raw',
                'value' => '$data->product_name',
                'headerHtmlOptions' => array(
                    'style' => "text-align:left"
                )
            ),
        ),
    ));
    ?>
    <div class="right_float">
        <?php
        echo CHtml::submitButton("Save", array("class" => "btn"));
        ?>  
    </div>    
</form>