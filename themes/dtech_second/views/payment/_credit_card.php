<div class="clear"></div>
<h2 class="credit_card_fields">Credit Card</h2>
<div class="under_left_method credit_card_fields" >
    <h2>We accept Master Card, Visa, Discover and American Express.</h2>


    <div class="secure_input">
        <div class="secure_text">
            <article>
                <?php
                echo $form->labelEx($creditCardModel, "first_name");
                ?>
            </article>
        </div>
        <div class="secure_input_type">
            <?php
            echo $form->textField($creditCardModel, "first_name");
            ?>
        </div>
    </div>
    <div class="secure_input">
        <div class="secure_text">
            <article>
                <?php
                echo $form->labelEx($creditCardModel, "last_name");
                ?>
            </article>
        </div>
        <div class="secure_input_type">
            <?php
            echo $form->textField($creditCardModel, "last_name");
            ?>
        </div>
    </div>
    <div class="secure_input">
        <div class="secure_text">
            <article>
                <?php
                echo $form->labelEx($creditCardModel, "card_number1");
                ?>
            </article>
        </div>
        <div class="secure_input_type">
            <?php
            echo $form->textField($creditCardModel, "card_number1", array("style" => "width:20%"));
            ?>
            <?php
            echo $form->textField($creditCardModel, "card_number2", array("style" => "width:20%"));
            ?>
            <?php
            echo $form->textField($creditCardModel, "card_number3", array("style" => "width:20%"));
            ?>
            <?php
            echo $form->textField($creditCardModel, "card_number4", array("style" => "width:20%"));
            ?>

            <?php echo $form->error($creditCardModel, 'card_number1'); ?>
            <?php echo $form->error($creditCardModel, 'card_number2'); ?>
            <?php echo $form->error($creditCardModel, 'card_number3'); ?>
            <?php echo $form->error($creditCardModel, 'card_number4'); ?>
        </div>
    </div>
    <div class="secure_input">
        <div class="secure_text">
            <article>
                <?php
                echo $form->labelEx($creditCardModel, "cvc");
                ?>
            </article>
        </div>
        <div class="secure_input_type">
            <?php
            echo $form->textField($creditCardModel, "cvc");
            ?>
        </div>
    </div>

    <div class="secure_input">
        <div class="secure_text">
            <article>
                <?php
                echo $form->labelEx($creditCardModel, "exp_month");
                ?>
            </article>
        </div>
        <div class="secure_input_type">
            <?php
            $exp_months = array(
                '01' => '01',
                '02' => '02',
                '03' => '03',
                '04' => '04',
                '05' => '05',
                '06' => '06',
                '07' => '07',
                '08' => '08',
                '09' => '09',
                '10' => '10',
                '11' => '11',
                '12' => '12',
            );
            echo $form->dropDownList($creditCardModel, 'exp_month', $exp_months);
            echo $form->error($creditCardModel, 'exp_month');
            ?>
        </div>
    </div>
    <div class="secure_input">
        <div class="secure_text">
            <article>
                <?php
                echo $form->labelEx($creditCardModel, "exp_year");
                ?>
            </article>
        </div>
        <div class="secure_input_type">
            <?php
            $exp_years = array(
                '13' => '2013',
                '14' => '2014',
                '15' => '2015',
                '16' => '2016',
                '17' => '2017',
                '18' => '2018',
                '19' => '2019',
                '20' => '2020',
            );
            echo $form->dropDownList($creditCardModel, 'exp_year', $exp_years);
            echo $form->error($creditCardModel, 'exp_year');
            ?>
        </div>
    </div>

</div>