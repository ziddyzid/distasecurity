<?php
session_start();
require('back.php');
require('cashers.php');
            $dbc->exec("DELETE FROM bill ");
            $dbc->exec("UPDATE SQLITE_SEQUENCE SET SEQ=0 WHERE NAME='bill'");
            //$dbb->exec("DELETE FROM bbill ");
            //$dbb->exec("UPDATE SQLITE_SEQUENCE SET SEQ=0 WHERE NAME='bbill'");
            echo "ALL RECORDS IN BACKUP DELETED";
?>