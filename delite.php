<?php
session_start();
require('button.php');
require ('products.php');
$delite = filter_input(INPUT_POST,"itdel");
$delque = $dbp->query("SELECT * FROM list WHERE bcode = '$delite' OR item = '$delite'");
$delres = $delque->fetchArray();
if ($delres) {
    $dbp->exec("DELETE FROM list WHERE bcode = '$delite'");
    $dbbu->exec("DELETE FROM but WHERE bucode = '$delite'");
    echo "ITEM DELETED SUCCESSFULLY FROM RECORDS.";
}else if (! $delres){
    echo " ERROR ITEM DON'T EXCIST IN RECORDS PLEASE TRY AGAIN!!";
}

?>