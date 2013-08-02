<?php 
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/pages.css');

/**
 * product preview
 */
if ($this->action->id == "pagesPreview") {
    Yii::app()->clientScript->registerScript('disabled', "
            dtech.disabledPrview();
        ", CClientScript::POS_READY);
}
?>
<div class="page_content">
    <h2><?php echo $page->title; ?></h2>
    <?php echo $page->content;?>
</div>
