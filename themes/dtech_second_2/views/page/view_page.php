
<?php
$this->webPcmWidget['filter'] = array('name' => 'DtechSecondSidebar',
    'attributes' => array(
        'cObj' => $this,
        'cssFile' => Yii::app()->theme->baseUrl . "/css/side_bar.css",
        'is_cat_filter' => 1,
        ));
?>
<?php
$this->webPcmWidget['best'] = array('name' => 'DtechBestSelling',
    'attributes' => array(
        'cObj' => $this,
        'cssFile' => Yii::app()->theme->baseUrl . "/css/side_bar.css",
        'is_cat_filter' => 0,
        ));

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
