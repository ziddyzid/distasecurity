<?php
class DBphpbbal extends SQLite3 {
    function __construct(){
        $this->open('dbbin/bkcredbl.db');   
    }    
    }
    $bcbdb = new DBphpbbal();
?>