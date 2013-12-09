<?php
/* @var $this ShippingClassController */
/* @var $model ShippingClass */
/* @var $form CActiveForm */
?>

<div class="form wide">

    <?php
    Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/gridform.css');
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'shipping-class-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>
    <?php
    echo $form->errorSummary($model);
    ?>
    <div  class="subform">
        <div class="main">
            <!--        <div class="head">Field Force Labors</div>-->
            <div class="form_body">
                <div class="grid_container" >
                    <div class="grid_title">
                        <div class="title" style="width:300px"><?php echo $form->labelEx($model, 'title'); ?></div>

                    </div>
                    <div class="clear"></div>
                    <div class="grid_fields">
                        <div class="field" style="width:300px">
                            <?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 255)); ?>
                        </div>


                    </div>
                    <div class="clear"></div>

                    <div class="grid_title">
                        <div class="title" style="width:300px"><?php echo $form->labelEx($model, 'source_city'); ?></div>
                        <div class="title" style="width:300px"><?php echo $form->labelEx($model, 'destination_city'); ?></div>
                    </div>


                    <div class="clear"></div>
                    <div class="grid_fields">
                        <div class="field" style="width:300px">
                            <?php
                            $city = City::model()->findByPk(Yii::app()->session['city_id']);
                            echo CHtml::label($city->city_name, $city->city_name, array("style" => "margin-left:12px"));
                            echo $form->hiddenField($model, 'source_city', array("value" => Yii::app()->session['city_id']));
                            ?>
                        </div>
                        <div class="field" style="width:300px">
                            <?php
                            echo $form->dropDownList($model, 'destination_city', array(Yii::app()->session['city_id'] => "Same as source", "0" => "Out of Source"));
                            ?>
                        </div>

                    </div>
                </div>
                <div class="clear"></div>
                <div class="grid_container <?php echo ($model->is_fix_shpping == 1 && $model->is_post_find == 1) || $model->is_no_selected ? "show_ship_type" : "hide_ship_type" ?>" id="fix_based" >
                    <div class="grid_title">
                        <div class="title" style="width:300px"><?php echo $form->labelEx($model, 'is_fix_shpping'); ?></div>
                        <div class="title" style="width:300px"><?php echo $form->labelEx($model, 'fix_shipping_cost'); ?></div>

                    </div>
                    <div class="clear"></div>
                    <div class="grid_fields">
                        <div class="field" style="width:300px">
                            <?php echo $form->checkBox($model, 'is_fix_shpping', array("onclick" => "dtech.disableShippingMethod(this)")); ?>
                        </div>
                        <div class="field" style="width:300px">
                            <?php echo $form->textField($model, 'fix_shipping_cost', array('size' => 60, 'maxlength' => 255)); ?>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>

                <div class="grid_container <?php echo $model->is_pirce_range == 1 && $model->is_post_find == 1 || $model->is_no_selected ? "show_ship_type" : "hide_ship_type" ?>" id="range_based" >
                    <div class="grid_title">
                        <div class="title" style="width:300px"><?php echo $form->labelEx($model, 'is_pirce_range'); ?></div>
                        <div class="title" style="width:300px"><?php echo $form->labelEx($model, 'price_range_shipping_cost'); ?></div>

                    </div>
                    <div class="clear"></div>
                    <div class="grid_fields">
                        <div class="field" style="width:300px">
                            <?php echo $form->checkBox($model, 'is_pirce_range', array("onclick" => "dtech.disableShippingMethod(this)")); ?>
                        </div>
                        <div class="field" style="width:300px">
                            <?php echo $form->textField($model, 'price_range_shipping_cost'); ?>
                        </div>
                    </div>

                    <div class="clear"></div>

                    <div class="grid_title">
                        <div class="title" style="width:300px"><?php echo $form->labelEx($model, 'start_price'); ?></div>
                        <div class="title" style="width:300px"><?php echo $form->labelEx($model, 'end_price'); ?></div>
                    </div>
                    <div class="clear"></div>
                    <div class="grid_fields">
                        <div class="field" style="width:300px">
                            <?php echo $form->textField($model, 'start_price', array('size' => 60, 'maxlength' => 255)); ?>
                        </div>
                        <div class="field" style="width:300px">
                            <?php echo $form->textField($model, 'end_price', array('size' => 60, 'maxlength' => 255)); ?>
                        </div>

                    </div>
                </div>
                <div class="clear"></div>
                <div class="grid_container <?php echo $model->is_weight_based == 1 && $model->is_post_find == 1 || $model->is_no_selected ? "show_ship_type" : "hide_ship_type" ?>" id="weight_based">
                    <div class="grid_title">
                        <div class="title" style="width:300px"><?php echo $form->labelEx($model, 'is_weight_based'); ?></div>
                        <div class="title" style="width:300px"><?php echo $form->labelEx($model, 'weight_range_shipping_cost'); ?></div>

                    </div>
                    <div class="clear"></div>
                    <div class="grid_fields">
                        <div class="field" style="width:300px">
                            <?php echo $form->checkBox($model, 'is_weight_based', array("onclick" => "dtech.disableShippingMethod(this)")); ?>
                        </div>
                        <div class="field" style="width:300px">
                            <?php echo $form->textField($model, 'weight_range_shipping_cost'); ?>
                        </div>


                    </div>
                    <div class="clear"></div>

                    <div class="grid_title">
                        <div class="title" style="width:300px"><?php echo $form->labelEx($model, 'min_weight_id'); ?></div>
                        <div class="title" style="width:300px"><?php echo $form->labelEx($model, 'max_weight_id'); ?></div>
                    </div>
                    <div class="clear"></div>
                    <div class="grid_fields">
                        <div class="field" style="width:300px">
                            <?php
                                $criteria = new CDbCriteria();
                                $criteria->select = "id,type,title";
                                $criteria->condition = "type='weight'";
                                $prod_pro = ConfProducts::model()->findAll($criteria);
                                
                                echo $form->dropDownList($model, 'min_weight_id', CHtml::listData($prod_pro,"id", "title"));
                            ?>
                        </div>
                        <div class="field" style="width:300px">
                            <?php echo $form->dropDownList($model, 'max_weight_id', CHtml::listData($prod_pro,"id", "title")); ?>
                        </div>

                    </div>
                </div>
                <div class="clear"></div>

                <div class="grid_container">
                    <div class="grid_title">
                        <div class="title" style="width:300px"><?php echo $form->labelEx($model, 'categories'); ?></div>
                        <div class="title" style="width:300px"><?php echo $form->labelEx($model, 'class_status'); ?></div>
                    </div>
                    <div class="clear"></div>
                    <div class="grid_fields">
                        <div class="field" style="width:300px">
                            <?php
                            echo
                            $form->ListBox($model, 'categories', CHtml::listData(Categories::model()->getMenuParentCategories(), "category_id", "category_name"), array("multiple" => "multiple"));
                            ?>
                        </div>
                        <div class="field" style="width:300px">
                            <?php echo $form->dropDownList($model, 'class_status', array("0" => "Disable", "1" => "Enable")); ?>
                        </div>

                    </div>
                </div>

                <div class="clear"></div>

            </div>
        </div>
    </div>


    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array("class" => "btn")); ?>
    </div>

    <?php
    //CVarDumper::dump($model->getErrors(),10,true);
    $this->endWidget();
    ?>

</div><!-- form -->