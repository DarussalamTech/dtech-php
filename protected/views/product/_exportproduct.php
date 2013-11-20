<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$columns = array(
    "product_name",
    "product_description",
    "product_overview",
    "item_code",
    "title",
    "price",
    "quantity",
    "no_of_pages",
    "isbn",
    "binding",

    "printing",
    "paper",
    "dimension",
    "edition",
);

echo "<html>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
echo "<body>";
echo "<table>";
echo "<tr>";
foreach ($columns as $col) {
    echo "<th>" . $col . "</th>";
}

echo "</tr> ";

foreach ($results as $result) {

    echo "<tr>";
    foreach ($columns as $col) {
          echo isset($result[$col])?"<td>".$result[$col]."</td>":"<td></td>";
    }
    echo "</tr> ";
}

echo "</table>";
echo "</body>";
echo "</html>";
?>
