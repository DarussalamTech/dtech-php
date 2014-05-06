<?php
/* @var $this NotifcationController */
/* @var $model Notifcation */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    ));
    ?>




    <div class="row tag-it-row">
        <?php
        $admin_users = User::model()->getAll(" (role_id = 2 OR role_id = 1 ) AND  user_id <> " . Yii::app()->user->id);
        $admin_users = CHtml::listData($admin_users, "user_email", "user_email");
        $admin_users = CJSON::encode($admin_users);

        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/media/tag/css/jquery.tagit.css');
        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/media/tag/css/tagit.ui-zendesk.css');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/packages/jui/js/jquery-ui.min.js');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/media/tag/js/tag-it.js', CClientScript::POS_END);

        if ($model->type == "inbox" || $model->type == "") {

            echo $form->hiddenField($model,"type",array("value"=>"inbox"));
            Yii::app()->clientScript->registerScript('tag', "
        
                var users = $admin_users;
                emails_arr = new Array()
                for ( user in users){
                    emails_arr.push(user)
                }

                $(function(){
                     $('#Notifcation_from').tagit({
                        availableTags: emails_arr
                    });
                })

            ", CClientScript::POS_END);
            echo $form->label($model, 'from');
            echo $form->textField($model, 'from', array('size' => 60, 'maxlength' => 255));
        } else if ($model->type == "sent") {
            Yii::app()->clientScript->registerScript('tag', "
        
                var users = $admin_users;
                emails_arr = new Array()
                for ( user in users){
                    emails_arr.push(user)
                }

                $(function(){
                     $('#Notifcation_to').tagit({
                        availableTags: emails_arr
                    });
                })

            ", CClientScript::POS_END);
            echo $form->label($model, 'to');
            echo $form->hiddenField($model,"type",array("value"=>"sent"));
            echo $form->textField($model, 'to', array('size' => 60, 'maxlength' => 255));
        }
        ?>
    </div>
    <div class="clear_from_tag_five"></div>
    <div class="row">
        <?php echo $form->label($model, 'subject'); ?>
        <?php echo $form->textField($model, 'subject', array('size' => 5, 'maxlength' => 5)); ?>
    </div>


    <div class="row buttons">
        <?php echo CHtml::submitButton('Search', array("class" => "btn")); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->
