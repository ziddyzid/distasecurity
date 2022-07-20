<?php
session_start();
require ('products.php');
 $bc = filter_input(INPUT_POST,'pcod');
 $it = filter_input(INPUT_POST,'pnam');
 $sz = filter_input(INPUT_POST,'psiz');
 $itcp = filter_input(INPUT_POST,'pcos');
 $icp = number_format($itcp,2);
 $itsp = filter_input(INPUT_POST,'psal');
 $isp = number_format($itsp,2);
 $ino = filter_input(INPUT_POST,'pnot');
 $cat = filter_input(INPUT_POST,'catg');
 $qt = filter_input(INPUT_POST,'pqty');
 $chkque = $dbp->query("SELECT * FROM list WHERE bcode = '$bc' OR item = '$it'");
 $chkres = $chkque->fetchArray();
 if ($chkres){
    echo "ERROR SORRY CAN`T HAVE DUPLICATED ITEMS / BARCODES";
 }else if (! $chkres){
    $dbp->exec("INSERT INTO list (bcode, item, size, cprice, sprice, note, catego, qty) VALUES ('$bc', '$it', '$sz', '$icp', '$isp', '$ino', '$cat', '$qt')");
    echo "NEW ITEM SAVED.";
 }
?>