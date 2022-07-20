<?php
session_start();
require ("customerdb.php");
$updid = filter_input(INPUT_POST,"udpid");
$updcel = filter_input(INPUT_POST,"udcell");
$updadr = filter_input(INPUT_POST,"udadrr");
$upque = $clidb->query("SELECT * FROM cust WHERE iddp = '$updid'");
$upres = $upque->fetchArray();
if ($upres){
    if (empty($updcel)){
        echo "NO CELL NUMBER ENTERED <br>";
    }else{
        $clidb->exec("UPDATE cust SET cell = '$updcel' WHERE iddp = '$updid'");
        echo "NUMBER UPDATED SUCCESSFULLY <br>";
    }
    if (empty($updadr)){
        echo "NO ADDRESS ENTERED <br>";
    }else{
        $clidb->exec("UPDATE cust SET addr = '$updadr' WHERE iddp = '$updid'");
        echo "ADDRESS UPDATED SUCCESSFULLY <br>";
    }
}else{
    echo "CLIENT ID/DP NOT ON RECORD TRY AGAIN OR ENTER A NEW CLIENT RECORD";
}
?>