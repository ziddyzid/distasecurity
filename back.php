<?php
class DBphpb extends SQLite3 {
    function __construct(){
        $this->open('dbbin/back.db');   
    }    
    }
    $dbb = new DBphpb();
?>