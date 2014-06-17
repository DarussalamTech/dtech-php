<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <!-- Be sure to leave the brand out there if you want it shown -->
            <a class="brand" href="javascript:void(0)">

                <small><img src="<?php echo Yii::app()->baseUrl; ?>/images/logo/logo.png" width="158" height="54"/></small>
            </a>

            <div class="nav-collapse">
                <?php
                //&& Yii::app()->user->type=="admin"
                if (!empty(Yii::app()->user->id)):
                    $m = new ProDropDown();
                    $m->run();
                    ?>
                  
                        <?php
                        $me = Menu::model()->findAll();
                        $pidArray = array();
                        foreach ($me as $m) {
                            $pidArray[] = $m->pid;
                        }

                        /* Get Active Menu */
                        $root_parent = $this->getRootParent();
                        $this->getNavigation(0, 0, $root_parent, $pidArray);
                        echo $this->menuHtml;
                    endif;

                    ?>

                </div>
            </div>
        </div>
    </div>

    <div class="subnav navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">

                <div class="style-switcher pull-left">
                    <a href="javascript:chooseStyle('none', 60)" checked="checked"><span class="style" style="background-color:#0088CC;"></span></a>
                    <a href="javascript:chooseStyle('style2', 60)"><span class="style" style="background-color:#7c5706;"></span></a>
                    <a href="javascript:chooseStyle('style3', 60)"><span class="style" style="background-color:#468847;"></span></a>
                    <a href="javascript:chooseStyle('style4', 60)"><span class="style" style="background-color:#4e4e4e;"></span></a>
                    <a href="javascript:chooseStyle('style5', 60)"><span class="style" style="background-color:#d85515;"></span></a>
                    <a href="javascript:chooseStyle('style6', 60)"><span class="style" style="background-color:#a00a69;"></span></a>
                    <a href="javascript:chooseStyle('style7', 60)"><span class="style" style="background-color:#a30c22;"></span></a>
                </div>
                <form class="navbar-search pull-right" action="">



                </form>
            </div><!-- container -->
        </div><!-- navbar-inner -->
    </div><!-- subnav -->