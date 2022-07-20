<?php
session_start();
$casht = $_SESSION['cash'];
require('cashers.php');
require('products.php');
$pid = filter_input(INPUT_POST,'dite');
$idqb = $dbc->query("SELECT * FROM bill WHERE id = '$pid'");
$bres = $idqb->fetchArray();
if ($casht == "0.00"){
if ($bres){
$dite = $bres['item'];
$cqty = $bres['qty'];
$idqp = $dbp->query("SELECT * FROM list WHERE item = '$dite'");
$pres = $idqp->fetchArray();
$pqty = $pres['qty'];
$nqty = floatval($pqty) + floatval($cqty);
$dbp->exec("UPDATE list SET qty = $nqty WHERE item = '$dite'");
$idq = ("DELETE  FROM bill WHERE id = '$pid'");
$dbc->exec($idq);
}else if (! $bres){
    echo "ERROR ITEM ID NOT IN REGESTER PLEASE ENTER CORRECT ITEM ID# TO CONTINUE";
}
}else{
    echo "ERROR CANNOT DELETE ITEMS ON BILL AFTER CASH HAS BEEN TENDED";
}
?>