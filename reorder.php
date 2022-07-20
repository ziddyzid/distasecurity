<?php
session_start();
require('products.php');
$alev = filter_input(INPUT_POST,"leve");
echo '<label>Re-Order Level ' .$alev. '</label><br>
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
    if ($qtyle <= $alev){
    echo "<tr><td>" .$reslev['item']. " </td><td> " .$reslev['qty']. "</td></tr>";
        }
}
echo '</tbody>
</table>';
?>