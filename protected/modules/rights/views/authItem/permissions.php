<?php
$this->breadcrumbs = array(
    'Rights' => Rights::getBaseUrl(),
    Rights::t('core', 'Permissions'),
);
?>

<div id="permissions">

    <h2><?php echo Rights::t('core', 'Permissions'); ?></h2>

    <p>
        <?php echo Rights::t('core', 'Here you can view and manage the permissions assigned to each role.'); ?><br />
        <?php
        echo Rights::t('core', 'Authorization items can be managed under {roleLink}, {taskLink} and {operationLink}.', array(
            '{roleLink}' => CHtml::link(Rights::t('core', 'Roles'), array('authItem/roles')),
            '{taskLink}' => CHtml::link(Rights::t('core', 'Tasks'), array('authItem/tasks')),
            '{operationLink}' => CHtml::link(Rights::t('core', 'Operations'), array('authItem/operations')),
        ));
        ?>
    </p>
    <div class="clear"></div>

    <div class="form wide">
<?php
$this->renderPartial("_role_change_form", array("model" => $roleModel));
?>
    </div>

    <p><?php
        if (Yii::app()->user->isSuperuser):
            echo CHtml::link(Rights::t('core', 'Generate items for controller actions'), array('authItem/generate'), array(
                'class' => 'generator-link',
            ));
        endif;
        ?></p>

    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'dataProvider' => $dataProvider,
        'template' => '{items}',
        'emptyText' => Rights::t('core', 'No authorization items found.'),
        'htmlOptions' => array('class' => 'grid-view permission-table'),
        'columns' => $columns,
    ));
    ?>

    <p class="info">*) <?php echo Rights::t('core', 'Hover to see from where the permission is inherited.'); ?></p>
    <?php
        Yii::app()->clientScript->registerScript('rights_module_tooltip_grid', "
            jQuery(function(){
            
                /**
                 * Attach the tooltip to the inherited items.
                 */
                jQuery('.inherited-item').rightsTooltip({
                    title: '".Rights::t('core', 'Source').":'
                });

                /**
                 * Hover functionality for rights' tables.
                 */
                jQuery('#rights tbody tr').hover(function() {
                    jQuery(this).addClass('hover'); // On mouse over
                }, function() {
                    jQuery(this).removeClass('hover'); // On mouse out
                });
            
            })
        
        ",CClientScript::POS_END);
    ?>
    <script type="text/javascript">

  

    </script>

</div>
