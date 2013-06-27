

<div id="wraper" style="width:536px; padding: 0; margin: 0 auto; background:#f3f3f3; font-family:Arial, Helvetica, sans-serif;">

    <?php echo CHtml::image(Yii::app()->request->hostInfo . Yii::app()->theme->baseUrl . '/images/banner_img_02.jpg'); ?>
    <div id="main_header">
        <h1><?php echo $email['Subject'] ?></h1>
        <hr>


        <p>
            <?php
            echo $email['Body'];
            ?>
        </p>

    </div>
    <hr>
    <ul>
        <?php
        echo CHtml::openTag("li", array('style' => 'display:inline;'));
        echo CHtml::link('Darussalam Blog', Yii::app()->request->hostInfo . Yii::app()->createUrl('/?r=blog'), array("target" => "_blank"));
        echo CHtml::closeTag("li");
        echo " | ";
        $require_pages = array("Contact Us");
        $pages = Pages::model()->getPages();

        foreach ($pages as $page) {
            if (!in_array($page->title, $require_pages)) {
                CHtml::openTag("li", array('style' => 'display:inline'));
                echo CHtml::link($page->title, Yii::app()->request->hostInfo . Yii::app()->createUrl('/web/page/viewPage/', array("id" => $page->id)));
                echo CHtml::closeTag("li");
                echo " | ";
            }
        }
        echo CHtml::openTag("li", array('style' => 'display:inline'));
        echo CHtml::link('Contact Us', Yii::app()->request->hostInfo . $this->createUrl('/site/contact'));
        echo CHtml::closeTag("li");
        ?>
    </ul>

    <div class="right_footer">
        <table>
            <tr class="footer_tr">
                <td class="left_td" style="width:25px; padding: 0; margin: 0; line-height:17px;">
                    <?php echo CHtml::image(Yii::app()->request->hostInfo . Yii::app()->theme->baseUrl . '/images/phone_img_03.jpg'); ?>
                </td>
                <td class="right_td" style="width:255px; padding: 0; margin: 0; color:#888888; font-size:12px; line-height:17px;">+(92) 42 35254654 - 54</td>
            </tr>
            <tr class="footer_tr">
                <td class="left_td" style="width:25px; padding: 0; margin: 0; line-height:17px;">
                    <?php echo CHtml::image(Yii::app()->request->hostInfo . Yii::app()->theme->baseUrl . '/images/email_img_03.jpg'); ?>
                </td>
                <td class="right_td" style="width:255px; padding: 0; margin: 0; color:#888888; font-size:12px; line-height:17px;">support@darussalam.com</td>
            </tr>
            <tr class="footer_tr">
                <td class="left_td" style="width:25px; padding: 0; margin: 0; line-height:17px;">
                    <?php echo CHtml::image(Yii::app()->request->hostInfo . Yii::app()->theme->baseUrl . '/images/home_img_03.jpg'); ?>
                </td>
                <td class="right_td" style="width:255px; padding: 0; margin: 0; color:#888888; font-size:12px; line-height:17px;">Darussalam Publishers</td>
            </tr>
            <tr class="footer_tr">
                <td class="left_td" style="width:25px; padding: 0; margin: 0; line-height:17px;"></td>
                <td class="righ_td" style="width:255px; padding: 0; margin: 0; color:#888888; font-size:12px; line-height:17px;">is a multilingual international Islamic publishing house, with headquarters in Riyadh, Kingdom of Saudi Arabia.</td>
            </tr>
        </table>
    </div>

</div>

