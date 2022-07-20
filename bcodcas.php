<?php
session_start();
$casht = $_SESSION['cash'];
require('products.php');
require('cashers.php');
    $bcode = filter_input(INPUT_POST,'bcd');
    $item = filter_input(INPUT_POST,'ipr');
    $qty = filter_input(INPUT_POST,'bcqt');
    if ($casht == "0.00"){
        $results = $dbp->query("SELECT * FROM list WHERE bcode = '$bcode' OR item = '$item'");
    $ara = $results->fetchArray();
            if ($ara){
    $i = $ara['item'];
    $p = $ara['sprice'];
    $tot = floatval($qty) * floatval($p);
    $qt = floatval($ara['qty']) - $qty;
    $dbp->exec("UPDATE list SET qty='$qt' WHERE bcode='$bcode' OR item = '$item'");
    $cas = "INSERT INTO bill (item, price, qty, tot) VALUES ('$i', '$p', '$qty', '$tot')";
    $dbc->exec($cas);
            }else if (! $ara){
                echo "ERROR ITEM/BARCODE NOT IN INVENTORY RECORDS";
            }
    }else{
        echo "ERROR CANNOT ENTER ITEMS ON BILL AFTER CASH HAS BEEN TENDED";
    }
?>