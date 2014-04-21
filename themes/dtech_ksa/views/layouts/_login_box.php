
<div class="login_bx">                
    <?php
    $login_model = new LoginForm;
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'login_frm',
        'action' => Yii::app()->createUrl('/site/login'),
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    ));
    ?> 
    <fieldset id="body">
        <div class="pointer">
        </div>
        <fieldset>
            <label for="email"><?php echo Yii::t('common', 'Email', array(), NULL, Yii::app()->controller->currentLang); ?></label>
            <?php
            echo $form->textField($login_model, 'username', array("id" => "email"));
            echo $form->hiddenField($login_model, 'route', array("value" => Yii::app()->request->getUrl()));
            ?>
        </fieldset>
        <fieldset>
            <label for="password"><?php echo Yii::t('common', 'Password', array(), NULL, Yii::app()->controller->currentLang); ?></label>
            <?php
            echo $form->passwordField($login_model, 'password', array("id" => "password"));
            ?>
        </fieldset>
    </fieldset>
    <div class="login_img">


        <?php echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/login_t_img_03.png"), $this->createUrl('/web/hybrid/login/', array("provider" => "twitter")),array("onclick" => "dtech.doSocial('login_frm',this);return false;")); ?>
        <?php echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/login_in_img_03.png"), $this->createUrl('/web/hybrid/login/', array("provider" => "linkedin")),array("onclick" => "dtech.doSocial('login_frm',this);return false;")); ?>
        <?php echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/login_f_img_03.png", ''), $this->createUrl('/web/hybrid/login/', array("provider" => "facebook")),array("onclick" => "dtech.doSocial('login_frm',this);return false;")); ?>
        <?php echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/login_g_img_03.png"), $this->createUrl('/web/hybrid/login/', array("provider" => "google")),array("onclick" => "dtech.doSocial('login_frm',this);return false;")); ?>
    </div>

    <?php echo CHtml::submitButton(Yii::t('header_footer', 'User Login', array(), NULL, $this->currentLang), array("class" => "user_login_btn")); ?>
    <?php $this->endWidget(); ?>
</div>