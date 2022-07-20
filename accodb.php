<?php
class DBphpa extends SQLite3 {
    function __construct(){
        $this->open('dbbin/user.db');   
    }    
    }
    $accdb = new DBphpa();
?>