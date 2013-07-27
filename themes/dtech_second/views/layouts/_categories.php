<?php
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
                echo CHtml::link($cat->category_name);
                echo "</li>";
            endforeach;

            echo CHtml::closeTag("div");

        endif;
        ?>

    </div>

    <?php
endforeach;
?>
</div>