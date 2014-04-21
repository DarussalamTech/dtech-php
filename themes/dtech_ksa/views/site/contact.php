

<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/contact.css');
$session = Yii::app()->session;
$prefixLen = strlen(CCaptchaAction::SESSION_VAR_PREFIX);
foreach ($session->keys as $key) {
    if (strncmp(CCaptchaAction::SESSION_VAR_PREFIX, $key, $prefixLen) == 0)
        $session->remove($key);
}
?>

<div class="contact_us">
    <div class="left_contact_part">
        <h1>
            <?php echo Yii::t('header_footer', 'Contact Us', array(), NULL, $this->currentLang) ?>
        </h1>
        <div class="contact_field">

            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'contact-form',
                'enableClientValidation' => FALSE,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),
            ));
            ?>

            <h2><span>*</span><?php echo Yii::t('common', 'Mandatory Fields', array(), NULL, $this->currentLang) ?></h2>
            <?php if (Yii::app()->user->hasFlash('contact'))  ?>
            <div class="flash-success" style="color:green">
                <?php echo '<br/><tt>' . Yii::app()->user->getFlash('contact') . '</tt>'; ?>
            </div>
            <span style="text-align: center; font-size: 11px">
                <?php echo $form->errorSummary($model); ?>
            </span>
            <div class="contact_form">
                <p><?php echo $form->labelEx($model, 'email'); ?></p>
                <?php echo $form->textField($model, 'email', array('class' => 'form_name')); ?>
            </div>
            <div class="contact_form">
                <p><?php echo $form->labelEx($model, 'name'); ?></p>
                <?php echo $form->textField($model, 'name', array('class' => 'form_name')); ?>
            </div>
            <div class="contact_form">
                <p> <?php echo $form->labelEx($model, 'subject'); ?></p>
                <?php echo $form->textField($model, 'subject', array('class' => 'form_name')); ?>
            </div>

            <div class="contact_form">
                <p> <?php echo $form->labelEx($model, 'message_type'); ?></p>
                <?php echo $form->dropDownList($model, 'message_type', array('Suggession'=>'Suggestion','Enquiry'=>'Enquiry', 'Complaint'=>'Complaint'), array('options' => array('Suggestion' => array('selected' => true)))); ?>
            </div>
            <div class="contact_form">
                <p><?php echo $form->labelEx($model, 'body'); ?></p>
                <?php echo $form->textArea($model, 'body', array('rows' => 5, 'cols' => 31, 'style' => 'resize:none')); ?>

            </div>
            <?php if (CCaptcha::checkRequirements()): ?>
                <div class="contact_form">

                    <p><?php echo $form->labelEx($model, 'verifyCode'); ?></p>
                    <?php
                    $this->widget('CCaptcha', array('buttonLabel' => 'Refresh Code',
                        'buttonType' => 'link',
                        'id' => rand(0, 99999)
                    ));
                    ?>

                <?php endif; ?>
            </div>
            <div class="contact_form">
                <p style="font-size: 9px">Please enter the letters  shown in the above image</p>
                <?php echo $form->textField($model, 'verifyCode', array('class' => 'form_name')); ?>
            </div>
            <div class="contact_form">
                <p><?php echo $form->labelEx($model, 'customer_copy_check'); ?></p>
                <?php echo $form->checkBox($model, 'customer_copy_check'); ?>
                <?php echo CHtml::submitButton(Yii::t('common', 'Submit', array(), NULL, $this->currentLang), array('class' => 'submit_btn')); ?>
            </div>
            <?php $this->endWidget(); ?>
        </div>
        <div class="contact_info">   

            <div class="business_contact">
                <article>General</article>
                <section>
                    <?php
                    echo CHtml::mailto("info@darussalamksa.com", "info@darussalamksa.com")
                    ?>
                </section>
            </div>           
            <div class="business_contact">
                <article>Technical Support</article>
                <section>
                    <?php
                    echo CHtml::mailto("it@darussalamksa.com", "it@darussalamksa.com")
                    ?>
                </section>
            </div>
            <div class="business_contact">
                <article>Sales Enquiries and customer services</article>
                <section>
                    <?php
                    echo CHtml::mailto("sales@darussalamksa.com", "sales@darussalamksa.com")
                    ?>
                </section>
            </div>
        </div>

    </div>
    <div class="right_contact_part">
        <div class="countries_contact">
            <h3>Kingdom Of Saudi Arabia</h3>

            <div class="contact_us_branch">Riyadh Avenue Branch:</div>
            <p>Tel: 00966-1-4032296</p>
            <p>Fax: 00966-1-4032269</p> 

            <div class="contact_us_branch">Olaya Branch:</div>
            <p>Tel: 00966-1-4614483</p>
            <p>Fax: 00966-1-4644945</p>

            <div class="contact_us_branch">Malaz Branch:</div>
            <p>Tel: 00966-1-4735220</p>
            <p>Fax: 00966-1-4735221</p>

            <div class="contact_us_branch">Suwaidi Branch:</div>
            <p>Tel: 00966-1-4286641</p>
            <p>Fax: 00966-1-4286641</p>

            <div class="contact_us_branch">Suwailam Branch:</div>
            <p>Tel: 00966-1-2860422</p>
            <p>Fax: 00966-1-2860422</p>

            <div class="contact_us_branch">Jeddah Branch:</div>
            <p>Tel: 00966-2-6879254</p>
            <p>Fax: 00966-2-6336270</p>

            <div class="contact_us_branch">Madinah Branch:</div>
            <p>Tel: 00966-4-8234446</p>
            <p>Fax: 00966-2-8550119</p>

            <div class="contact_us_branch">Makkah Branch:</div>
            <p>Tel: 00966-2-5376862</p>
            <p>Fax: 00966-2-5376862</p>

            <div class="contact_us_branch">Al Khobar Branch:</div>
            <p>Tel: 00966-3-6879254</p>
            <p>Fax: 00966-3-8691551</p>

            <div class="contact_us_branch">Qaseem Branch:</div>
            <p>Tel: 00966-6-3268965</p>
            <p>Fax: 00966-6-3268965</p>

            <div class="contact_us_branch">K.Masheet Branch:</div>
            <p>Tel: 00966-7-2207055</p>
            <p>Fax: 00966-7-2207055</p>

            <div class="contact_us_branch">Yanbu Branch:</div>
            <p>Tel: 00966-4-3229188</p>
            <p>Fax: 00966-4-3229188</p>

        </div>

    </div>
    <div class="contact_map">
        <section>
            <p> Head Office Location</p>
        </section>
        <div id="map-2" style="width:700px;height:220px;"></div>              
    </div>

</div>
<script type="text/javascript">
    jQuery(document).ready(function() {
        /*
         * snippet to clear the 
         * captcha value when 
         * validation failed..ubd
         */
        jQuery("#ContactForm_verifyCode").val("");
    })
    window.onload = function() {
        /*
         * code to change the captcha value on each page refresh after page load
         */
        jQuery('#yw0_button').trigger('click');
    }
</script>
<head>
    <script
        src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false">
    </script>

    <script>
        function initialize() {
            var map = new google.maps.Map(document.getElementById('map-2'), {
                center: new google.maps.LatLng(24.666543, 46.706812),
                zoom: 15
            });

            var request = {
                reference: 'CnRkAAAAGnBVNFDeQoOQHzgdOpOqJNV7K9-c5IQrWFUYD9TNhUmz5-aHhfqyKH0zmAcUlkqVCrpaKcV8ZjGQKzB6GXxtzUYcP-muHafGsmW-1CwjTPBCmK43AZpAwW0FRtQDQADj3H2bzwwHVIXlQAiccm7r4xIQmjt_Oqm2FejWpBxLWs3L_RoUbharABi5FMnKnzmRL2TGju6UA4k'
            };

            var infowindow = new google.maps.InfoWindow();
            var service = new google.maps.places.PlacesService(map);

            service.getDetails(request, function(place, status) {
                if (status == google.maps.places.PlacesServiceStatus.OK) {
                    var marker = new google.maps.Marker({
                        map: map,
                        position: new google.maps.LatLng(24.666543, 46.706812)
                    });
                    google.maps.event.addListener(marker, 'click', function() {
                        infowindow.setContent(place.name);
                        infowindow.open(map, this);
                    });
                }
            });
        }

        google.maps.event.addDomListener(window, 'load', initialize);

    </script>

</head>