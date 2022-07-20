<?php
session_start();
require ("creditdb.php");
require ("customerdb.php");
$quec = $crdb->query("SELECT DISTINCT crclient FROM credit ORDER BY fn ASC");
while ($resc = $quec->fetchArray()){
    $crenam = $resc['crclient'];
    $quecl = $clidb->query("SELECT * FROM cust WHERE iddp = '$crenam'");
    $rescl = $quecl->fetchArray();
    $cln = $rescl['fnam']. " " .$rescl['lnam'];
    echo "<p class='btnam'>$cln<input class='abtn' type='button' onclick='cliid(this)' value='" .$crenam. "')'></p>";
}
?>