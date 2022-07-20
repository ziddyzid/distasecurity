<?php
session_start();
require ("accodb.php");
$desa = filter_input(INPUT_POST,"dors");
$sta = filter_input(INPUT_POST,"nst");
$adpsw = filter_input(INPUT_POST,"naps");
$usr = filter_input(INPUT_POST,"nnus");
$pas = filter_input(INPUT_POST,"nnps");
$rpas = filter_input(INPUT_POST,"nrnps");
$adminq = $accdb->query("SELECT * FROM acco WHERE upw = '$adpsw' AND stat = 'admin'");
$adminr = $adminq->fetchArray();
if (! $adminr) {
    echo "ONLY ADMIN USERS CAN INSERT A NEW USER ENTER A ADMIN PASSWORD ";
}
if ($adminr) {
    $neque = $accdb->query("SELECT * FROM acco WHERE unam ='$usr'");
    $neres = $neque->fetchArray();
    if ($neres){
        echo "USER ALREADY EXCIST";
    }
    else if (! $neres){
    $accdb->exec("INSERT INTO acco (unam, upw, stat) VALUES ('$usr', '$pas', '$sta')");
    echo "NEW USER INSERTED " .$usr;
        }
    }


?>