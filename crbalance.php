<?php
class DBphpbal extends SQLite3 {
    function __construct(){
        $this->open('dbbin/credbal.db');   
    }    
    }
    $cbdb = new DBphpbal();
?>