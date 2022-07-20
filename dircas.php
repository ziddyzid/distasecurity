<?php
session_start();
$per = $_SESSION['user'];
$pstat = $_SESSION['status'];
$casht = $_SESSION['cash'];
if ($pstat != "admin"){
    header("Location: usermsg.html");
}
$mone = filter_input(INPUT_POST,"otpt");
$mon = number_format($mone,2);
require('cashers.php');
if ($casht == "0.00"){
    $cas = "INSERT INTO bill (item, price, qty, tot) VALUES ('DIRECT CASH', '$mon', '1', '$mon')";
    $dbc->exec($cas);
}else{
    echo "ERROR CANNOT ENTER ITEMS ON BILL AFTER CASH HAS BEEN TENDED";
}
?>