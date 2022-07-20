<?php
class DBphpcr extends SQLite3 {
    function __construct(){
        $this->open('dbbin/credbl.db');   
    }    
    }
    $crdb = new DBphpcr();
?>