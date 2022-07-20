<?php
session_start();
require ("accodb.php");
$apw = filter_input(INPUT_POST,"admpw");
$stau = filter_input(INPUT_POST,"sta");
$delus = filter_input(INPUT_POST,"deus");
$prique = $accdb->query("SELECT * FROM acco WHERE upw = '$apw' AND stat = 'admin'");
$prires = $prique->fetchArray();
if ($prires){
$deque = $accdb->query("SELECT * FROM acco WHERE unam = '$delus' AND stat = '$stau'");
$deres = $deque->fetchArray(); 
        if ($deres){
            $accdb->exec("DELETE FROM acco WHERE unam = '$delus'");
            echo "USER DELETED FROM RECORDS";
        }
        else if (! $deres){
            echo "USER NOT ON RECORD TO BE DELETED TRY AGAIN";
        }
}
else if (! $prires){
        echo "INCORRECT ADMIN PASSWORD ONLY ADMIN USERS CAN DELETE A RECORD";
}
?>