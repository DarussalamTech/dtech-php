
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Free yii themes, free web application theme">
        <meta name="author" content="Webapplicationthemes.com">
        <link href='http://fonts.googleapis.com/css?family=Carrois+Gothic' rel='stylesheet' type='text/css'>

        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <?php
        $baseUrl = Yii::app()->theme->baseUrl;
        $cs = Yii::app()->getClientScript();
        if (get_class($this->getModule()) != "RightsModule") {
            $cs->registerScriptFile(Yii::app()->baseUrl . '/packages/jui/js/jquery.js', CClientScript::POS_HEAD);
        }
        ?>

        <!-- Fav and Touch and touch icons -->
        <link rel="shortcut icon" href="<?php echo $baseUrl; ?>/img/icons/favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $baseUrl; ?>/img/icons/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $baseUrl; ?>/img/icons/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="<?php echo $baseUrl; ?>/img/icons/apple-touch-icon-57-precomposed.png">
        <?php
        $cs->registerCssFile($baseUrl . '/css/bootstrap.min.css');
        $cs->registerCssFile($baseUrl . '/css/bootstrap-responsive.min.css');
        $cs->registerCssFile($baseUrl . '/css/abound.css');
        $cs->registerCssFile($baseUrl . '/css/form.css');
        ?>
        <!-- styles for style switcher -->
        <link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/style-blue.css" />
        <link rel="alternate stylesheet" type="text/css" media="screen" title="style2" href="<?php echo $baseUrl; ?>/css/style-brown.css" />
        <link rel="alternate stylesheet" type="text/css" media="screen" title="style3" href="<?php echo $baseUrl; ?>/css/style-green.css" />
        <link rel="alternate stylesheet" type="text/css" media="screen" title="style4" href="<?php echo $baseUrl; ?>/css/style-grey.css" />
        <link rel="alternate stylesheet" type="text/css" media="screen" title="style5" href="<?php echo $baseUrl; ?>/css/style-orange.css" />
        <link rel="alternate stylesheet" type="text/css" media="screen" title="style6" href="<?php echo $baseUrl; ?>/css/style-purple.css" />
        <link rel="alternate stylesheet" type="text/css" media="screen" title="style7" href="<?php echo $baseUrl; ?>/css/style-red.css" />
        <?php
        $cs->registerScriptFile($baseUrl . '/js/bootstrap.min.js');
//        $cs->registerScriptFile($baseUrl . '/js/plugins/jquery.sparkline.js');
//        $cs->registerScriptFile($baseUrl . '/js/plugins/jquery.flot.min.js');
//        $cs->registerScriptFile($baseUrl . '/js/plugins/jquery.flot.pie.min.js');
//        $cs->registerScriptFile($baseUrl . '/js/charts.js');
//        $cs->registerScriptFile($baseUrl . '/js/plugins/jquery.knob.js');
//        $cs->registerScriptFile($baseUrl . '/js/plugins/jquery.masonry.min.js');
        $cs->registerScriptFile($baseUrl . '/js/styleswitcher.js');
        ?>
        <script>
            // defining js base path
            var js_basePath = '<?php echo Yii::app()->theme->baseUrl; ?>';

            var yii_base_url = "<?php echo Yii::app()->baseUrl; ?>";

        </script>

        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl ?>/media/js/dtech.js"></script>
    </head>

    <body>
        <?php
        /**
         * Complete issue management in this div.
         * Just hide it when you are loading detail view
         */
        ?>
        <div id="loading" align="center">
            Please Wait

        </div>
        <section id="navigation-main">   
            <!-- Require the navigation -->
            <?php require_once('tpl_navigation.php') ?>
        </section><!-- /#navigation-main -->

        <section class="main-body">
            <div class="container-fluid">
                <!-- Include content pages -->
                <?php echo $content; ?>
            </div>
        </section>

        <!-- Require the footer -->
        <?php require_once('tpl_footer.php') ?>

    </body>
    <?php
    Yii::app()->clientScript->registerScript('popupwindow', '
          function printpdf(path)
          {
           var left = (screen.width/2)-(700/2);
           var top = (screen.height/2)-(490/2);
           var str="height=540,scrollbars=yes,width=700,status=yes,";
           str+="toolbar=no,menubar=no,location=no,left="+left+",top="+top+"";

           window.open(path,null,str);

         }

        ', CClientScript::POS_HEAD);
    ?>
    <?php
    Yii::app()->clientScript->registerScript('leavePageFunction', "
           function onLeavePage()
            {
                
                    
                    var warning = true;
                    window.onbeforeunload = function(e) {
                        if(submitbutton==false)
                        {
                            if (warning)
                            {
                                return 'This page is asking you to confirm that you want to leave - data you have entered may not be saved.';
                            }
                        }
                    }
              
            }
    ", CClientScript::POS_HEAD);

    //do for plus minus image on click on child containers
    Yii::app()->clientScript->registerScript('plus_minus_image', "
               jQuery('.plus').parent().parent().bind('click',function()
                {
                   var minus_img='" . Yii::app()->theme->baseUrl . "/images/icons/minus.gif'; 
                   var plus_img='" . Yii::app()->theme->baseUrl . "/images/icons/plus.gif'; 
                    
                   if(typeof jQuery($(this).children().children().get(0)).attr('class')!='undefined')
                   {    
                         
                        if(jQuery(jQuery(this).children().children().get(0)).attr('class').search('plus_rotate')!=-1)
                        {
                           
                            jQuery(jQuery(this).children().children().get(0)).attr('src',minus_img)
                        }
                        else
                       {
                            jQuery(jQuery(this).children().children().get(0)).attr('src',plus_img)
                       }
                   }
                   
                   
                })", CClientScript::POS_READY);

    Yii::app()->clientScript->registerScript('plus_minus_image_function', "
               function changePlusMinuImage(obj)
                {
            
                   var minus_img='" . Yii::app()->theme->baseUrl . "/images/minus.png'; 
                   var plus_img='" . Yii::app()->theme->baseUrl . "/images/plus.png'; 
                   if(document.URL.search('create')==-1)
                   {
                         if($(obj).attr('class').search('plus_rotate')!=-1)
                           {
                                $(obj).attr('src',minus_img)
                           }
                       else
                           {
                                $(obj).attr('src',plus_img)
                           }
                   }
                  
                }", CClientScript::POS_HEAD);
    ?>
    <script type="text/javascript">
        //used for save and send to prevent reloading message
        var color_box_open = false;
        var submitbutton = false;


        function getquerystring()
        {
            var urlParams = {};
            var e,
                    a = /\+/g, // Regex for replacing addition symbol with a space
                    r = /([^&=]+)=?([^&]*)/g,
                    d = function(s) {
                return decodeURIComponent(s.replace(a, " "));
            },
                    q = window.location.search.substring(1);

            while (e = r.exec(q))
            {
                urlParams[d(e[1])] = d(e[2]);
            }

            return urlParams;
        }

        /**
         *  finding length of object of js
         */
        function objectlength(obj)
        {
            var count = 0;
            for (var prop in obj)
            {
                count++;
            }
            return count;

        }

        jQuery(function() {
            jQuery("input[type=submit]").click(function()
            {
                window.onbeforeunload = null;
            }
            )
            updateNotifcations();
            setInterval(updateNotifcations, 80000); //300000 MS == 5 minutes
        });


        function updateNotifcations() {
            dtech.updateElementAjax('<?php echo $this->createUrl("/notifcation/getTotalNotifications") ?>', 'notifcations', '');

            setTimeout(function() {
                var r = /\d+/;
                var s = jQuery("a#notifcations").html();
                if (typeof(s) != "undefined" && s.match(r) > 0) {
                    jQuery("a#notifcations").parent("style", "font-weight:bold");
                }
                else {

                }
            }, 500);
        }
    </script>
</html>