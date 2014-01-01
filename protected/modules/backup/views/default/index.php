
<div class="pading-bottom-5">
    <div class="left_float">
        <h1>Back Up Module</h1>
    </div>
    <div class = "right_float">
        <span class="creatdate">
            <?php
            echo CHtml::link('Data Base (.sql)', array('/backup/default/backUpSql'), array('class' => "print_link_btn"));
            echo CHtml::link('Images (zip/gz)', array('/backup/default/backUpImage'), array('class' => "print_link_btn"));

            echo CHtml::link('All Back-ups', array('/backup/default/allBackup'), array('class' => "print_link_btn"));

            echo CHtml::link('Download Sql Back-up', array('/backup/default/downloadBackUpSql'), array('class' => "print_link_btn"));

            echo CHtml::link('Download Image Back-up', array('/backup/default/downloadImageBackup'), array('class' => "print_link_btn"));
            ?>
        </span>
    </div>
</div>

<div class="clear"></div>
<div id="statusMsg" style="width: 100%;">
    <?php if (Yii::app()->user->hasFlash('back_up')): ?>
        <br/>
        <div class="flash-success">
            <?php echo Yii::app()->user->getFlash('back_up'); ?>
        </div>
    <?php endif; ?>

</div>