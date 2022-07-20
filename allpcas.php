<?php
session_start();
$casht = $_SESSION['cash'];
require('products.php');
require('cashers.php');
$casall = filter_input(INPUT_POST,"butp");
$qty1 = filter_input(INPUT_POST,"qtal");
if ($casht == "0.00"){
$results = $dbp->query("SELECT * FROM list WHERE id = '$casall'");
$ara = $results->fetchArray();
$i = $ara['item'];
$p = $ara['sprice'];
$tot = floatval($qty1) * floatval($p);

$qt = floatval($ara['qty']) - $qty1;
$dbp->exec("UPDATE list SET qty='$qt' WHERE item = '$i'");
$cas = "INSERT INTO bill (item, price, qty, tot) VALUES ('$i', '$p', '$qty1', '$tot')";
$dbc->exec($cas);
}else{
    echo "ERROR CANNOT ENTER ITEMS ON BILL AFTER CASH HAS BEEN TENDED";
}
?>