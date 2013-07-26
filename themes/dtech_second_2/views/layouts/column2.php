<?php $this->beginContent('//layouts/main'); ?>

<div id="content">
    <?php echo $content; ?>
    <?php echo $this->renderPartial("//layouts/_footer") ?>
</div>
<?php $this->endContent(); ?>