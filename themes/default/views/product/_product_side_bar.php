<?php
/**
 *  Product side bar search
 *  here for product listing
 */
?>
<div id="left_main_content">
    <div id="check_boxes">
        <h1>Languages</h1>
        <?php
        $url = $this->createUrl("/web/product/allproducts");
        if (Yii::app()->controller->action->id == "getSearch") {
            
            $url = $this->createUrl("/web/search/getSearch"
                    );
            //,array("serach_field"=>isset($_REQUEST['serach_field'])?$_REQUEST['serach_field']:""
        }
        else if (Yii::app()->controller->action->id == "bestSellings") {
            
            $url = $this->createUrl("/web/product/bestSellings");
        }
        else if (Yii::app()->controller->action->id == "featuredProducts") {
            
            $url = $this->createUrl("/web/product/featuredProducts");
        }
        $lang = new Language();
        $allLanguages = $lang->findAll();
        foreach ($allLanguages as $language) {
            ?>
            <div class="chek">
                <?php
                echo CHtml::checkBox('checkbox', '', array(
                    "class" => "filter_checkbox",
                    "value" => $language->language_id,
                    "onclick" => '
                                  dtech.updateProductListing("' .$url . '","");
                               '
                ))
                ?>
                <span>
                    <?php echo $language->language_name ?>
                </span>
            </div>
        <?php } ?>

        <h1>Author</h1>
        <?php
        $models = Author::model()->findAll();
        $lstdata = array("" => "All") + CHtml::listData($models, 'author_id', 'author_name');
        echo CHtml::dropDownList('author_id', '', $lstdata, //not in action.....
                array('options' => array('author_name' => array('selected' => true)),
            'onchange' => '
                        dtech.updateProductListing("' . $url . '","");
                        '
        ));
       
        ?>

    </div>
    <div id="category_list">
        <h2>VIEW BY CATEGORY</h2>
        <ul>
            <?php
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
                echo CHtml::link("All", $this->createUrl('/web/product/allproducts'), array('onclick' => '
                                            
                                                  dtech.updateProductListing("' . $url . '","all");  
                                                  
                                                return false;
                                        ', "id" => "all"));
                echo CHtml::closeTag("/li");
            }
            ?>
        </ul>
    </div>
</div>