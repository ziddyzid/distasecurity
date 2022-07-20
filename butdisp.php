<?php
session_start();
require('button.php');
$bdque = $dbbu->query("SELECT * FROM but");
while ( $bdres = $bdque->fetchArray()){
    echo "<p class='btd'><button class='bfx' tybe='button' onclick='btcode(" .$bdres['buid']. ")'>" .$bdres['buitem']. "</button></p>";  
}
?>