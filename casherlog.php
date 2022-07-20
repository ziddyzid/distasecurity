<?php
session_start();
require ("accodb.php");
$cpw = filter_input(INPUT_POST,"caspw");
$cus = filter_input(INPUT_POST,"casusr");
$caque = $accdb->query("SELECT * FROM acco WHERE unam = '$cus' AND upw = '$cpw' AND stat = 'user'");
$cares = $caque->fetchArray();
if ($cares) {
    $_SESSION['user'] = $cares['unam'];
    $_SESSION['status'] = $cares['stat'];
    echo "<p id='al'>1</>";
}else if (! $cares) {
    echo "NOT A CASHER USER OR WRONG PASSWORD TRY AGAIN";
}
?>