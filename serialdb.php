<?php
class DBphpss extends SQLite3 {
    function __construct(){
        $this->open('dbbin/serials.db');   
    }    
    }
    $dbss = new DBphpss();
?>