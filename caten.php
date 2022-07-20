<?php
session_start();
require('cashers.php');
require('back.php');
  $ctend = filter_input(INPUT_POST,'cte');
  $total = filter_input(INPUT_POST,'tota');
  $bil = $dbc->query("SELECT * FROM bill");
  $tota = $bil->fetchArray(SQLITE3_ASSOC);
  $chan = $ctend - $total;
  echo '<th><b style="color:#ff0392;">CASH TEND = </th><th>' .number_format($ctend,2). '</b></th>';
  echo '<th><b> CHANGE = </b></th><th><b>' .number_format($chan,2). '</b></th><th><></th>';
  $_SESSION['cash'] = $ctend;
?>