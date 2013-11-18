<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


 echo "<html>";
        echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
        echo "<body>";
        echo "<table>";
        echo "<tr>
                <th>id</th>
                <th>item_code</th>
                <th>language_id</th>
                <th>title</th>
                <th>slag</th>
                <th>price</th>
                <th>quantity</th>
                <th>size</th>
                <th>no_of_pages</th>
                <th>binding</th>
                <th>printing</th>
                <th>paper</th>
                <th>dimension</th>
                <th>edition</th>
                <th>attribute</th>
                <th>attribute_value</th>
                <th>product_id</th>
                <th>translator_id</th>
                <th>compiler_id</th>
                <th>isbn</th>
                <th>create_time</th>
                <th>create_user_id</th>
                <th>update_time</th>
                <th>update_user_id</th>
                <th>product_name</th>
                <th>parent_cateogry_id</th>
                <th>product_description</th>
                <th>product_overview</th>
                <th>status</th>
                <th>city_id</th>
                <th>is_featured</th>
                <th>product_rating</th>
                <th>authors</th>
              </tr> ";

        foreach ($results as $result) {
         
            echo "<tr>
                <td>" . $result['id'] . "</td>
                <td>" . $result['item_code'] . "</td>
                <td>" . $result['language_id'] . "</td>
                <td>" . $result['title'] . "</td>
                <td>" . $result['slag'] . "</td>
                <td>" . $result['price'] . "</td>
                <td>" . $result['quantity'] . "</td>
                <td>" . $result['size'] . "</td>
                <td>" . $result['no_of_pages'] . "</td>
                <td>" . $result['binding'] . "</td>
                <td>" . $result['printing'] . "</td>
                <td>" . $result['paper'] . "</td>
                <td>" . $result['dimension'] . "</td>
                <td>" . $result['edition'] . "</td>
                <td>" . $result['attribute'] . "</td>
                <td>" . $result['attribute_value'] . "</td>
                <td>" . $result['product_id'] . "</td>
                <td>" . $result['translator_id'] . "</td>
                <td>" . $result['compiler_id'] . "</td>
                <td>" . $result['isbn'] . "</td>
                <td>" . $result['create_time'] . "</td>
                <td>" . $result['create_user_id'] . "</td>
                <td>" . $result['update_time'] . "</td>
                <td>" . $result['update_user_id'] . "</td>
                <td>" . $result['product_name'] . "</td>
                <td>" . $result['parent_cateogry_id'] . "</td>
                <td>" . $result['product_description'] . "</td>
                <td>" . $result['product_overview'] . "</td>
                <td>" . $result['status'] . "</td>
                <td>" . $result['city_id'] . "</td>
                <td>" . $result['is_featured'] . "</td>
                <td>" . $result['product_rating'] . "</td>
                <td>" . $result['authors'] . "</td>    
         </tr> ";
        }

        echo "</table>";
        echo "</body>";
        echo "</html>";
?>
