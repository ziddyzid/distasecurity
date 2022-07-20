<?php
session_start();
require('products.php');
echo '<label>Re-Order Level 5</label><br>
<table class="retbl">
<thead>
    <tr>
        <th>Item</th>
        <th>Quantity</th>
    </tr>
</thead>
<tbody>';
$quelev = $dbp->query("SELECT * FROM list ORDER BY item ASC");
while ($reslev = $quelev->fetchArray(SQLITE3_ASSOC)){
    $qtyle = $reslev['qty'];
    if ($qtyle <= 5){
    echo "<tr><td>" .$reslev['item']. " </td><td> " .$reslev['qty']. "</td></tr>";
        }
}
echo '</tbody>
</table>';
?>