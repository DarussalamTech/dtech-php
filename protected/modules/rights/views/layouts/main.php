<?php $this->beginContent("//layouts/column2"); ?>

<div id="rights" class="container">
    <div class="span-5 last">
        <div id="sidebar">
            <?php if ($this->id !== 'install'): ?>
                <?php $this->renderPartial('/_menu'); ?>

            <?php endif; ?>
        </div><!-- sidebar -->
    </div>

    <div class="span-18">
        <div id="content">



            <?php $this->renderPartial('/_flash'); ?>

            <?php echo $content; ?>

        </div><!-- content -->
    </div>


</div>

<?php $this->endContent(); ?>