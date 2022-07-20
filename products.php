<?php
class DBphp extends SQLite3 {
    function __construct(){
        $this->open('dbbin/products.db');   
    }    
    }
    $dbp = new DBphp();
?>