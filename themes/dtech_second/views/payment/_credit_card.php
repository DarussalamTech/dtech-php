<div class="clear"></div>
<!--<h2 class="credit_card_fields">Credit Card</h2>-->

<div >
    <input type="hidden" name="sid" value="<?php echo Yii::app()->params['TwoCheckout']['sellerId']; ?>" />
    <input type="hidden" name="product_id" value="<?php echo Yii::app()->params['TwoCheckout']['sellerId']; ?>" />
    <input type="hidden" name="total" value="<?php echo $buyer_info['grand_total']; ?>" />    

    <!--<input type="hidden" name="cart_order_id" value="<?php //echo $buyer_info['order_id'];?>" />-->
    <input type="hidden" name="cart_order_id" value="<?php echo $buyer_info['order_id'];?>" />
    <input type="hidden" name="card_holder_name" value="<?php echo $buyer_info['user_full_name'];?>" />
    <input type="hidden" name="street_address" value="<?php echo $buyer_info['shipping_address1'];?>" />
    <input type="hidden" name="city" value="<?php echo $buyer_info['shipping_city'];?>" />
    <input type="hidden" name="state" value="<?php echo $buyer_info['shipping_state'];?>" />
    <input type="hidden" name="zip" value="<?php echo $buyer_info['shipping_zip'];?>" />
    <input type="hidden" name="country" value="<?php echo $buyer_info['shipping_country'];?>" />
    <input type="hidden" name="email" value="" />
    <input type="hidden" name="phone" value="<?php echo $buyer_info['shipping_phone'];?>" />
    <input type="hidden" name="ship_street_address" value="<?php echo $buyer_info['shipping_address1'];?>" />
    <input type="hidden" name="ship_city" value="<?php echo $buyer_info['shipping_city'];?>" />
    <input type="hidden" name="ship_state" value="<?php echo $buyer_info['shipping_state'];?>" />
    <input type="hidden" name="ship_zip" value="<?php echo $buyer_info['shipping_zip'];?>" />
    <input type="hidden" name="ship_country" value="<?php echo $buyer_info['shipping_country'];?>" />
    <?php   $i = 1; 
        foreach($buying_products AS $product){?>
    <input type="hidden" name="c_prod_<?php echo $i; ?>" value="<?php echo $i; ?>,<?php echo $product['product_quantity']; ?>" />    
    <input type="hidden" name="c_name_<?php echo $i; ?>" value="<?php echo $product['product_name']; ?>" />
    <input type="hidden" name="c_description_<?php echo $i; ?>" value="<?php echo $product['product_name']; ?>" />
    <input type="hidden" name="c_price_<?php echo $i; ?>" value="<?php echo $product['product_price']; ?>" />    
        
    <?php $i++;
            }?>



    <?php /* $i = 0; ?>
      <?php foreach ($products as $product) { ?>
      <input type="hidden" name="c_prod_<?php echo $i; ?>" value="<?php echo $product['product_id']; ?>,<?php echo $product['quantity']; ?>" />
      <input type="hidden" name="c_name_<?php echo $i; ?>" value="<?php echo $product['name']; ?>" />
      <input type="hidden" name="c_description_<?php echo $i; ?>" value="<?php echo $product['description']; ?>" />
      <input type="hidden" name="c_price_<?php echo $i; ?>" value="<?php echo $product['price']; ?>" />
      <?php $i++; ?>
      <?php } */ ?>
    <input type="hidden" name="id_type" value="1" />
    <?php /* if ($demo) { ?>
      <input type="hidden" name="demo" value="<?php echo $demo; ?>" />
      <?php } */ ?>
    <input type="hidden" name="return_url" value="<?php echo $this->createUrl('/web/payment/placeOrder');?>" />

    <!--<script>
        // Called when token created successfully.
        var successCallback = function(data) {
            console.log("token created successfully");
            console.log("success token data attr =>");
            console.log(data);
            var myForm = document.getElementById('myCCForm');

            // Set the token as the value for the token input
            myForm.token.value = data.response.token.token;

            // IMPORTANT: Here we call `submit()` on the form element directly instead of using jQuery to prevent and infinite token request loop.
            myForm.submit();
        };

        // Called when token creation fails.
        var errorCallback = function(data) {
            console.log("token creation with error");
            console.log(data);
            if (data.errorCode === 200) {
                tokenRequest();
            } else {
                alert(data.errorMsg);
            }
        };

        var tokenRequest = function() {
            // Setup token request arguments
            var args = {
                sellerId: "202363463",
                publishableKey: "C3E17998-5986-11E4-81C5-FB713A5D4FFE",
                ccNo: $("#ccNo").val(),
                cvv: $("#cvv").val(),
                expMonth: $("#expMonth").val(),
                expYear: $("#expYear").val()
            };

            // Make the token request
            TCO.requestToken(successCallback, errorCallback, args);
        };

        $(function() {
            console.log("on ready loading public key");
            // Pull in the public encryption key for our environment
            //TCO.loadPubKey('sandbox');
            TCO.loadPubKey('production');

            $("#myCCForm").submit(function(e) {
                // Call our token request function
                tokenRequest();

                // Prevent form from submitting
                return false;
            });
        });
    </script>
    -->
    <!--<h2>We accept Master Card, Visa, Discover and American Express.</h2>


    <div class="secure_input">
        <div class="secure_text">
            <article>
    <?php
    /* echo $form->labelEx($creditCardModel, "first_name");
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
      '20' => '2020',post
      );
      echo $form->dropDownList($creditCardModel, 'exp_year', $exp_years);
      echo $form->error($creditCardModel, 'exp_year'); */
    ?>
        </div>
    </div>-->

</div>