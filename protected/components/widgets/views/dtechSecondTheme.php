<?php
/**
 * 
 */
?>
<script type="text/javascript">
    dtech_new.is_filter = <?php echo $this->is_cat_filter; ?>
</script>
<a href="#" id="sideBarButton">

    <?php
    echo CHtml::image(Yii::app()->theme->baseUrl . "/images/navigation_img_02.png");
    ?>
    <em></em>
</a>
<div style="clear:both"></div>
<div id="sideBarBox">                
    <div id="sideBarForm">
        <ul class="makeMenu">
            <h1>Browse Through</h1>
            <li class="quran">
                <?php
                echo CHtml::link("Quran", $this->cObj->createUrl("/web/quran/index"));
                $quranCategories = Categories::model()->getchildrenCategory(0, "Quran", "ASC", 9);
                $count = 0;

                foreach ($quranCategories as $cat) {
                    if ($count <= 1) {
                        echo CHtml::openTag("p");
                        echo CHtml::link(
                                $cat->category_name, $this->cObj->createUrl("/web/quran/index",array("category"=>$cat->category_id)) 
                        );
                        echo CHtml::closeTag("p");
                    }
                    $count++;
                }

                echo CHtml::openTag("ul");
                echo CHtml::openTag("h2");
                echo "Quran";
                echo CHtml::closeTag("h2");

                foreach ($quranCategories as $subcat) {
                    echo CHtml::openTag("li");
                    echo CHtml::link(
                            $subcat->category_name, $this->cObj->createUrl("/web/quran/index",array("category"=>$cat->category_id))
                    );
                    echo CHtml::closeTag("li");
                }
                echo CHtml::closeTag("ul");
                ?>

            </li>
            <li>

                <?php
                echo CHtml::link("Books", $this->cObj->createUrl("/web/product/allproducts"));
                $booksCategories = Categories::model()->getchildrenCategory(0, "Books", "ASC", 9);
                $count = 0;
                foreach ($booksCategories as $cat) {
                    if ($count <= 1) {
                        echo CHtml::openTag("p");
                        echo CHtml::link(
                                $cat->category_name, $this->cObj->createUrl("/web/product/allproducts",array("category"=>$cat->category_id))
                        );
                        echo CHtml::closeTag("p");
                    }
                    $count++;
                }


                echo CHtml::openTag("ul");
                echo CHtml::openTag("h2");
                echo "Books";
                echo CHtml::closeTag("h2");

                foreach ($booksCategories as $subcat) {
                    echo CHtml::openTag("li");
                    echo CHtml::link(
                            $subcat->category_name, $this->cObj->createUrl("/web/product/allproducts",array("category"=>$cat->category_id))
                    );
                    echo CHtml::closeTag("li");
                }
                echo CHtml::closeTag("ul");
                ?>


            </li>
            <li>

                <?php
                echo CHtml::link("Educational Toys", $this->cObj->createUrl("/web/educationToys/index"));
                $eduCategories = Categories::model()->getchildrenCategory(0, "Educational Toys", "ASC", 9);
                $count = 0;
                foreach ($eduCategories as $cat) {
                    if ($count <= 1) {
                        echo CHtml::openTag("p");
                        echo CHtml::link(
                                $cat->category_name, $this->cObj->createUrl("/web/educationToys/index",array("category"=>$cat->category_id)) 
                        );
                        echo CHtml::closeTag("p");
                    }

                    $count++;
                }
                echo CHtml::openTag("ul");
                echo CHtml::openTag("h2");
                echo "Educational Toys";
                echo CHtml::closeTag("h2");

                foreach ($eduCategories as $subcat) {
                    echo CHtml::openTag("li");
                    echo CHtml::link(
                            $subcat->category_name, $this->cObj->createUrl("/web/educationToys/index",array("category"=>$cat->category_id)) 
                    );
                    echo CHtml::closeTag("li");
                }
                echo CHtml::closeTag("ul");
                ?>
            </li>
            <li>
                <?php
                echo CHtml::link("Other Items", $this->cObj->createUrl("/web/others/index"));
                $otherCategories = Categories::model()->getchildrenCategory(0, "Others", "ASC", 9);
                $count = 0;
                foreach ($otherCategories as $cat) {
                    if ($count <= 1) {
                        echo CHtml::openTag("p");
                        echo CHtml::link(
                                $cat->category_name, $this->cObj->createUrl("/web/others/index",array("category"=>$cat->category_id))
                                ); 
                        echo CHtml::closeTag("p");
                    }
                    $count++;
                }
                echo CHtml::openTag("ul");
                echo CHtml::openTag("h2");
                echo "Other Items";
                echo CHtml::closeTag("h2");

                foreach ($otherCategories as $subcat) {
                    echo CHtml::openTag("li");
                    echo CHtml::link(
                            $subcat->category_name, $this->cObj->createUrl("/web/others/index",array("category"=>$cat->category_id)) 
                    );
                    echo CHtml::closeTag("li");
                }
                echo CHtml::closeTag("ul");
                ?>
            </li>
            <li class="full_storage"><a href="#">Full Store Cateloge</a><span> > </span></li>
        </ul>
    </div>
</div>