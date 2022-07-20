<?php
session_start();
require('cashers.php');
$pr = 0;
$diss = $dbc->query("SELECT * FROM bill");
$shos = $diss->fetchArray(SQLITE3_ASSOC);
if ($shos){
echo '<table style="margin:auto" class="btbl" >
<thead>
    <tr>
        <th>Id</th>
        <th>Item</th>
        <th>Price</th>
        <th>Qty</th>
        <th>Total</th>
    </tr>
</thead>
<tbody>';
$dis = $dbc->query("SELECT * FROM bill");
while ($sho = $dis->fetchArray(SQLITE3_ASSOC)){
echo '<tr><td>' .$sho['id']. '</td><td>'.$sho['item']. '</td><td>' .$sho['price']. '</td><td>' .$sho['qty']. '</td><td>' .floatval($sho['tot']). '</td></tr>';
}
$bil = $dbc->query("SELECT * FROM bill");
while ( $amount = $bil->fetchArray(SQLITE3_ASSOC)){
  $pr += floatval($amount['tot']);  
}
echo '<tr><td>TOTAL = </td><td>' .number_format($pr,2). '</td></tr>';
echo '</tbody>
</table>';
echo "<p id='t' hidden>".$pr."</p>";
}else{
echo "<h1>!! ALERT !!</h1><br>
        <h2>PLEASE ENTER ITEMS IN THE REGESTER TO CONTINUE</h2>";
}
?>