<?php
session_start();
require ("bkcrbalance.php");
echo '<table class="mitbl">
<thead>
    <th>Client Name</th>
    <th>ID/DP</th>
    <th>Amount</th>
    <th>Payment Date</th>
</thead>
<tbody>';
$payque = $bcbdb->query("SELECT * FROM bkbala ORDER BY bkfsna ASC");
while ($payres = $payque->fetchArray()){
        echo '<tr>
        <td>' .$payres['bkfsna']. ' ' .$payres['bklsna']. '</td>
        <td>' .$payres['bkpayid']. '</td>
        <td> $' .number_format($payres['bkpayamo'],2). '</td>
        <td>' .$payres['bkpaydate']. '</td>
        </tr>';
}
echo '</tbody>
</table>';
?>