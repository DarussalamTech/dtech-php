<table width="100%">
    <tr class="cart_tr">
        <td class="cart_left_td">Author</td>
        <td class="cart_right_td"><?php
            echo isset($pro->productProfile->product->author->author_name) ? $pro->productProfile->product->author->author_name : "";
            ?></td>
    </tr>
    <tr class="cart_tr">
        <td class="cart_left_td">Language</td>
        <td class="cart_right_td"><?php
            echo isset($pro->productProfile->productLanguage->language_name) ? $pro->productProfile->productLanguage->language_name : "";
            ?></td>
    </tr>

</table>