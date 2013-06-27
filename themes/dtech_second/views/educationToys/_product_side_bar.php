<?php
/**
 *  Product side bar search
 *  here for product listing
 */
?>
<div id="left_main_content">

    <div id="category_list">
        <h2>VIEW BY CATEGORY</h2>
        <ul>
            <?php
            $url = $this->createUrl("/web/educationToys/index");
            if (Yii::app()->controller->action->id == "getSearch") {

                $url = $this->createUrl("/web/search/getSearch");
            } else if (Yii::app()->controller->action->id == "bestSellings") {

                $url = $this->createUrl("/web/product/bestSellings");
            } else if (Yii::app()->controller->action->id == "featuredProducts") {

                $url = $this->createUrl("/web/product/featuredProducts");
            }
            foreach ($allCate as $allCatego) {

                echo CHtml::openTag("li");
                echo CHtml::link($allCatego->category_name, $url, array('onclick' => '
                                            
                                                  dtech.updateProductListing("' . $url . '",$(this).attr("id"));  
                                                  
                                                return false;
                                        ', "id" => $allCatego->category_id));
                echo ' (' . $allCatego->totalStock . ')';
                echo CHtml::closeTag("/li");
            }
            if (!empty($allCate)) {
                echo CHtml::openTag("li");
                echo CHtml::link("All", $this->createUrl('/web/educationToys/index'), array('onclick' => '
                                            
                                                  dtech.updateProductListing("' . $url . '","all");  
                                                  
                                                return false;
                                        ', "id" => "all"));
                echo CHtml::closeTag("/li");
            }
            ?>
        </ul>
    </div>
</div>