<?php
class DBphpbu extends SQLite3 {
    function __construct(){
        $this->open('dbbin/buttons.db');   
    }    
    }
    $dbbu = new DBphpbu();
?>