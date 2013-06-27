<?php
/**
 * form for getting PAYMENT METHOD detail
 * 
 */
?>
<div class="left_method" style="display: none;">
    <?php
    $this->renderPartial("_credit_card", array(
        "model" => $model,
        "form" => $form,
        "creditCardModel" => $creditCardModel)
    );
    ?>
    <?php
    $this->renderPartial("_paypal", array("model" => $model, "form" => $form));
    ?>
    <?php
    $this->renderPartial("_manual", array("model" => $model, "form" => $form));
    ?>

</div>
