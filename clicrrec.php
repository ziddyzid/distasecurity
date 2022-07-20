<?php
session_start();
require ("bkcrbalance.php");
require ("bkcreditdb.php");
$cliidr = filter_input(INPUT_POST,"clidr");
$infoque = $bcrdb->query("SELECT * FROM credbk WHERE bcredid = '$cliidr'");
$infores = $infoque->fetchArray();
if ($infores){
echo "<label><b>CLIENT INFO</b></label><br>
        <label>NAME : " .$infores['bfn']. " " .$infores['bln']. "</label><br>
        <label>ID/DP : " .$infores['bcredid']. "</label><br>
        <table class='mitbl'>
    <thead>
        <th>Item</th>
        <th style='width: 12%;'>Price</th>
        <th style='width: 8%;'>Qty</th>
        <th style='width: 12%;'>Total</th>
        <th>Credit Date</th>
    </thead>
    <tbody>";
        $itemque = $bcrdb->query("SELECT * FROM credbk WHERE bcredid = '$cliidr'");
        while ($itemres = $itemque->fetchArray()){
            echo "<tr>
            <td>" .$itemres['bcritem']. "</td>
            <td style='width: 12%;'> $" .$itemres['bcrprice']. "</td>
            <td style='width: 8%;'>" .$itemres['bcrqty']. "</td>
            <td style='width: 12%;'> $" .number_format($itemres['bcrtot'],2). "</td>
            <td>" .$itemres['bcrdate']. "</td>
        </tr>";
        }
        echo "</tbody>
        </table>
        <label><b>CREDIT PAYMENTS</b></label><br>
        <table class='mitbl'>
    <thead>
        <th>ID/DP</th>
        <th style='width: 12%;'>Payment</th>
        <th>Payment Date</th>
    </thead>
    <tbody>";
    $bkpayque = $bcbdb->query("SELECT * FROM bkbala WHERE bkpayid = '$cliidr' ORDER BY bkpaydate ASC");
    while ($bkpayres = $bkpayque->fetchArray()){
      echo "<tr>
            <td>" .$bkpayres['bkpayid']. "</td>
            <td> $" .number_format($bkpayres['bkpayamo'],2). "</td>
            <td>" .$bkpayres['bkpaydate']. "</td>
            </tr>";
    }
        echo "</tbody>
        </table>";

    }else{
        echo "<br><br><br><h1 style='color: red;'>ERROR CLIENT ID/DP NOT ON RECORD START A NEW CREDIT BILL OR TRY AGAIN</h1>";
    }
?>