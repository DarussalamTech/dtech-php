<div id="book_content">
    <div id="book_main_content">
        <?php $this->renderPartial("/product/_subheader"); ?>

        <?php
        if (Yii::app()->controller->action->id != "getSearch") {
            $this->renderPartial("/product/_product_side_bar", array("allCate" => $allCate));
        }
        else {
            echo CHtml::openTag("div");
                //echo "Search Result against this keyword > ";
                //echo (isset($_POST['serach_field'])?$_POST['serach_field']:"");
            echo CHtml::closeTag("div");
            
            $this->renderPartial("/product/_product_side_bar", array("allCate" => $allCate));
            
        }
        ?>
        <div id="right_main_content">
            <?php $this->renderPartial("/product/_product_list", 
                    array(
                        "products" => $products,
                        'dataProvider'=>$dataProvider,
                    )) ?>
        </div>
    </div>
</div>