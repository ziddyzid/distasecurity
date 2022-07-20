<?php
class DBphpbcr extends SQLite3 {
    function __construct(){
        $this->open('dbbin/credbkup.db');   
    }    
    }
    $bcrdb = new DBphpbcr();
?>