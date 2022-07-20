<?php
class DBphpca extends SQLite3 {
    function __construct(){
        $this->open('dbbin/casher.db');   
    }    
    }
    $dbc = new DBphpca();
?>