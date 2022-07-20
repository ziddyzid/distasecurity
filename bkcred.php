<?php
session_start();
require ("bkcreditdb.php");
echo '   <table class="retbl">
<thead>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Client ID/DP</th>
    <th>Items</th>
    <th>Price</th>
    <th style="width: 5%;">Qty</th>
    <th>Total</th>
    <th>Credit Date</th>
</thead>
<tbody>';
$cbkque = $bcrdb->query("SELECT * FROM credbk ORDER BY bfn ASC");
while ($cbkres = $cbkque->fetchArray()){
  echo '<tr>
  <td>' .$cbkres["bfn"]. '</td>
  <td>' .$cbkres["bln"]. '</td>
  <td>' .$cbkres["bcredid"]. '</td>
  <td>' .$cbkres["bcritem"]. '</td>
  <td> $' .$cbkres["bcrprice"]. '</td>
  <td style="width: 5%;">' .$cbkres["bcrqty"]. '</td>
  <td> $' .number_format($cbkres["bcrtot"],2). '</td>
  <td>' .$cbkres["bcrdate"]. '</td>
 </tr> ';  
}
echo '</tbody>
</table>';
?>