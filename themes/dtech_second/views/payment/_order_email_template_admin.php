<h3>
  Following Order has  been placed , Please review this order
</h3>
<table>

    <tr class="main_header">
        <td class="right_td" style="width:255px; padding: 0; margin: 0; color:#888888; font-size:14px; line-height:17px;">
            Customer Email:   
        </td>
        <td class="right_td" style="width:255px; padding: 0; margin: 0; color:#888888; font-size:14px; line-height:17px;">
            <?php echo Yii::app()->user->name ?>   
        </td>
    </tr>

    <tr class="main_header">
        <td class="right_td" style="width:255px; padding: 0; margin: 0; color:#888888; font-size:14px; line-height:17px;">
            Total Amounts:   
        </td>
        <td class="right_td" style="width:255px; padding: 0; margin: 0; color:black; font-size:14px; line-height:17px;font-weight: bold">
            <?php echo Yii::app()->session['currency'].' ' . Yii::app()->session['total_price']; ?>   
        </td>
    </tr>
    <tr class="main_header">
        <td class="right_td" style="width:255px; padding: 0; margin: 0; color:#888888; font-size:14px; line-height:17px;">
            
        </td>
        <td class="right_td" style="width:255px; padding: 0; margin: 0; color:black; font-size:14px; line-height:17px;font-weight: bold">
           <?php 
                $url = Yii::app()->request->hostInfo.$this->createUrl("/order/view",array("id"=>$order_id));
                echo CHtml::link("Access Url",$url);
              
            ?>
        </td>
    </tr>
</table>