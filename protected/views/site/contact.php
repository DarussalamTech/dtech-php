<div id="contact_us">
    <div id="main_contact_us">
        <h1>Contact Us</h1>
        <div id="left_contact">
            <div id="contact_us_form">
                <table width="100%">
                    <?php if (Yii::app()->user->hasFlash('contact'))  ?>
                    <div class="flash-success" style="color:green">
                        <?php echo '<br/><tt>' . Yii::app()->user->getFlash('contact') . '</tt>'; ?>
                    </div>
                    <tr>
                        <td>    
                            <?php
                            $form = $this->beginWidget('CActiveForm', array(
                                'id' => 'contact-form',
                                'enableClientValidation' => FALSE,
                                'clientOptions' => array(
                                    'validateOnSubmit' => true,
                                ),
                            ));
                            ?>
                            <div class="flash-success" style="color:red;">
                                <?php echo $form->errorSummary($model); ?>
                            </div>
                            <table>
                                <tr class="contact_tr">
                                    <td class="contact_us_left_right_td">
                                        Your question may already be answered in our 
                                        <?php
                                        $require_pages = array("FAQ's");
                                        foreach ($this->webPages as $page) {
                                            if (in_array($page->title, $require_pages)) {

                                                echo CHtml::link($page->title, Yii::app()->createUrl('/web/page/viewPage/', array("id" => $page->id)));
                                            }
                                        }
                                        ?>
                                        . If not, send us a message:
                                    </td>
                                </tr>
                                <tr class="contact_tr">
                                    <td class="contact_us_left_td">
                                        <?php echo $form->labelEx($model, 'email'); ?>
                                    </td>
                                    <td class="contact_us_right_td">
                                        <?php echo $form->textField($model, 'email', array('class' => 'form_input')); ?>
                                    </td>
                                </tr>
                                <tr class="contact_tr">
                                    <td class="contact_us_left_td">
                                        <?php echo $form->labelEx($model, 'name'); ?>
                                    </td>
                                    <td class="contact_us_right_td">
                                        <?php echo $form->textField($model, 'name', array('class' => 'form_input')); ?>
                                    </td>
                                </tr>

                                <tr class="contact_tr">
                                    <td class="contact_us_left_td">
                                        <?php echo $form->labelEx($model, 'subject'); ?>
                                    </td>
                                    <td class="contact_us_right_td">
                                        <?php echo $form->textField($model, 'subject', array('class' => 'form_input')); ?>
                                    </td>
                                </tr>
                                <tr class="contact_tr">
                                    <td class="contact_us_left_td">
                                        <?php echo $form->labelEx($model, 'body'); ?>
                                    </td>
                                    <td class="contact_us_right_td">
                                        <?php echo $form->textArea($model, 'body', array('rows' => 3, 'cols' => 31, 'class' => 'form_textarea')); ?>
                                    </td>
                                </tr>


                                <tr class="contact_tr">
                                    <td class="contact_us_left_td"></td>
                                    <td class="contact_us_right_td">
                                        <?php echo CHtml::submitButton('Submit'); ?>    
                                    </td>
                                </tr>
                            </table>
                            <?php $this->endWidget(); ?>

                        </td>
                    </tr>
                </table>
            </div>
            <div class="contact_us_links">
                <div class="right_left_contact">
                    <h3>Business Development</h3>
                    <p>
                        <?php
                        echo CHtml::mailto("bizdev@darussalam.com", "bizdev@darussalam.com")
                        ?>
                    </p>
                </div>
                <div class="right_right_contact">
                    <h3>Public Relations</h3>
                    <p>
                        <?php
                        echo CHtml::mailto("public@darussalam.com", "public@darussalam.com")
                        ?>
                    </p>
                </div>
                <div class="right_left_contact">
                    <h3>Careers</h3>
                    <p>
                        <?php
                        echo CHtml::mailto("jobs@darussalam.com", "jobs@darussalam.com")
                        ?>
                    </p>
                </div>
                <div class="right_right_contact">
                    <h3>Sales, Billing and Support</h3>
                    <p>
                        <?php
                        echo CHtml::mailto("support@darussalam.com", "support@darussalam.com")
                        ?>
                    </p>
                </div>
            </div>
            <div class="left_under_contact_us">
                <h4>Kingdom Of Saudi Arabia</h4>
                <article>Riyadh</article>
                <p>Olaya Branch:</p>
                <p>Tel: 00966-1-4614483</p>
                <p>Fax: 00966-1-4644945</p>
            </div>
        </div>
        <div id="right_contact">
            <div class="pakistan_contact">
                <h5>Pakistan</h5>
                <article>Head Office</article>
                <p>P.O. Box: 22743, Riyadh 11416 K.S.A.</p>
                <p>Tel: 00966-1-4033962/4043432</p>
                <p>Fax: 4021659</p>
            </div>
            <div class="contact_sidebar">
                <h5>Kingdom Of Saudi Arabia</h5>
                <article>Riyadh</article>
                <p>Olaya Branch:</p>
                <p>Tel: 00966-1-4614483</p>
                <p>Fax: 00966-1-4644945</p>
            </div>
            <div class="contact_sidebar">
                <article>U.A.E</article>
                <p>Darussalam, Sharjah U.A.E</p>
                <p>Tel: 00971-6-5632623</p>
                <p>Fax: 00971-6-5632624</p>
            </div>
            <div class="contact_sidebar">
                <h5>U.S.A</h5>
                <article>Darussalam, Houston</article>
                <p>P.O Box: 79194 Tx 77279</p>
                <p>Tel: 001-713-722 0419</p>
                <p>Fax: 001-713-722 0431</p>
            </div>
            <div class="contact_sidebar">
                <h5></h5>
                <article>Darussalam, New York</article>
                <p>Atlantic Ave, Brooklyn New York-11217,</p>
                <p>Tel: 001-718-625 5925</p>
                <p>Fax: 718-625 1511</p>
            </div>
            <div class="contact_sidebar">
                <h5>UK</h5>
                <article>Leyton Business Centre</article>
                <p>Unit-17 Etloe Road, Leyton, London E10 7BT</p>
                <p>Tel: 0044 20 8539 4885</p>
                <p>Fax: 0044 20 8539 4889</p>
            </div>
            <div class="contact_sidebar">
                <h5>Canada</h5>
                <article>Nasiruddin Al-khattab</article>
                <p>2-3415 Dixie Rd, Unit # 505 Mississauga</p>
                <p>Ontario L4Y 4J6, Canada</p>
                <p>Tel: 001-416-418 6619</p>
            </div>
        </div>
    </div>
</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/libs/jquery-1.8.3.min.js"><\/script>')</script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/libs/gumby.min.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/main.js"></script>
<script>
    window._gaq = [['_setAccount', 'UAXXXXXXXX1'], ['_trackPageview'], ['_trackPageLoadTime']];
    Modernizr.load({
        load: ('https:' == location.protocol ? '//ssl' : '//www') + '.google-analytics.com/ga.js'
    });
</script>
<script type="text/javascript">
    $.noConflict();
</script>
