<div class="shipping_box">
    <p>
        <span style='font-weight:bold;width:210px;float:left;'>Shipping Procedure (DHL)</span>
        <span style='font-weight:bold;margin-left:50px;'></span>
        <b>
            Total Weight: <?php echo $total_weight; ?> kg
        </b>
        <span class="clear"></span>

    </p>
    <?php
    if (isset($zone_rate)):
        ?>
        <p>
            <span style='font-weight:bold;width:210px;float:left;'>Rate at <?php echo $zone_rate[1]->weight; ?>kg</span>
            <span style='font-weight:bold;margin-left:50px;'></span>
            <b>
                <?php echo $zone_rate[1]->rate; ?>
            </b>
            <span class="clear"></span>

        </p>
        <p>
            <span style='font-weight:bold;width:210px;float:left;'>Rate after <?php echo $zone_rate[1]->weight; ?> per kg</span>
            <span style='font-weight:bold;margin-left:50px;'></span>
            <b>
                <?php echo $zone_rate[0]->rate; ?>
            </b>
            <span class="clear"></span>

        </p>
        <p>
            <span style='font-weight:bold;width:210px;float:left;'>Final Shipping formula </span>
            <span style='font-weight:bold;margin-left:50px;'></span>
            <b>

                <?php
                echo $zone_rate[1]->rate . " + (" . $zone_rate[0]->rate . " X (" . $total_weight . " - " . $zone_rate[1]->weight . "))";
                ?>
            </b>
            <span class="clear"></span>

        </p>
        <?php
    elseif (isset($zone_single_rate)):
        ?>
        <p>
            <span class="p-values">Rate at <?php echo $total_weight; ?> kg</span>
            <span  class="p-values"></span>
            <?php
            if ($useCurrency != "") {
                $conversion = (double)str_replace(",","",$zone_single_rate->rate);
                //echo "<b class='p-values'>" . $useCurrency . " " . ConfPaymentMethods::model()->convertCurrency($conversion, Yii::app()->session['currency'], $useCurrency) . "</b>";
            }
            ?>
            <b  class="p-values">
                <?php echo Yii::app()->session['currency'] . " " . $zone_single_rate->rate; ?>
            </b>

            <span class="clear"></span>

        </p>
        <?php
    endif;
    ?>  
</div>