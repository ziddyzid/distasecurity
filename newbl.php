<?php
session_start();
$casht = $_SESSION['cash'];
$bkblt = "";
$bkblto = "0";
require('back.php');
require('cashers.php');
$chque = $dbc->query("SELECT * FROM bill");
$chres = $chque->fetchArray();
if ($chres){
$bkud = filter_input(INPUT_POST,"bkdat");
$blque = $dbc->query("SELECT * FROM bill");
while ($blres = $blque->fetchArray()){
    $bkite = $blres['item'];
    $bkpri = $blres['price'];
    $bkqty = $blres['qty'];
    $bktot = number_format($blres['tot'],2);
    $bkblto = $bkblto + $bktot;
    $dbb->exec("INSERT INTO bbill (bdate, item, price, qty, tot) VALUES ('$bkud', '$bkite', '$bkpri', '$bkqty', '$bktot')");

}
$chge = $casht - $bkblto;
$chg = number_format($chge,2);
$bkblt =number_format($bkblto,2);
$dbb->exec("INSERT INTO bbill (billt, castend, change) VALUES ('$bkblt', '$casht', '$chg')");
$dbc->exec("DELETE FROM bill");
$dbc->exec ("DELETE FROM sqlite_sequence WHERE name = 'bill'");
$_SESSION['cash'] = "0.00";
echo "NEW BILL CREATED & PREVIOUS BILL WAS BACKED UP ";
}else{
    echo "NO BILL TO BACK UP NEW BILL CREATED";
}
?>