<?php
session_start();
$casht = $_SESSION['cash'];
require ("creditdb.php");
require ("customerdb.php");
require('cashers.php');
$crd = filter_input(INPUT_POST,"cdat");
$crfst = filter_input(INPUT_POST,"cfst");
$crlst = filter_input(INPUT_POST,"clst");
$crloc = filter_input(INPUT_POST,"cloc");
$crcel = filter_input(INPUT_POST,"cel");
$cride = filter_input(INPUT_POST,"cide");
$quech = $clidb->query("SELECT * FROM cust WHERE iddp = '$cride'");
$resch = $quech->fetchArray();
if (! $resch){
    $clidb->exec("INSERT INTO cust (fnam, lnam, addr, cell, iddp) VALUES ('$crfst', '$crlst', '$crloc', '$crcel', '$cride')");
    echo "NEW CLIENT NAME SAVED TO RECORDS";
}else if ($resch){
    echo "RETURNING CLIENT NAME ALREADY ON RECORD";
}
$quenam = $clidb->query("SELECT * FROM cust WHERE iddp = '$cride'");
    $resnam = $quenam->fetchArray();
    $fsn = $resnam['fnam'];
    $lsn = $resnam['lnam'];
$quebll = $dbc->query("SELECT * FROM bill");
while ($resbll = $quebll->fetchArray()){
    $crit = $resbll['item'];
    $crpc = $resbll['price'];
    $crqy = $resbll['qty'];
    $crto = $resbll['tot'];
    
    $crdb->exec("INSERT INTO credit (fn, ln, crclient, critem, crprice, crqty, crtot, crdate) VALUES ('$fsn', '$lsn', '$cride', '$crit', '$crpc', '$crqy', '$crto', '$crd')");
}
$dbc->exec("DELETE FROM bill");
$dbc->exec("UPDATE SQLITE_SEQUENCE SET SEQ=0 WHERE NAME='bill'");
echo "<script> alert ('BILL SAVED TO CREDIT RECORDS');</script>";
?>