<h1>BROWSE BY CATEGORY</h1>
            <div class="browse">
                <div class="section_list">
                    <ul>
                        <li><a href="#">Aqeedah</a></li>
                        <li><a href="#">Biography</a></li>
                        <li><a href="#">Biography of the Prophet</a></li>
                        <li><a href="#">Children</a></li>
                        <li><a href="#">Fatawa</a></li>
                        <li><a href="#">Fiqh</a></li>
                    </ul>
                </div>
                
                <div class="section_list">
                    <ul>
                        <li><a href="#">General</a></li>
                        <li><a href="#">Hadith</a></li>
                        <li><a href="#">History</a></li>
                        <li><a href="#">Islamic Culture</a></li>
                        <li><a href="#">Non-Muslim</a></li>
                        <li><a href="#">Worship</a></li>
                    </ul>
                </div>
                <div class="section_list">
                    <ul>
                        <li><a href="#">Packet or Set</a></li>
                        <li><a href="#">Qur'an</a></li>
                        <li><a href="#">Stories</a></li>
                        <li><a href="#">Supplication and Forgiveness</a></li>
                        <li><a href="#">Tafsir</a></li>
                        <li><a href="#">Women</a></li>
                    </ul>
                </div>
                <div class="section_list">
                    <ul>
                        <li><a href="#">Aqeedah</a></li>
                        <li><a href="#">Biography</a></li>
                        <li><a href="#">Biography of the Prophet</a></li>
                        <li><a href="#">Children</a></li>
                        <li><a href="#">Fatawa</a></li>
                        <li><a href="#">Fiqh</a></li>
                    </ul>
                </div>
                <div class="section_list">
                    <ul>
                        <li><a href="#">General</a></li>
                        <li><a href="#">Hadith</a></li>
                        <li><a href="#">History</a></li>
                        <li><a href="#">Islamic Culture</a></li>
                        <li><a href="#">Non-Muslim</a></li>
                        <li><a href="#">Worship</a></li>
                    </ul>
                </div>
          	</div>    
<div id="left_books">
    <?php //echo CHtml::link('( View All )', array('/site/featuredProducts', 'country' => $country_short_name, 'city' => $city_short_name, 'city_id' => $city_id), array('class' => 'blue-title-link')); ?>
            	<h2>FEATURED PRODUCTS <span><?php echo CHtml::link('( VIEW ALL )', array('/site/featuredProducts', 'country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id']), array('class' => 'blue-title-link'));?></span></h2>
<!--            	<h2>FEATURED PRODUCTS <span>( <a href="<?php //echo $this->createUrl('/site/featuredProducts')?>">VIEW ALL</a> )</span></h2>-->
<?php
//echo Yii::app()->getBaseUrl(true);
foreach($product as $featured)
{
    $name=$featured['product_name'];
    foreach($featured['image'] as $image)
     {
       ?>
                <div class="books">
                	<a href="<?php echo $this->createUrl('/site/productDetail',array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id']));?>"><img src="<?php  echo Yii::app()->baseUrl.'/images/product_images/'.$image['image_large'];?>" alt="Pen QURAN PAK" /></a>
                    <p><a href="<?php echo $this->createUrl('/site/productDetail',array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id']));?>"><?php echo $name; ?></a></p>
                </div>
       <?php
       break;
    }
}
?>
</div>
<div id="right_books">
    <h2>BEST SELLING BOOKS <span><?php echo CHtml::link('( VIEW ALL )', array('/site/bestSellings', 'country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id']), array('class' => 'blue-title-link'));?></h2>
<!--    <h2>BEST SELLING BOOKS <span>( <a href="<?php echo $this->createUrl('/site/bestSellings')?>">VIEW ALL</a> )</h2>-->
<?php
foreach($best_sellings as $bests)
{
    $pro_name=$bests['product_name'];
     $orders= $bests['totalOrder'];
    foreach($bests['image'] as $image)
     {
       ?>
    <div class="books2">
                	<a href="#"><img src="<?php  echo Yii::app()->baseUrl.'/images/product_images/'.$image['image_large'];?>" alt="Pen QURAN PAK" /></a>
                    <p><a href="#"><?php echo $pro_name.'('.$orders.')'; ?></a></p>
                </div>
       <?php
       break;
    }
}
?>
 </div>
       