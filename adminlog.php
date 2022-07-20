<?php
session_start();
require ("accodb.php");
$apw = filter_input(INPUT_POST,"admpw");
$aus = filter_input(INPUT_POST,"admusr");
$adque = $accdb->query("SELECT * FROM acco WHERE unam = '$aus' AND upw = '$apw' AND stat = 'admin'");
$adres = $adque->fetchArray();
if ($adres) {
    $_SESSION['user'] = $adres['unam'];
    $_SESSION['status'] = $adres['stat'];
    echo "<p id='al'>1</>";
}else if (! $adres) {
    echo "NOT A ADMIN USER OR WRONG PASSWORD TRY AGAIN";
}
?>