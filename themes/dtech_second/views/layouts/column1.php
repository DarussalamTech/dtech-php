<?php $this->beginContent('//layouts/main'); ?>
    <div class="left_bar">

        <?php
        echo CHtml::image(Yii::app()->theme->baseUrl . "/images/banner_img_02.png");
        ?>
    </div>
    <div id="right_banner">
        <h2>Activites</h2>
        <div class="small_book">
            <div class="small_book_img">

                <?php
                echo CHtml::image(Yii::app()->theme->baseUrl . "/images/small_book_1_03.jpg", 'scientific book');
                ?>
            </div>
            <div class="small_book_content">
                <p><a href="#">Talha Jutt </a>recommended this book</p>
                <p><a href="#" class="science">Scientific Wonders on the earth and in space</a></p>
                <p class="minutes">about 2 seconds ago</p>
            </div>
        </div>
        <div class="small_book">
            <div class="small_book_img">

                <?php
                echo CHtml::image(Yii::app()->theme->baseUrl . "/images/small_book_2_03.jpg", 'scientific book');
                ?>
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

                <?php
                echo CHtml::image(Yii::app()->theme->baseUrl . "/images/small_book_3_03.jpg", 'scientific book');
                ?>
            </div>
            <div class="small_book_content">
                <p><a href="#" class="science">Scientific Wonders on the earth and in space</a></p>
                <p>7,165 people recommended this book</p>
            </div>
        </div>
        <div class="small_book">
            <div class="small_book_img">

                <?php
                echo CHtml::image(Yii::app()->theme->baseUrl . "/images/small_book_1_03.jpg", 'scientific book');
                ?>
            </div>
            <div class="small_book_content">
                <p><a href="#">Talha Jutt </a>recommended this book</p>
                <p><a href="#" class="science">Scientific Wonders on the earth and in space</a></p>
                <p class="minutes">about 2 seconds ago</p>
            </div>
        </div>
        <div class="small_book">
            <div class="small_book_img">

                <?php
                echo CHtml::image(Yii::app()->theme->baseUrl . "/images/small_book_1_03.jpg", 'scientific book');
                ?>
            </div>
            <div class="small_book_content">
                <p><a href="#">Talha Jutt </a>recommended this book</p>
                <p><a href="#" class="science">Scientific Wonders on the earth and in space</a></p>
                <p class="minutes">about 2 seconds ago</p>
            </div>
        </div>
    </div>
    
    <div id="content">
        <?php echo $content; ?>
        <?php echo $this->renderPartial("//layouts/_footer") ?>
    </div>
<?php $this->endContent(); ?>