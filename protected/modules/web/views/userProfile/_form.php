<div id="book_content">
    <div id="book_main_content">
        <div class="left_book_main_content">
            <?php
            echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/darussalam-inner-logo.png", 'logo'), $this->createUrl('/site/storehome', array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'])));
            ?>
        </div>
        <div class="search_box">

            <?php echo CHtml::textField('textsearch', '', array('placeholder' => 'Search keywords or image ids...', 'class' => 'search_text')); ?>
            <?php echo CHtml::button('', array('class' => 'search_btn')); ?>
            <?php echo CHtml::image(Yii::app()->theme->baseUrl . "/images/searching_img_03.jpg", '', array('class' => 'searching_img')) ?>
        </div>
        <nav>
            <ul>
                <?php
                echo CHtml::openTag("li");
                $require_pages = array("About Us", "Help");

                foreach ($this->webPages as $page) {
                    if (in_array($page->title, $require_pages)) {

                        echo CHtml::link($page->title, Yii::app()->createUrl('/web/page/viewPage/', array("id" => $page->id)));
                    }
                }
                echo CHtml::link('Contact Us', $this->createUrl('/site/contact'));
                echo CHtml::closeTag("li");
                ?>
            </ul>
        </nav>
    </div>
</div>
<div id="accounts">
    <div id="account_detail">
        <h5>Account Details</h5>
        <?php
        if (Yii::app()->user->hasFlash('profie_success')) {
            echo Yii::app()->user->getFlash('profie_success');
        }
        ?>
        <div id="page-wrap">
            <div class="tabs">
                <div class="tab">
                    <?php echo CHtml::radioButton('tab-group-1', 'checked', array('id' => 'tab-1')) ?>
                    <label for="tab-1" class="tab1">Profile</label>
                    <div class="conten">

                        <?php
                        $form = $this->beginWidget(
                                'CActiveForm', array('id' => 'upload-form',
                            'enableAjaxValidation' => false,
                            'htmlOptions' => array('enctype' => 'multipart/form-data'),
                                )
                        );
                        ?>
<!--                    <p class="note">Fields with <span class="required">*</span> are required.</p>-->
                        <?php //echo $form->errorSummary($model);  ?>
                        <table width="100%">
                            <tr>
                                <td>
                                    <table width="90%">
                                        <tr class="account_row">
                                            <td class="account_left">Email:</td>
                                            <td class="account_right">
                                                <span>
                                                    <?php echo Yii::app()->user->name; ?>
                                                </span></td>
                                        </tr>

                                        <tr class="account_row">
                                            <td class="account_left"></td>
                                            <td class="account_right">
                                                <?php echo CHtml::link('Change Password', $this->createUrl('/web/user/changePass')) ?>
                                            </td>
                                        </tr>
                                        <tr class="account_row">
                                            <td class="account_left" valign="top">
                                                Profile Picture
                                            </td>
                                            <td class="account_right">
                                                <?php
                                                echo CHtml::image($model->uploaded_img, '', array(
                                                    "width" => "80",
                                                    "height" => "80",
                                                    "style" => "cursor:pointer",
                                                    "onclick" => "$('#UserProfile_avatar').trigger('click')",
                                                ));
                                                ?>
                                            </td>
                                        </tr>
                                        <tr class="account_row" style="display:none">
                                            <td class="account_left">
                                                Change Image:
                                            </td>
                                            <td class="account_right">
                                                <?php echo $form->fileField($model, 'avatar'); ?>
                                            </td>
                                        </tr>

                                        <tr class="account_row">
                                            <td class="account_left">
                                                <?php
                                                echo $model->getAttributeLabel('first_name');
                                                ?>
                                            </td>
                                            <td class="account_right">
                                                <?php echo $form->textField($model, 'first_name', array('class' => 'account_text')); ?>
                                            </td>
                                        </tr>
                                        <tr class="account_row">
                                            <td class="account_left">
                                                <?php
                                                echo $model->getAttributeLabel('last_name');
                                                ?>
                                            </td>
                                            <td class="account_right">
                                                <?php echo $form->textField($model, 'last_name', array('class' => 'account_text')); ?>
                                            </td>
                                        </tr>
                                        <tr class="account_row">
                                            <td class="account_left" >
                                                <?php
                                                echo $model->getAttributeLabel('gender');
                                                ?>
                                            </td>
                                            <td class="account_right">
                                                <?php
                                                echo $form->dropDownList($model, 'gender', array('male' => 'Male', 'female' => 'Female'), $htmlOptions = array('class' => 'account_prefix', 'options' => array('1' => array('selected' => true))));
                                                ?>
                                            </td>
                                        </tr>
                                        <tr class="account_row">
                                            <td class="account_left">
                                                <?php
                                                echo $model->getAttributeLabel('date_of_birth');
                                                ?>
                                            </td>
                                            <td class="account_right">
                                                <?php
                                                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                                    'model' => $model,
                                                    'attribute' => 'date_of_birth',
                                                    'options' => array(
                                                        'mode' => 'focus',
                                                        'dateFormat' => Yii::app()->params['dateformat'],
                                                        'buttonImage' => Yii::app()->baseUrl . '/images/date_picker.png',
                                                        'buttomImageOnly' => true,
                                                        'buttonText' => '',
                                                        'showAnim' => 'fold',
                                                        'showOn' => 'button',
                                                        'showButtonPanel' => false,
                                                        'showAnim' => 'slideDown',
                                                        'changeYear' => true,
                                                        'changeMonth' => true,
                                                        'yearRange' => '1930',
                                                    ),
                                                    'htmlOptions' => array(
                                                        'size' => '15', // textField size
                                                        //'value' => date("d F, Y"),
                                                        'maxlength' => '10', // textField maxlength
                                                        'class' => 'account_text', // textField maxlength
                                                        'readOnly' => TRUE,
                                                        'style' => 'width:210px',
                                                    ),
                                                ));
                                                ?>
                                            </td>
                                        </tr>
                                        <tr class="account_row">
                                            <td class="account_left">
                                                <?php
                                                echo $model->getAttributeLabel('address');
                                                ?>
                                            </td>
                                            <td class="account_right">
                                                <?php echo $form->textField($model, 'address', array('class' => 'account_text')); ?>
                                            </td>
                                        </tr>
                                        <tr class="account_row">
                                            <td class="account_left">
                                                <?php
                                                echo $model->getAttributeLabel('address_2');
                                                ?>
                                            </td>
                                            <td class="account_right">
                                                <?php echo $form->textField($model, 'address_2', array('class' => 'account_text')); ?>
                                            </td>
                                        </tr>
                                        <tr class="account_row">
                                            <td class="account_left">
                                                <?php
                                                echo $model->getAttributeLabel('country');
                                                ?>
                                            </td>
                                            <?php $lstData = CHtml::listData(Country::model()->findAll(), 'country_name', 'country_name') ?>
                                            <td class="account_right">
                                                <?php echo $form->dropDownList($model, 'country', $lstData, $htmlOptions = array('class' => 'account_country')); ?>
                                            </td>
                                        </tr>
                                        <tr class="account_row">
                                            <td class="account_left">
                                                <?php
                                                echo $model->getAttributeLabel('city');
                                                ?>
                                            </td>
                                            <td class="account_right">
                                                <?php echo $form->textField($model, 'city', array('class' => 'account_text')); ?>
                                            </td>
                                        </tr>
                                        <tr class="account_row">
                                            <td class="account_left">
                                                <?php
                                                echo $model->getAttributeLabel('state_province');
                                                ?>
                                            </td>
                                            <td class="account_right">
                                                <?php echo $form->textField($model, 'state_province', array('class' => 'account_text')); ?>
                                            </td>
                                        </tr>
                                        <tr class="account_row">
                                            <td class="account_left">
                                                <?php
                                                echo $model->getAttributeLabel('zip_code');
                                                ?>
                                            </td>
                                            <td class="account_right">
                                                <?php echo $form->textField($model, 'zip_code', array('class' => 'account_text')); ?>
                                            </td>
                                        </tr>
                                        <tr class="account_row">
                                            <td class="account_left">
                                                <?php
                                                echo $model->getAttributeLabel('contact_number');
                                                ?>
                                            </td>
                                            <td class="account_right">
                                                <?php echo $form->textField($model, 'contact_number', array('class' => 'account_text')); ?>
                                            </td>
                                        </tr>
                                        <tr class="account_row">
                                            <td class="account_left">
                                                <?php
                                                echo $model->getAttributeLabel('mobile_number');
                                                ?>
                                            </td>
                                            <td class="account_right">
                                                <?php echo $form->textField($model, 'mobile_number', array('class' => 'account_text')); ?>
                                            </td>
                                        </tr>
                                        <tr class="account_row">
                                            <td class="account_left">
                                                <b>
                                                    <?php
                                                    echo $model->getAttributeLabel('is_shipping_address');
                                                    ?>
                                                </b>
                                            </td>
                                            <td class="account_right">
                                                <?php echo $form->checkBox($model, 'is_shipping_address', array('class' => 'account_text')); ?>
                                            </td>
                                        </tr>
                                        <tr class="account_row">
                                            <td class="account_left">

                                            </td>
                                            <td class="account_right">
                                                <?php echo CHtml::submitButton($model->isNewRecord ? 'Save' : 'Save', $htmlOptions = array('class' => 'account_save')); ?>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <?php $this->endWidget(); ?> </table>
                    </div>

                </div>
                <div class="tab" style="display: none">
                    <input type="radio" id="tab-2" name="tab-group-1">
                    <label for="tab-2">Shipping Address</label>
                    <div class="conten">
                        <table width="100%">
                            <tr>
                                <td>
                                    <table width="90%">
                                        <tr class="account_row">
                                            <td class="account_left">Prefix</td>
                                            <td class="account_right"><select class="account_prefix"><option>Mr.</option><option>Mrs.</option></select></td>
                                        </tr>
                                        <tr class="account_row">
                                            <td class="account_left">First Name</td>
                                            <td class="account_right"><input type="text" class="account_text"></td>
                                        </tr>
                                        <tr class="account_row">
                                            <td class="account_left">Last Name</td>
                                            <td class="account_right"><input type="text" class="account_text"></td>
                                        </tr>
                                        <tr class="account_row">
                                            <td class="account_left">Date Of Birth</td>
                                            <td class="account_right"><input type="text" class="account_text"></td>
                                        </tr>
                                        <tr class="account_row">
                                            <td class="account_left">Address Line 1</td>
                                            <td class="account_right"><input type="text" class="account_text"></td>
                                        </tr>
                                        <tr class="account_row">
                                            <td class="account_left">Address Line 2</td>
                                            <td class="account_right"><input type="text" class="account_text"></td>
                                        </tr>
                                        <tr class="account_row">
                                            <td class="account_left">Country</td>
                                            <td class="account_right"><select class="account_country"><option>Pakistan</option><option>1</option><option>1</option></select></td>
                                        </tr>
                                        <tr class="account_row">
                                            <td class="account_left">City</td>
                                            <td class="account_right"><input type="text" class="account_text"></td>
                                        </tr>
                                        <tr class="account_row">
                                            <td class="account_left">State/Province</td>
                                            <td class="account_right"><select class="account_country"><option>Pakistan</option><option>1</option><option>1</option></select></td>
                                        </tr>
                                        <tr class="account_row">
                                            <td class="account_left">Zip/Postal Code</td>
                                            <td class="account_right"><input type="text" class="account_text"></td>
                                        </tr>
                                        <tr class="account_row">
                                            <td class="account_left">Telephone Number</td>
                                            <td class="account_right"><input type="text" class="account_text"></td>
                                        </tr>
                                        <tr class="account_row">
                                            <td class="account_left"></td>
                                            <td class="account_right"><input type="button" value="Save" class="account_save"></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div> 
                </div>
                <div class="tab" style="display: none">
                    <input type="radio" id="tab-3" name="tab-group-1">
                    <label for="tab-3">Preferences</label>
                    <div class="conten">
                        <p>Preferences</p>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .ui-datepicker-trigger {
        width:25px;
        margin-left: 2px;
    }
    #upload-form table td.account_right {
        width: 240px;
    }
</style>