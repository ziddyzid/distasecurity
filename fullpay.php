<?php
session_start();
require ("creditdb.php");
require ("crbalance.php");
require ("bkcreditdb.php");
require ("bkcrbalance.php");
$bid = filter_input(INPUT_POST,"creid");
$quecred = $crdb->query("SELECT * FROM credit WHERE crclient = '$bid'");
while ($rescr = $quecred->fetchArray(SQLITE3_ASSOC)){
$fsn = $rescr['fn'];
$lsn = $rescr['ln'];
$cusid = $rescr['crclient'];
$bkite = $rescr['critem'];
$bkpri = $rescr['crprice'];
$bkqty = $rescr['crqty'];
$bktcst = $rescr['crtot'];
$bkdt = $rescr['crdate'];
$bcrdb->exec("INSERT INTO credbk (bfn, bln, bcredid, bcritem, bcrprice, bcrqty, bcrtot, bcrdate) VALUES ('$fsn', '$lsn', '$cusid', '$bkite', '$bkpri', '$bkqty', '$bktcst', '$bkdt')");
}
$balque = $cbdb->query("SELECT * FROM bala WHERE payid = '$bid'");
while ($balres = $balque->fetchArray()){
    $bpda = $balres['paydate'];
    $bfn = $balres['fsna'];
    $bln = $balres['lsna'];
    $bid = $balres['payid'];
    $bamo = $balres['payamo'];
    $bcbdb->exec("INSERT INTO bkbala (bkpaydate, bkfsna, bklsna, bkpayid, bkpayamo) VALUES ('$bpda', '$bfn', '$bln', '$bid', '$bamo')");
}
$crdb->exec("DELETE FROM credit WHERE crclient = '$bid'");
$cbdb->exec("DELETE FROM bala WHERE payid = '$bid'");
?>