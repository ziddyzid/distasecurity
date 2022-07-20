<?php
session_start();
require ("customerdb.php");
$fnam = filter_input(INPUT_POST,"fstn");
$lnam = filter_input(INPUT_POST,"lstn");
$addre = filter_input(INPUT_POST,"addr");
$tele = filter_input(INPUT_POST,"tel");
$ciddp = filter_input(INPUT_POST,"clid");
$serque = $clidb->query("SELECT * FROM cust WHERE iddp = '$ciddp'");
$serres = $serque->fetchArray();
if ($serres){
    echo "SORRY CANNOT CONTINUE WITH NEW CREDIT CLIENT THIS ID/DP IS ON RECORD ALREADY";
}else if(! $serres){
    $clidb->exec("INSERT INTO cust (fnam, lnam, addr, cell, iddp) VALUES ('$fnam', '$lnam', '$addre', '$tele', '$ciddp')");  
}
?>