<?php
session_start();
require ('products.php');
echo " <table class='prot'>
<thead>
<tr>
    <th>B-Code</th>
    <th>Item</th>
    <th>Size</th>
    <th>Cost Price</th>
    <th>Sale Price</th>
    <th>Note</th>
    <th>Category</th>
    <th>Quantity</th>
</tr>
</thead>
<tbody>";
$sp = filter_input(INPUT_POST,"selpro");
$quer = $dbp->query("SELECT * FROM list WHERE catego = '$sp' ORDER BY item ASC");
while ($resu = $quer->fetchArray(SQLITE3_ASSOC)){
    echo '<tr><td>' .$resu['bcode']. '</td><td>' .$resu['item']. '</td><td>' .$resu['size']. '</td><td>' .$resu['cprice']. '</td><td>' .$resu['sprice']. '</td><td>'.$resu['note']. '</td><td>' .$resu['catego']. '</td><td>' .$resu['qty']. '</td></tr>';
}
echo "</tbody>
</table>";
?>