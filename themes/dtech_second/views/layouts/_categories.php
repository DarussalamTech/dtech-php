<?php
if (isset($this->menu_categories)):
    foreach ($this->menu_categories as $id => $data):
        ?>
        <div class="listing">
            <p>
                <a href="javascript:void(0)" onclick="dtech_new.aquardinaMenu(this)">
                    <?php
                    echo CHtml::image(
                            Yii::app()->theme->baseUrl . "/images/list_arrow_03.jpg", '', array(
                        "visible" => Yii::app()->theme->baseUrl . "/images/bottom_list_03.jpg",
                        "invisible" => Yii::app()->theme->baseUrl . "/images/list_arrow_03.jpg",
                        "class" => "aquardian_img",
                            )
                    );
                    echo " ";
                    echo Yii::t('common', $data['name'], array(), NULL, $this->currentLang);
                    ?>

                </a>
            </p>
            <?php
            if (isset($data['data'])):
                echo CHtml::openTag("div", array(
                    "class" => "inner_list",
                    "style" => "display:none",
                        )
                );
                foreach ($data['data'] as $cat):

                    echo "<li>";
                    $url = $this->createUrl("/web/product/category", array("slug" => $cat->slug));
                    echo CHtml::checkBox('checkbox', '', array(
                        "class" => "filter_checkbox",
                        "value" => $cat->category_id,
                        "parent_cat" => $id,
                        "onclick" => '
                                
                                  filter_val = $(this).parent().parent().siblings().children().eq(0).text();
                                  $("#list_featured h6").html(filter_val);
                                  dtech.updateProductListing("' . $url . '","' . $id . '");
                               '
                    ));
                    echo CHtml::link($cat->category_name, $url);
                    echo "</li>";
                endforeach;
                echo CHtml::closeTag("div");
            endif;
            ?>
        </div>

        <?php
    endforeach;
    ?>
    <div class="listing">
        <p>
            <a href="javascript:void(0)" onclick="dtech_new.aquardinaMenu(this)">

                <?php
                echo CHtml::image(
                        Yii::app()->theme->baseUrl . "/images/list_arrow_03.jpg", '', array(
                    "visible" => Yii::app()->theme->baseUrl . "/images/bottom_list_03.jpg",
                    "invisible" => Yii::app()->theme->baseUrl . "/images/list_arrow_03.jpg",
                    "class" => "aquardian_img",
                        )
                );
                echo " ";
                echo Yii::t('common', "Authors", array(), NULL, $this->currentLang);
                ?>

            </a>
        </p>
        <?php
        $authors = Author::model()->findAll();
        echo CHtml::openTag("div", array(
            "class" => "inner_list",
            "style" => "display:none",
                )
        );
        foreach ($authors as $author):

            echo "<li>";


            echo CHtml::checkBox('checkbox', '', array(
                "class" => "author_checkbox",
                "value" => $author->author_id,
                "parent_cat" => "",
                "onclick" => '
                                
                                  filter_val = $(this).parent().parent().siblings().children().eq(0).text();
                                  $("#list_featured h6").html(filter_val);
                                  dtech.updateProductListing("' . Yii::app()->request->url . '","");
                               '
            ));
            echo CHtml::link($author->author_name, Yii::app()->request->url);
            echo "</li>";
        endforeach;

        echo CHtml::closeTag("div");
        ?>
    </div>
    <div class="listing">
        <p>
            <a href="javascript:void(0)" onclick="dtech_new.aquardinaMenu(this)">

                <?php
                echo CHtml::image(
                        Yii::app()->theme->baseUrl . "/images/list_arrow_03.jpg", '', array(
                    "visible" => Yii::app()->theme->baseUrl . "/images/bottom_list_03.jpg",
                    "invisible" => Yii::app()->theme->baseUrl . "/images/list_arrow_03.jpg",
                    "class" => "aquardian_img",
                        )
                );
                echo " ";
                echo Yii::t('common', "Languages", array(), NULL, $this->currentLang);
                ?>

            </a>
        </p>
        <?php
        $languages = Language::model()->findAll();
        echo CHtml::openTag("div", array(
            "class" => "inner_list",
            "style" => "display:none",
                )
        );
        foreach ($languages as $lang):

            echo "<li>";


            echo CHtml::checkBox('checkbox', '', array(
                "class" => "lang_checkbox",
                "value" => $lang->language_id,
                "parent_cat" => "",
                "onclick" => '
                                
                                  filter_val = $(this).parent().parent().siblings().children().eq(0).text();
                                  $("#list_featured h6").html(filter_val);
                                  dtech.updateProductListing("' . Yii::app()->request->url . '","");
                               '
            ));
            echo CHtml::link($lang->language_name, Yii::app()->request->url);
            echo "</li>";
        endforeach;

        echo CHtml::closeTag("div");
        ?>
    </div>
    </div>
    
    <?php
endif;
?>