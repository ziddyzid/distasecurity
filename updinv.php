<?php
session_start();
require ('products.php');
$updite = filter_input(INPUT_POST,"upite");
$updsz = filter_input(INPUT_POST,"upsz");
$updcosp = filter_input(INPUT_POST,"upcop");
$updcop = number_format($updcosp,2);
$updsalp = filter_input(INPUT_POST,"upsap");
$updsap = number_format($updsalp,2);
$updno = filter_input(INPUT_POST,"upno");
$updqt = filter_input(INPUT_POST,"upqt");
$updque = $dbp->query("SELECT * FROM list WHERE bcode = '$updite' OR item = '$updite'");
$updres = $updque->fetchArray();
if ($updres){
if ($updsz == ""){
    echo "NO SIZE WAS ENTERED! ";
}else {
    $dbp->exec("UPDATE list SET size = '$updsz ' WHERE bcode = '$updite' OR item = '$updite'");
    echo "<b>SIZE UPDATED SUCCESSFULLY.</b> ";
}
if ($updcop == "0.00"){
    echo "NO COST PRICE WAS ENTERED! ";
}else {
    $dbp->exec("UPDATE list SET cprice = '$updcop ' WHERE bcode = '$updite' OR item = '$updite'");
    echo "<b>COST PRICE UPDATED SUCCESSFULLY.</b> ";
}
if ($updsap == "0.00"){
    echo "NO SALE PRICE WAS ENTERED! ";
}else {
    $dbp->exec("UPDATE list SET sprice = '$updsap ' WHERE bcode = '$updite' OR item = '$updite'");
    echo "<b>SALE PRICE UPDATED SUCCESSFULLY.</b> ";
}
if ($updno == ""){
    echo "NO NOTE WAS ENTERED! ";
}else {
    $dbp->exec("UPDATE list SET note = '$updno ' WHERE bcode = '$updite' OR item = '$updite'");
    echo "<b>NOTE UPDATED SUCCESSFULLY.</b> ";
}
if ($updqt == ""){
    echo "NO QUANTITY WAS ENTERED! ";
}else {
    $dbp->exec("UPDATE list SET qty = '$updqt ' WHERE bcode = '$updite' OR item = '$updite'");
    echo "<b>QUANTITY UPDATED SUCCESSFULLY.</b> ";
}
}else if (! $updres){
    echo "ERROR ITEM OR CODE ENTERED DON'T EXCIST TRY AGAIN! ";
}
?>