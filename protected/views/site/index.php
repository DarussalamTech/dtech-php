<?php
$this->pageTitle = Yii::app()->name;
$site_id = Yii::app()->session['site_id'];
$countries = Country::model()->findAll(array('condition' => 'site_id="' . $site_id . '"'));
$total = count($countries);
for ($i = 0; $i < $total; $i++) {
    $country_name = $countries[$i]['country_name'];
    $country_short_name = $countries[$i]['short_name'];
    ?>
    <h1><?php echo $country_name; ?></h1>
    <div class="browse">
        <div class="section_list">
            <ul><?php
    $country_id = $countries[$i]['country_id'];
    $cities = City::model()->findAll(array('condition' => 'country_id="' . $country_id . '"'));
    $totalcity = count($cities);
    for ($j = 0; $j < $totalcity; $j++) {
        $city_name = $cities[$j]['city_name'];
        $city_short_name = $cities[$j]['short_name'];
        $city_id = $cities[$j]['city_id'];
        ?>
        <li><?php echo CHtml::link($city_name, array('/site/storehome', 'country' => $country_short_name, 'city' => $city_short_name, 'city_id' => $city_id), array('class' => 'blue-title-link')); ?></li>
        <?php
    }
        echo  "</ul></div></div>";
}?>
