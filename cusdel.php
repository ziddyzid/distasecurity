<?php
session_start();
require ("customerdb.php");
$delc = filter_input(INPUT_POST,"deid");
$deque = $clidb->query("DELETE FROM cust WHERE id = '$delc'");
echo "<script>alert ('Client Deleted Successfully');</script>";
?>