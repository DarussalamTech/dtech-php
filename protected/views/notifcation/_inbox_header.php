<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/notification-style.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/notification-slideout.css');
?>
<div class="email-menu">
    <ul>
        <li><a class="check dropdown" href="javascript:void(0)">
                <input type="checkbox" onclick="dtech.checkUnCheckUnder(this)"><span class="arrow"></span>
            </a>
            <ul class="width-1">
                <li><a href="javascript:void(0)" onclick="dtech.checkUnCheckUndervalue(true)">All</a></li>
                <li><a href="javascript:void(0)" onclick="dtech.checkUnCheckUndervalue(false)">None</a></li>
                <li><a href="<?php echo $this->createUrl("/notifcation/index", array("Notifcation[is_read]" => 1)); ?>">Read</a></li>
                <li><a href="<?php echo $this->createUrl("/notifcation/index", array("Notifcation[is_read]" => 0)); ?>">Unread</a></li>

            </ul>
        </li>

        <li><a class="" href="<?php echo $this->createUrl("/notifcation/create"); ?>">New</a>
        <li><a class="" href="javascript:void(0)">Delete</a>
        </li>
        <li>
            <a class="dropdown text-only" 
                href="javascript:void(0)">
                Move to
                <span class="arrow"></span>
            </a>
            <ul class="width-2">
                <?php
                foreach ($this->filters['folder'] as $folder_key => $folder):
                    echo '<li><a href="'.$this->createUrl("/notifcation/moveTo").'" folder_id="'.$folder_key.'" onclick="dtech.moveTOFolder(this);return false;">' . $folder . '</a></li>';
                endforeach;
                echo '<li>';
                echo ColorBox::link("Create Folder", $this->createUrl("/notifcation/createFolder"), array('class' => "colorbox"), array("height" => "300", "width" => "400"));
                echo '</li>';
                ?>


            </ul>
        </li>

        <li><a class="dropdown text-only" href="#">More<span class="arrow"></span></a>
            <ul class="width-3">
               
                <li><a onclick="dtech.markNotifStatus(this);return false;" href="<?php echo $this->createUrl("/notifcation/markStatus",array("status"=>"1")); ?>">Mark as read</a></li>
                <li><a onclick="dtech.markNotifStatus(this);return false;" href="<?php echo $this->createUrl("/notifcation/markStatus",array("status"=>"0")); ?>">Mark as unread</a></li>

            </ul>
        </li>
        <li><a class="refresh" href="javascript:void(0)" onclick="location.reload()">&nbsp;</a></li>
        <!--        <li><a class="num"><b>1</b>–<b>50</b> of <b>52</b></a></li>
                <li><a class="previous" href="#">&nbsp;</a></li>
                <li><a class="next" href="#">&nbsp;</a></li>-->
    </ul>
</div>