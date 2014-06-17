<?php
$baseUrl = Yii::app()->theme->baseUrl;
/* @var $this SiteController */
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl . '/js/plugins/jquery.sparkline.js', CClientScript::POS_END);
$cs->registerScriptFile($baseUrl . '/js/plugins/jquery.flot.min.js', CClientScript::POS_END);
$cs->registerScriptFile($baseUrl . '/js/plugins/jquery.flot.pie.min.js', CClientScript::POS_END);
$cs->registerScriptFile($baseUrl . '/js/charts.js', CClientScript::POS_END);
$cs->registerScriptFile($baseUrl . '/js/plugins/jquery.knob.js', CClientScript::POS_END);
$cs->registerScriptFile($baseUrl . '/js/plugins/jquery.masonry.min.js', CClientScript::POS_END);

$this->pageTitle = Yii::app()->name;
?>
<?php
$gridDataProvider = new CArrayDataProvider(array(
    array('id' => 1, 'firstName' => 'Mark', 'lastName' => 'Otto', 'language' => 'CSS', 'usage' => '<span class="inlinebar">1,3,4,5,3,5</span>'),
    array('id' => 2, 'firstName' => 'Jacob', 'lastName' => 'Thornton', 'language' => 'JavaScript', 'usage' => '<span class="inlinebar">1,3,16,5,12,5</span>'),
    array('id' => 3, 'firstName' => 'Stu', 'lastName' => 'Dent', 'language' => 'HTML', 'usage' => '<span class="inlinebar">1,4,4,7,5,9,10</span>'),
    array('id' => 4, 'firstName' => 'Jacob', 'lastName' => 'Thornton', 'language' => 'JavaScript', 'usage' => '<span class="inlinebar">1,3,16,5,12,5</span>'),
    array('id' => 5, 'firstName' => 'Stu', 'lastName' => 'Dent', 'language' => 'HTML', 'usage' => '<span class="inlinebar">1,3,4,5,3,5</span>'),
        ));
$top_orders = DashboardStats::getMostOrderUser();
$day_analysis = DashboardStats::getSalesByType("DAY");
$weekly_analysis = DashboardStats::getSalesByType("WEEK");
$month_analysis = DashboardStats::getSalesByType("MONTH");
$year_analysis = DashboardStats::getSalesByType("YEAR");
$gridDataProvider = new CArrayDataProvider($top_orders);



?>

<div class="row-fluid">
    <div class="span3 ">
        <div class="stat-block">
            <ul>
                <li class="stat-graph inlinebar" id="weekly-visit"><?php echo $day_analysis['values']; ?></li>
                <li class="stat-count"><span><?php echo $day_analysis['total']; ?></span><span>Daily Sales (Last 7)</span></li>
                <li class="stat-percent"><span class="text-success stat-percent"></span></li>
            </ul>
        </div>
    </div>
    <div class="span3 ">
        <div class="stat-block">
            <ul>
                <li class="stat-graph inlinebar" id="weekly-visit"><?php echo $weekly_analysis['values']; ?></li>
                <li class="stat-count"><span><?php echo $weekly_analysis['total']; ?></span><span>Weekly Sales (Last 7)</span></li>
                <li class="stat-percent"><span class="text-success stat-percent"></span></li>
            </ul>
        </div>
    </div>
    <div class="span3 ">
        <div class="stat-block">
            <ul>
                <li class="stat-graph inlinebar" id="new-visits"><?php echo $month_analysis['values']; ?></li>
                <li class="stat-count"><span><?php echo $month_analysis['total']; ?></span><span>Monthly Sales (Last 7)</span></li>
                <li class="stat-percent"><span class="text-error stat-percent"></span></li>
            </ul>
        </div>
    </div>
    <div class="span3 ">
        <div class="stat-block">
            <ul>
                <li class="stat-graph inlinebar" id="unique-visits"><?php echo $year_analysis['values']; ?></li>
                <li class="stat-count"><span><?php echo $year_analysis['total']; ?></span><span>Year Sales (Last 7)</span></li>
                <li class="stat-percent"><span class="text-success stat-percent"></span></li>
            </ul>
        </div>
    </div>

</div>

<div class="row-fluid">


    <div class="span9">
        <?php
        $this->beginWidget('zii.widgets.CPortlet', array(
            'title' => '<span class="icon-picture"></span>Monthly InCome Chart',
            'titleCssClass' => ''
        ));
        ?>

        <div class="auto-update-chart" style="height: 250px;width:100%;margin-top:15px; margin-bottom:15px;"></div>

        <?php $this->endWidget(); ?>

    </div>
    <div class="span3">
        <?php
        $monthly_income = DashboardStats::getMonthlyIncome();
     

        $total_items = DashboardStats::getTotalItems();
        $total_books = DashboardStats::getTotalItems("Books");
        $total_others = DashboardStats::getTotalItems("Books", true);
        $total_booksin_perc = ($total_items > 0) ? ($total_books * 100) / $total_items : 0;
        $total_others_perc = ($total_items > 0) ? ($total_others * 100) / $total_items : 0;

//get total orders 

        $total_orders = DashboardStats::getTotalOrders();
        $total_orders_ship = DashboardStats::getTotalOrders("Shipped");
        $total_orders_ship_perc = $total_orders > 0 ? ($total_orders_ship * 100) / $total_orders : 0;
        $total_orders_pend = DashboardStats::getTotalOrders("Pending");
        $total_orders_pend_perc = $total_orders > 0 ? ($total_orders_pend * 100) / $total_orders : 0;
        $total_orders_canc = DashboardStats::getTotalOrders("Cancelled");
        $total_orders_canc_perc = $total_orders > 0 ? ($total_orders_canc * 100) / $total_orders : 0;

        $total_orders_ref = DashboardStats::getTotalOrders("Refunded");
        $total_orders_ref_perc = ($total_orders > 0) ? ($total_orders_ref * 100) / $total_orders : 0;
        
        $customers_who_ordered = DashboardStats::getOrderedCustomers();
        $total_customers = DashboardStats::getTotalCustomers();
        ?>
        <div class="summary">
            <ul>
                <li>
                    <span class="summary-icon">
                        <img src="<?php echo $baseUrl; ?>/img/credit.png" width="36" height="36" alt="Monthly Income">
                    </span>
                    <span class="summary-number"><?php echo $monthly_income['total']; ?></span>
                    <span class="summary-title"> Monthly Income</span>
                </li>
                <li>
                    <span class="summary-icon">
                        <img src="<?php echo $baseUrl; ?>/img/page_white_edit.png" width="36" height="36" alt="Open Invoices">
                    </span>
                    <span class="summary-number"><?php echo $total_orders_ship; ?></span>
                    <span class="summary-title"> Shipped Orders</span>
                </li>
                <li>
                    <span class="summary-icon">
                        <img src="<?php echo $baseUrl; ?>/img/page_white_excel.png" width="36" height="36" alt="Open Quotes<">
                    </span>
                    <span class="summary-number"><?php echo $total_orders_pend; ?></span>
                    <span class="summary-title"> Pending Orders</span>
                </li>
                <li>
                    <span class="summary-icon">
                        <img src="<?php echo $baseUrl; ?>/img/group.png" width="36" height="36" alt="Active Members">
                    </span>
                    <span class="summary-number"><?php echo $total_customers; ?></span>
                    <span class="summary-title"> Total Customers</span>
                </li>
                <li>
                    <span class="summary-icon">
                        <img src="<?php echo $baseUrl; ?>/img/folder_page.png" width="36" height="36" alt="Recent Conversions">
                    </span>
                    <span class="summary-number"><?php echo DashboardStats::getLastTenDaysOrders(); ?></span>
                    <span class="summary-title"> Recent 10 days Orders</span></li>

            </ul>
        </div>

    </div>
</div>


<div class="row-fluid">
    <div class="span6">
        <?php
        $this->widget('zii.widgets.grid.CGridView', array(
            /* 'type'=>'striped bordered condensed', */
            'htmlOptions' => array('class' => 'table table-striped table-bordered table-condensed'),
            'dataProvider' => $gridDataProvider,
            'template' => "{items}",
            'columns' => array(
                //array('name' => 'id', 'header' => '#'),
                array('name' => 'user_name', 'header' => 'User Name'),
                array('name' => 'total_orders', 'header' => 'Total Orders'),
//                array('name' => 'language', 'header' => 'Language'),
//                array('name' => 'usage', 'header' => 'Usage', 'type' => 'raw'),
            ),
        ));
        ?>
    </div><!--/span-->
    <div class="span6">
        <?php
        $gridDataProvider = new CArrayDataProvider(DashboardStats::getMostPurchasedUser());
        $this->widget('zii.widgets.grid.CGridView', array(
            /* 'type'=>'striped bordered condensed', */
            'htmlOptions' => array('class' => 'table table-striped table-bordered table-condensed'),
            'dataProvider' => $gridDataProvider,
            'template' => "{items}",
            'columns' => array(
             
                array('name' => 'user_name', 'header' => 'User Name'),
                array('name' => 'total_purchased', 'header' => 'Total Purchased'),
//                array('name' => 'language', 'header' => 'Language'),
//                array('name' => 'usage', 'header' => 'Usage', 'type' => 'raw'),
            ),
        ));
        ?>

    </div><!--/span-->
</div><!--/row-->

<div class="row-fluid">
    <div class="span6">
        <?php
        $this->beginWidget('zii.widgets.CPortlet', array(
            'title' => '<span class="icon-th-large"></span>Income Chart',
            'titleCssClass' => ''
        ));
        ?>

        <div class="visitors-chart" style="height: 230px;width:100%;margin-top:15px; margin-bottom:15px;"></div>

        <?php $this->endWidget(); ?>
    </div><!--/span-->
    <div class="span6">
        <?php
        $this->beginWidget('zii.widgets.CPortlet', array(
            'title' => '<span class="icon-th-list"></span> Visitors Chart',
            'titleCssClass' => ''
        ));
        ?>

        <div class="pieStats" style="height: 230px;width:100%;margin-top:15px; margin-bottom:15px;"></div>

        <?php $this->endWidget(); ?>
    </div>
    <!--<div class="span2">
    <input class="knob" data-width="100" data-displayInput=false data-fgColor="#5EB95E" value="35">
</div>
    <div class="span2">
    <input class="knob" data-width="100" data-cursor=true data-fgColor="#B94A48" data-thickness=.3 value="29">
</div>
    <div class="span2">
     <input class="knob" data-width="100" data-min="-100" data-fgColor="#F89406" data-displayPrevious=true value="44">     	
    </div><!--/span-->
</div><!--/row-->

<script>
    var visitor_charts = <?php echo CJSON::encode(array(round($total_customers),round($customers_who_ordered))) ?>;
    var monthly_income = <?php echo CJSON::encode(explode(",",$monthly_income['values'])); ?>;
    var max_month_value = <?php echo max(explode(",",$monthly_income['values'])); ?>;
</script>
<script>
    jQuery(function() {

        jQuery(".knob").knob({
            /*change : function (value) {
             //console.log("change : " + value);
             },
             release : function (value) {
             console.log("release : " + value);
             },
             cancel : function () {
             console.log("cancel : " + this.value);
             },*/
            draw: function() {

                // "tron" case
                if (this.$.data('skin') == 'tron') {

                    var a = this.angle(this.cv)  // Angle
                            , sa = this.startAngle          // Previous start angle
                            , sat = this.startAngle         // Start angle
                            , ea                            // Previous end angle
                            , eat = sat + a                 // End angle
                            , r = 1;

                    this.g.lineWidth = this.lineWidth;

                    this.o.cursor
                            && (sat = eat - 0.3)
                            && (eat = eat + 0.3);

                    if (this.o.displayPrevious) {
                        ea = this.startAngle + this.angle(this.v);
                        this.o.cursor
                                && (sa = ea - 0.3)
                                && (ea = ea + 0.3);
                        this.g.beginPath();
                        this.g.strokeStyle = this.pColor;
                        this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
                        this.g.stroke();
                    }

                    this.g.beginPath();
                    this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
                    this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
                    this.g.stroke();

                    this.g.lineWidth = 2;
                    this.g.beginPath();
                    this.g.strokeStyle = this.o.fgColor;
                    this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
                    this.g.stroke();

                    return false;
                }
            }
        });

        // Example of infinite knob, iPod click wheel
        var v, up = 0, down = 0, i = 0
                , $idir = $("div.idir")
                , $ival = $("div.ival")
                , incr = function() {
            i++;
            $idir.show().html("+").fadeOut();
            $ival.html(i);
        }
        , decr = function() {
            i--;
            $idir.show().html("-").fadeOut();
            $ival.html(i);
        };
        $("input.infinite").knob(
                {
                    min: 0
                            , max: 20
                            , stopper: false
                            , change: function() {
                        if (v > this.cv) {
                            if (up) {
                                decr();
                                up = 0;
                            } else {
                                up = 1;
                                down = 0;
                            }
                        } else {
                            if (v < this.cv) {
                                if (down) {
                                    incr();
                                    down = 0;
                                } else {
                                    down = 1;
                                    up = 0;
                                }
                            }
                        }
                        v = this.cv;
                    }
                });
    });
</script>