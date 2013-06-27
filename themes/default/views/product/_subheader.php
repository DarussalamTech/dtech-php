<?php
/*
 * Sub header for pages
 * 
 */
?>
<div class="left_book_main_content">
    <a href="<?php echo $this->createUrl('/site/storehome', array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'])); ?>">
        <?php echo CHtml::image(Yii::app()->theme->baseUrl . "/images/darussalam-inner-logo.png", 'logo') ?>
    </a>
</div>
<div class="search_box">
    <form id="search_form" method="post" 
          action="<?php echo $this->createUrl("/web/search/getSearch") ?>" >
              <?php
              
              $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                  'name' => 'serach_field',
                  'source' => $this->createUrl("/web/search/dosearch"),
                  // additional javascript options for the autocomplete plugin
                  'options' => array(
                      'minLength' => '1',
                  ),
                  'htmlOptions' => array(
                      'class' => 'search_text',
                      "placeholder" => "Search keywords or image by keywords...",
                      'value'=>(isset($_POST['serach_field'])?$_POST['serach_field']:""),
                  ),
              ));
              ?>
    </form>
    <?php
    echo CHtml::button('', array("class" => "search_btn", "onclick" => "dtech.doGloblSearch()"));
    ?>
    <?php echo CHtml::image(Yii::app()->theme->baseUrl . "/images/searching_img_03.jpg", '', array("class" => "searching_img")) ?>
</div>
<nav>
    <ul>
        <?php
        echo CHtml::openTag("li");
        $require_pages = array("About Us", "Help");

        foreach ($this->webPages as $page) {
            if (in_array($page->title, $require_pages)) {

                echo CHtml::link($page->title, Yii::app()->createUrl('/web/page/viewPage/', array("id" => $page->id)));
            }
        }
        echo CHtml::link('Contact Us', $this->createUrl('/site/contact'));
        echo CHtml::closeTag("li");
        ?>
    </ul>
</nav>