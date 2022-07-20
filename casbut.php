<?php
session_start();
$casht = $_SESSION['cash'];
require('button.php');
require('products.php');
require('cashers.php');
$butid = filter_input(INPUT_POST,"bcod");
$btqty= filter_input(INPUT_POST,"buqty");
if ($casht == "0.00"){
    $queb = $dbbu->query("SELECT * FROM but WHERE buid = '$butid'");
    $resb = $queb->fetchArray();
    $itecd = $resb['bucode'];
    $quepro = $dbp->query("SELECT * FROM list WHERE bcode = '$itecd'");
    $respro = $quepro->fetchArray();
    $btit = $respro['item'];
    $btcos = $respro['sprice'];
    $btq = $respro['qty'];
    $bttot = $btqty * $btcos;
    $qt = $btq - $btqty;
    $dbp->exec("UPDATE list SET qty='$qt' WHERE bcode='$itecd'");
    $dbc->exec("INSERT INTO bill (item, price, qty, tot) VALUES ('$btit', '$btcos', '$btqty', '$bttot')");
}else{
    echo "ERROR CANNOT ENTER ITEMS ON BILL AFTER CASH HAS BEEN TENDED";
}    
?>