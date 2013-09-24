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

//
//    $slug_array = split('-', $_REQUEST['slug']);
//    $last_element = array_pop($slug_array);
//    $criteria = new CDbCriteria();
//    $criteria->select = "category_name";

    $category_name = Categories::model()->findByPk($last_element, $criteria)->category_name;
    echo $category_name;

    if (array_shift(split('-', $_REQUEST['slug'])) == 'Books') {
        $display = '';
    } else {
        $display = 'none';
    }
    ?>
    <div class="listing" style="display: <?php echo $display; ?>">
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
        $authors = Author::model()->findAll(array('order' => 'author_name'), 'author_id', 'author_name');
        echo CHtml::openTag("div", array(
            "class" => "inner_list",
            "id" => "author_list",
            "style" => "display:none",
                )
        );

        echo CHtml::dropDownList($authors, 'author_id', CHtml::listData($authors, 'author_id', 'author_name'), array('encode' => FALSE,
            "class" => "author_checkbox",
            "parent_cat" => "",
            "prompt" => "Select an author",
            "onChange" => "filter_val = $(this).parent().parent().siblings().children().eq(0).text();
                                  jQuery('#list_featured h6').html(filter_val);
                                  dtech.updateProductListing('','','authorDropDown');"
        ));
        /*
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
         * 
         */

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
<script type="text/javascript">
            jQuery(document).ready(function() {
                /*
                 * check if the accordian is collapse the 
                 * the authors value set to first 
                 * null value for scrolling purpose:ubd
                 */
                jQuery('.listing').click(function() {
                    if ($('#author_list').css('display') == 'none')
                    {

                        $('.author_checkbox').find('option:first').attr('selected', 'selected');
                    }
                })

            })
</script>