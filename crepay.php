<?php
session_start();
require ("creditdb.php");
require ("crbalance.php");
require ("customerdb.php");
$cbt = 0;
$cbp = 0;
$payda = filter_input(INPUT_POST,"padat");
$paycred = filter_input(INPUT_POST,"crpay");
$paidid = filter_input(INPUT_POST,"cliddp");
$quepay = $clidb->query("SELECT * FROM cust WHERE iddp = '$paidid'");
$respay = $quepay->fetchArray();
if ($respay){
$naf = $respay["fnam"];
$nal = $respay["lnam"];
$cbdb->exec("INSERT INTO bala (paydate, fsna, lsna, payid, payamo) VALUES ('$payda', '$naf', '$nal', '$paidid', '$paycred')");
}
echo '<div class="crdte">
    <label>Client ID/DP # </label>
    <label id="recid">' .$paidid.'</label>
    <table class="pmttbl">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Item</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>';
        $queinf = $crdb->query("SELECT * FROM credit WHERE crclient = '$paidid'");
while ($resinf = $queinf->fetchArray()){
    $cbt = $cbt + $resinf["crtot"];
        echo '<tr>
        <td>' .$resinf["fn"]. '</td>
        <td>' .$resinf["ln"]. '</td>
        <td>' .$resinf["critem"]. '</td>
        <td>' .$resinf["crprice"]. '</td>
        <td>' .$resinf["crqty"]. '</td>
        <td>' .number_format($resinf["crtot"],2). '</td>
        <td>' .$resinf["crdate"]. '</td>
    </tr>';
}
echo '</tbody>
</table>
<p class="cbto">CREDIT BILL TOTAL <b>$<label id="cbtot">' .number_format($cbt,2). '</label></b></p>
</div>
<div class="crdte" id"pa">
<table class="pmttbl">
    <thead>
        <tr>
            <th>Payment Date</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Payment Amount</th>
        </tr>
    </thead>
    <tbody>';
    $quecb = $cbdb->query("SELECT * FROM bala WHERE payid ='$paidid' ORDER BY id ASC");
    while ($rescb = $quecb->fetchArray()){
        $cbp = $cbp + $rescb["payamo"];
        echo '<tr>
        <td>' .$rescb["paydate"]. '</td>
        <td>' .$rescb["fsna"]. '</td>
        <td>' .$rescb["lsna"]. '</td>
        <td>' .number_format($rescb["payamo"],2). '</td>
        </tr>';
    }
    echo '</tbody>
    </table>';
    $paybal = $cbt - $cbp;
    echo '<p class="cbto">CREDIT PAYMENT TOTAL <b>$' .number_format($cbp,2). '</b></p>
    <p class="cbto">CREDIT PAYMENT BALANCE <b>$' .number_format($paybal,2). '</b></p>';
    if ($paybal <= 0.00){
        echo '<p><input class="creser" type="button" onclick="paidfull()" value="PAID IN FULL"></p>';
    }
    echo '</div>';
?>