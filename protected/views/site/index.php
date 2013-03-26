<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
//$this->layout='column2';
if (Yii::app()->user->isAdmin || Yii::app()->user->isSuperAdmin) {
    $this->menu = array(
        array('label' => 'Create Layout', 'url' => array('/layout/create')),
        array('label' => 'Manage Layout', 'url' => array('/layout/admin')),
        array('label' => 'Create User', 'url' => array('/user/create')),
        array('label' => 'Manage User', 'url' => array('/user/admin')),
        array('label' => 'Create City', 'url' => array('/city/create')),
        array('label' => 'Manage City', 'url' => array('/city/admin')),
        array('label' => 'Create Country', 'url' => array('/country/create')),
        array('label' => 'Manage Country', 'url' => array('/country/admin')),
    );
}
?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<br>Darussalam is a multilingual international Islamic publishing house, with headquarters in Riyadh, Kingdom of Saudi 
Arabia, and branches & agents in major cities of the world. <br>The foremost obligation of <br>TDarussalam is to publish most 
authentic Islamic books in the light of the Quran<br> and the Sahih Ahadith in all major international languages. 
<br>To impart and impel the above mentioned sacred obligation, <br>Darussalam has been engaged from its very inception,
in producing books on Islam<br> in the Arabic, English, Urdu, Spanish, French, Hindi, <br>Persian, Malayalam, Turkish, Indonesian, 
Russian, Albanian and Bangla<br> languages. The main theme of these books is to present the fundamentals of Islam as explained by 
the<br> most recognized Islamic scholars of the Muslim world.

The other main features of Darussalam as follows:<br>

Presenting books free from sectarianism and in accordance with the Quran and the Sunnah.
Producing books in concise, easy, lucid and comprehensive form.<br>
Keeping the prices of the books less than the global market prices.
Maintaining the quality of books according to <br>international standards.
Working to develop a better understanding of different schools of thought among the Muslims.<br>
Presenting books written by the most senior Islamic scholars and authors.
Editing of manuscripts by a board of senior editors.<br>
Supervising every stage of publication by a team of professional technical staff.
Catering to the needs of the<br> present-day problems faced by Muslims.<br>
Introducing educational devices for the learning of Quranic<br> teaching through computer technology.<br>
Abdul Malik Mujahid
Darussalam, Riyadh, KSA</p>
<br />
<br />
<br />

<?php
$site_id = Yii::app()->session['site_id'];

$countries = Country::model()->findAll(array('condition' => 'site_id="' . $site_id . '"'));
$total = count($countries);
//$n=0;
for ($i = 0; $i < $total; $i++) {

    echo $country_name = $countries[$i]['country_name'];
    $country_short_name = $countries[$i]['short_name'];
    print "<br />";
    $country_id = $countries[$i]['country_id'];
    $cities = City::model()->findAll(array('condition' => 'country_id="' . $country_id . '"'));
    $totalcity = count($cities);
    //$n=0;
    for ($j = 0; $j < $totalcity; $j++) {
        $city_name = $cities[$j]['city_name'];
        $city_short_name = $cities[$j]['short_name'];
        $city_id = $cities[$j]['city_id'];
        echo CHtml::link($city_name, array('/site/storehome', 'country' => $country_short_name, 'city' => $city_short_name, 'id' => $city_id), array('class' => 'blue-title-link'));
    }
    print "<br />";
}
?>