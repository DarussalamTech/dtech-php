<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

<div id="banner">
    <div id="main_banner">
        <div id="left_banner">
            <?php
            echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . '/images/darussalam-inner-logo.png','logo'), $this->createDTUrl('/site/index'));
            ?>
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
            <div class="txt">
                <form id="search_form" method="post" 
                      action="<?php echo $this->createUrl("/web/search/getSearch") ?>" >
                    <div class="txt2">
                        <div class="search_img">
                            <a href="javascript:void(0)" onclick="dtech.doGloblSearch()"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/search_img_03.jpg" alt="search img" /></a>
                        </div>

                        <?php
                        $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                            'name' => 'serach_field',
                            'source' => $this->createUrl("/web/search/dosearch"),
                            // additional javascript options for the autocomplete plugin
                            'options' => array(
                                'minLength' => '1',
                            ),
                            'htmlOptions' => array(
                                'class' => 'txt_bar',
                                'value' => (isset($_POST['serach_field']) ? $_POST['serach_field'] : ""),
                            ),
                        ));
                        ?>
                        <input onclick="dtech.doGloblSearch()" type="button" value="Search" name="" class="txt_btn" />
                </form>    
            </div>
        </div>
    </div>
    <div id="right_banner" style="display:none">
        <div class="small_book">
            <div class="small_book_img">
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/small_book_1_03.jpg" alt="scientific book" />
            </div>
            <div class="small_book_content">
                <p><a href="#">Talha Jutt </a>recommended this book</p>
                <p><a href="#" class="science">Scientific Wonders on the earth and in space</a></p>
                <p class="minutes">about 2 seconds ago</p>
            </div>
        </div>
        <div class="small_book">
            <div class="small_book_img">
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/small_book_2_03.jpg" alt="scientific book" />
            </div>
            <div class="small_book_content">
                <p><a href="#">Zain Khan </a>recommended this book</p>
                <p><a href="#" class="science">Scientific Wonders on the earth and in space</a></p>
                <p>about 2 seconds ago</p>
                <p class="blak">Sunt in culpa quie officia deserunt molit anim id est laborum sind occaecat.</p>
            </div>
        </div>
        <div class="small_book">
            <div class="small_book_img">
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/small_book_3_03.jpg" alt="scientific book" />
            </div>
            <div class="small_book_content">
                <p><a href="#" class="science">Scientific Wonders on the earth and in space</a></p>
                <p>7,165 people recommended this book</p>
            </div>
        </div>
        <div class="small_book">
            <div class="small_book_img">
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/small_book_1_03.jpg" alt="scientific book" />
            </div>
            <div class="small_book_content">
                <p><a href="#">Talha Jutt </a>recommended this book</p>
                <p><a href="#" class="science">Scientific Wonders on the earth and in space</a></p>
                <p class="minutes">about 2 seconds ago</p>
            </div>
        </div>
        <div class="small_book">
            <div class="small_book_img">
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/small_book_1_03.jpg" alt="scientific book" />
            </div>
            <div class="small_book_content">
                <p><a href="#">Talha Jutt </a>recommended this book</p>
                <p><a href="#" class="science">Scientific Wonders on the earth and in space</a></p>
                <p class="minutes">about 2 seconds ago</p>
            </div>
        </div>
    </div>
</div>
</div>
<div id="content">
    <div id="main_content">
        <div id="left_content">
            <h1>Over <?php echo Product::model()->count("city_id='" . Yii::app()->session['city_id'] . "'") ?> books for every type</h1>
        </div>
        <div id="right_content" style="display:none">
            <ul>
                <li><a href="#">Careers</a></li>
                <li><a href="#">Becomes Our Partner</a></li>
            </ul>
        </div>
    </div>
</div>
<section>
    <div id="main_section">


        <?php echo $content; ?>
    </div>
</section>
<?php $this->endContent(); ?>