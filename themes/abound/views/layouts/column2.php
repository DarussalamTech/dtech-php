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
                        array('label' => 'OPERATIONS', 'items' => $this->menu),
                    ),
                ));
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