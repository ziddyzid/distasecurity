<?php
require('products.php');
echo '<label>Qty : </label><input size="3px" type="text" id="qty1" value="1">';
echo "<table>
<thead>
<tr>
    <th>Item</th>
    <th>Size</th>
    <th>Sale Price</th>
</tr>
</thead>
<tbody>";
$quer = $dbp->query("SELECT * FROM list ORDER BY item ASC");
while ($resu = $quer->fetchArray(SQLITE3_ASSOC)){
    echo '<tr><td><button class="but" type="button" onclick="bitem('.$resu['id'].')">'.$resu['item'].'</button></td><td>' .$resu['size']. '</td><td>' .$resu['sprice']. '</td></tr>';
}
echo "</tbody>
</table>";
?>