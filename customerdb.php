<?php
class DBphpcl extends SQLite3 {
    function __construct(){
        $this->open('dbbin/clients.db');   
    }    
    }
    $clidb = new DBphpcl();
?>