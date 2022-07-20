<?php
session_start();
$per = $_SESSION['user'];
$pstat = $_SESSION['status'];
if ($pstat != "admin"){
    header("Location: usermsg.html");
}
//require('serialdb.php');
//$serial = gethostbyaddr($_SERVER['REMOTE_ADDR']);
//$sql= $dbss->query("SELECT * FROM pcname");
//$res = $sql->fetchArray();
//$seria = $res['pcnam'];
//if ($seria != $serial) {
    //echo '<h1>THIS SOFTWARE IS PIRATED</h1>';
    //header("Location: pirated.html");
//}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="jquery/jquery.js"></script>
    <link rel="stylesheet" href="design/bbackup.css">
    <title>Backup</title>
    <?php
    require('back.php');
    require('cashers.php');
    ?>
</head>
<header>
<?php
    echo "<label class='pernam'><b>WELCOME : " .$per. "</b></label>";
    ?> 
<a class="men" href="clients.php">Credit Clients</a> 
<a class="men" href="inventory.php">Items</a>
<a class="men" href="backup.php">Backup</a>
<a class="men" href="regester.php">Regester</a>
<a class="men" href="credit.php">Credit</a>
<a class="men" href="creditbk.php">Credit Backup</a>
<a class="men" href="destroy.php">Home</a>


<h1 class="tit">Home Plus</h1> 

</header>
<body>
<div class="dispm" >

<input class="butl" type="button" value="Delete Records!" onclick="dele()" /><br><br>

<script>
    function dele(){
        if (confirm("!!ARE YOU SURE YOU WANT TO DELETE ALL BACKUP THIS CANNOT BE UNDONE!!")){
$.ajax({
url: "delbkup.php",
method: "POST",
data: {
},
cache: false,
processData: true,
success: function (msg){
$("#btmsg").html(msg);
}
});
        }else{
            $("#btmsg").html("DELETE BACKUP CANCEL");
        }
}
</script>   
<input class="but" type="button" onclick="printDiv('printableArea')" value="Print Backup!" /><br>
    <div class="all" id="printableArea">
        <?php
        $butotal = 0;
        $totalbu = $dbb->query("SELECT * FROM bbill");
        while ($totalres = $totalbu->fetchArray(SQLITE3_ASSOC)){
            $butotal = $butotal + $totalres['billt'];
        }
        echo 'Backup Total = $' .number_format($butotal,2);
        
    echo '<table>
        <tr>
            <th>Bill Date</th>
            <th>Items</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Bill Total</th>
            <th>Cash Tended</th>
            <th>Change</th>
        </tr>';
       
        $que = $dbb->query("SELECT * FROM bbill");
        while ($res = $que->fetchArray(SQLITE3_ASSOC)) {
            echo '<tr><td>' .$res['bdate']. '</td><td>' .$res['item']. '</td><td>' .$res['price']. '</td><td>' .$res['qty']. '</td><td>' .$res['tot']. '</td><td>' .$res['billt']. '</td><td>' .$res['castend']. '</td><td>' .$res['change']. '</td></tr>';
        }
      

         //reset auto increment id-------------------------------
      // $sql1 = "UPDATE SQLITE_SEQUENCE SET SEQ=0 WHERE NAME='regester'";
      // $dbc->exec($sql1);
      //--------------------------------------------------------
        


    echo '</table>';
    ?>
    </div>
    <p class="msgl" id="btmsg"></p>
</div>
<!-----------------print recepit------------------------------------------>


<script>
  function printDiv(printableArea) {
     var printContents = document.getElementById(printableArea).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>

<!---------------------print recepit end------------------------------------->
</body>
<footer>
    <label><a class="add" href="https://sandscomputers.godaddysites.com/home" target="_blank" title="GOTO S&S COMPUTERS" class="add">Software Design by S&S Computers.</a></label>
</footer>
</html>