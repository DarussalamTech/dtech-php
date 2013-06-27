<h2>
    Hi 

    <?php
    echo $customerInfo['shipping_prefix'] . " " . $customerInfo['shipping_first_name'];
    ?>
</h2>
<table>
    <tr class="main_header">
        <td class="right_td" style="width:255px; padding: 0; margin: 0; color:#888888; font-size:14px; line-height:17px;">
            First  Name:   
        </td>
        <td class="right_td" style="width:255px; padding: 0; margin: 0; color:#888888; font-size:14px; line-height:17px;">
            <?php echo $customerInfo['shipping_first_name']; ?>   
        </td>
    </tr>
    <tr class="main_header">
        <td class="right_td" style="width:255px; padding: 0; margin: 0; color:#888888; font-size:14px; line-height:17px;">
            Last Name:   
        </td>
        <td class="right_td" style="width:255px; padding: 0; margin: 0; color:#888888; font-size:14px; line-height:17px;">
            <?php echo $customerInfo['shipping_last_name']; ?>   
        </td>
    </tr>
    <tr class="main_header">
        <td class="right_td" style="width:255px; padding: 0; margin: 0; color:#888888; font-size:14px; line-height:17px;">
            Email:   
        </td>
        <td class="right_td" style="width:255px; padding: 0; margin: 0; color:#888888; font-size:14px; line-height:17px;">
            <?php echo Yii::app()->user->name ?>   
        </td>
    </tr>

    <tr class="main_header">
        <td class="right_td" style="width:255px; padding: 0; margin: 0; color:#888888; font-size:14px; line-height:17px;">
            Address:   
        </td>
        <td class="right_td" style="width:255px; padding: 0; margin: 0; color:#888888; font-size:14px; line-height:17px;">
            <?php echo $customerInfo['shipping_address1'] . ' ' . $customerInfo['shipping_address2']; ?>   
        </td>
    </tr>
    <tr class="main_header">
        <td class="right_td" style="width:255px; padding: 0; margin: 0; color:#888888; font-size:14px; line-height:17px;">
            Shipping Country/State:   
        </td>
        <td class="right_td" style="width:255px; padding: 0; margin: 0; color:#888888; font-size:14px; line-height:17px;">
            <?php
            $region = Region::model()->findByPk($customerInfo['shipping_country']);
            echo $region->name . '/' . $customerInfo['shipping_state'];
            ?>   
        </td>
    </tr>
    <tr class="main_header">
        <td class="right_td" style="width:255px; padding: 0; margin: 0; color:#888888; font-size:14px; line-height:17px;">
            Shipping City:   
        </td>
        <td class="right_td" style="width:255px; padding: 0; margin: 0; color:#888888; font-size:14px; line-height:17px;">
            <?php echo $customerInfo['shipping_city']; ?>   
        </td>
    </tr>
    <tr class="main_header">
        <td class="right_td" style="width:255px; padding: 0; margin: 0; color:#888888; font-size:14px; line-height:17px;">
            Shipping Zip Code:   
        </td>
        <td class="right_td" style="width:255px; padding: 0; margin: 0; color:#888888; font-size:14px; line-height:17px;">
            <?php echo $customerInfo['shipping_zip']; ?>   
        </td>
    </tr>
    <tr class="main_header">
        <td class="right_td" style="width:255px; padding: 0; margin: 0; color:#888888; font-size:14px; line-height:17px;">
            Shipping Phone:   
        </td>
        <td class="right_td" style="width:255px; padding: 0; margin: 0; color:#888888; font-size:14px; line-height:17px;">
            <?php echo $customerInfo['shipping_phone']; ?>   
        </td>
    </tr>
    <tr class="main_header">
        <td class="right_td" style="width:255px; padding: 0; margin: 0; color:#888888; font-size:14px; line-height:17px;">
            Total Amounts:   
        </td>
        <td class="right_td" style="width:255px; padding: 0; margin: 0; color:black; font-size:14px; line-height:17px;font-weight: bold">
            <?php echo 'USD ' . Yii::app()->session['total_price']; ?>   
        </td>
    </tr>
</table>