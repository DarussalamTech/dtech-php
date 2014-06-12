<?php /* @var $this Controller */ ?>
<?php

$this->beginContent('//layouts/main');

?>

<div class="row-fluid">
    <?php
    if (!Yii::app()->user->isGuest) {
        ?>
        <div class="span3">
            <div class="sidebar-nav">

                <?php
                $notifications = Notifcation::model()->getUnreadInboxNotifcationCount();
                $this->widget('zii.widgets.CMenu', array(
                    /* 'type'=>'list', */
                    'encodeLabel' => false,
                    'items' => array(
                        array('label' => '<i class="icon icon-home"></i>  Dashboard <span class="label label-info pull-right">Dash</span>', 'url' => array('/site/index'), 'itemOptions' => array('class' => '')),
                        array("type" => "raw", 'label' => 'Notification', 'url' => $this->createUrl('/notifcation/index'), 'visible' => (Yii::app()->user->isAdmin || Yii::app()->user->isSuperAdmin) ? 1 : 0, 'linkOptions' => array("id" => "notifcations"), 'itemOptions' => array('style' => $notifications > 0 ? "font-weight:bold" : "")),
                        array('label' => 'Access Control', 'url' => $this->createUrl('/rights'), 'visible' => (Yii::app()->user->isAdmin || Yii::app()->user->isSuperAdmin) ? 1 : 0, 'itemOptions' => array('class' => '')),
                        array('label' => 'Change Password', 'url' => $this->createUrl('/user/changePassword'), 'visible' => (Yii::app()->user->isGuest) ? 0 : 1, 'itemOptions' => array('class' => '')),
                        array('label' => 'Configuration', 'url' => $this->createUrl('/configurations/general', array('m' => 'Misc', 'type' => 'general')), 'visible' => (Yii::app()->user->isSuperuser) ? 1 : 0, 'itemOptions' => array('class' => '')),
                        array('label' => 'Configuration', 'url' => $this->createUrl('/configurations/load', array('m' => 'Misc', 'type' => 'other')), 'visible' => (Yii::app()->user->isSuperuser) ? 0 : 1, 'itemOptions' => array('class' => '')),
                        array('label' => 'Logout', 'url' => array('/site/logout'), 'visible' => (Yii::app()->user->isGuest) ? 0 : 1, 'itemOptions' => array('class' => 'logout border-none')),
                        array('label' => 'Login', 'url' => array('/site/login'), 'visible' => (Yii::app()->user->isGuest) ? 1 : 0, 'itemOptions' => array('class' => 'logout border-none')),
                        // Include the operations menu
                        //array('label' => 'OPERATIONS', 'items' => $this->menu),
                    ),
                ));
                ?>
                <?php
                /*
                 * If configuration controller is called
                 * 
                 */

                if ($this->id == "configurations" ||
                        $this->id == "cmm" ||
                        $this->id == "confProducts" || $this->id == "dtMessages") {
                    $link_array = array(
                        'Settings' => '<ul class="accordion-ul">' .
                        '<li>' . CHtml::link('General Misc', $this->createUrl('/configurations/general', array("m" => "Misc", 'type' => 'general')), array("style" => !Yii::app()->user->IsSuperuser ? "display:none" : "")) .
                        '</li>' .
                        '<li>' . CHtml::link('Branch Misc', array('/configurations/load',
                            "m" => "Misc", "type" => 'other')) .
                        '</li>' .
                        '<li>' . CHtml::link('Payment Methods', array('/configurations/load',
                            "m" => "PaymentMethods")) . '</li>' .
                        '<li>' . CHtml::link('Currency Rates', array('/configurations/load',
                            "m" => "Currency")) . '</li>' .
                        '<li>' . CHtml::link('Tax Rates', array('/configurations/load',
                            "m" => "TaxRates")) . '</li>' .
                        '</ul>',
                        'Product' => '<ul class="accordion-ul">' .
                        '<li>' . CHtml::link('Dimensions', array('/configurations/load',
                            "m" => "Products", 'type' => 'Dimensions')) .
                        '</li>' .
                        '<li>' . CHtml::link('Binding', array('/configurations/load',
                            "m" => "Products", "type" => 'Binding')) .
                        '</li>' .
                        '<li>' . CHtml::link('Printing', array('/configurations/load',
                            "m" => "Products", "type" => "Printing")) . '</li>' .
                        '<li>' . CHtml::link('Paper', array('/configurations/load',
                            "m" => "Products", "type" => "Paper")) . '</li>' .
                        '<li>' . CHtml::link('Weight', array('/configurations/load',
                            "m" => "Products", "type" => "weight")) . '</li>' .
                        '<li>' . CHtml::link('Author', array('/author/index',
                                ), array("style" => Yii::app()->user->IsSuperuser ? "display:none" : "")) . '</li>' .
                        '<li>' . CHtml::link('Translator Compiler', array('/translatorCompiler/index',
                                ), array("style" => Yii::app()->user->IsSuperuser ? "display:none" : "")) . '</li>' .
                        '<li>' . CHtml::link('Product Custom Attributes', array('/configurations/load',
                            "m" => "ProductAttributes", "type" => "")) . '</li>' .
                        '</ul>',
                        'Translation' => '<ul class="accordion-ul">' .
                        '<li>' . CHtml::link('Common', array('/dtMessages/index',
                            "category" => "common")) . '</li>' .
                        '<li>' . CHtml::link('Header Footer', array('/dtMessages/index',
                            "category" => "header_footer")) . '</li>' .
                        '<li>' . CHtml::link('Labels', array('/dtMessages/index',
                            "category" => "models_labels")) . '</li>' .
                        '<li>' . CHtml::link('Product Detail', array('/dtMessages/index',
                            "category" => "product_detail")) . '</li>' .

                        '</ul>',
                    );

                    if (!Yii::app()->user->IsSuperuser) {
                        unset($link_array['Translation']);
                    }
                    $this->widget('zii.widgets.jui.CJuiAccordion', array(
                        'panels' => $link_array,
                        // additional javascript options for the accordion plugin
                        'cssFile' => Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl . '/css/jq-aquradian.css'),
                        'options' => array(
                            'autoHeight' => false,
                            'navigation' => true,
                            'clearStyle' => true,
                            'resize' => true,
                        ),
                        'htmlOptions' => array('style' => 'font-size:12px;margin-top:0')
                    ));
                } else {
                    $this->widget('zii.widgets.CMenu', array(
                        'items' => $this->menu,
                        'htmlOptions' => array('class' => 'operations'),
                    ));
                }
                if (isset($this->PcmWidget['filter'])) {
                    $this->widget($this->PcmWidget['filter']['name'], $this->PcmWidget['filter']['attributes']);
                    echo "<hr />";
                }
                ?>
            </div>
            <br>
            <table class="table table-striped table-bordered">
                <tbody>
                    <tr>
                        <td width="50%">Bandwith Usage</td>
                        <td>
                            <div class="progress progress-danger">
                                <div class="bar" style="width: 80%"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Disk Spage</td>
                        <td>
                            <div class="progress progress-warning">
                                <div class="bar" style="width: 60%"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Conversion Rate</td>
                        <td>
                            <div class="progress progress-success">
                                <div class="bar" style="width: 40%"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Closed Sales</td>
                        <td>
                            <div class="progress progress-info">
                                <div class="bar" style="width: 20%"></div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="well">

                <dl class="dl-horizontal">
                    <dt>Account status</dt>
                    <dd>$1,234,002</dd>
                    <dt>Open Invoices</dt>
                    <dd>$245,000</dd>
                    <dt>Overdue Invoices</dt>
                    <dd>$20,023</dd>
                    <dt>Converted Quotes</dt>
                    <dd>$560,000</dd>

                </dl>
            </div>

        </div><!--/span-->
        <div class="span9">

            <?php if (isset($this->breadcrumbs)): ?>
                <?php
                $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
                    'homeLink' => CHtml::link('Dashboard'),
                    'htmlOptions' => array('class' => 'breadcrumb')
                ));
                ?><!-- breadcrumbs -->
                <?php
            endif;
        }
        ?>

        <!-- Include content pages -->
        <?php echo $content; ?>

    </div><!--/span-->
</div><!--/row-->
<?php
$this->endContent();
?>