<?php
session_start();
$per = $_SESSION['user'];
$pstat = $_SESSION['status'];
if ($pstat == ""){
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
    <link rel="stylesheet" href="design/credbk.css">
    <title>Credit</title>
  
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
<section class="mainsec">
<section class="lftsec">
    <label class="lfttit">All Credit Backup</label>
    <input class="sa" type="button" onclick="pri('crdp')" value="Print/Save">
    <input class="de" type="button" onclick="dele()" value="Delete All">
    <div class="lfttbl" id="crdp">
       <script>
        function dele(){
            if (confirm("WARNING THIS ACTION CANNOT BE UNDONE ARE YOU SURE YOU WANT TO DELETE ALL CREDIT BACKUP RECORDS")){
            $.ajax({
       url: "bkcreddel.php",
       method: "POST",
       data: {
       },
       cache: false,
       processData: true,
       success: function (de){
       $("#clirec").html(de);
       $("#crdp").load("bkcred.php").fadeIn("slow");
       $("#crpay").load("bkcrpay.php").fadeIn("slow");
       }
       });
            }else{
                alert ("DELETE ALL CREDIT BACKUP HAS BEEN CANCEL BY USER");
            }
        }
        function pri(crdp){
            var pcon = document.getElementById("crdp").innerHTML;
            var pmcon = document.getElementById("crpay").innerHTML;
            var ocon = document.body.innerHTML;
            document.body.innerHTML = pcon + "<br>" + pmcon;
            window.print();
            document.body.innerHTML = ocon;
        }
       $.ajax({
       url: "bkcred.php",
       method: "POST",
       data: {
       },
       cache: false,
       processData: true,
       success: function (cdp){
       $("#crdp").html(cdp);
       }
       });
       </script> 
    </div>
</section>

<section class="midsec">
<label class="lfttit">All Credit Payments</label>
    <div class="midtbl" id="crpay">
    <script>
    $.ajax({
    url: "bkcrpay.php",
    method: "POST",
    data: {
    },
    cache: false,
    processData: true,
    success: function (crp){
    $("#crpay").html(crp);
    }
    });
    </script>
    </div>
    
</section>

<section class="rgtsec">
<label class="lfttit">Search Credit Payments</label><br>
<label style="float: left;" for="serid">Client ID/DP</label>
<input style="float: left;" class="serwdt" type="number" id="serid" placeholder="enter id/dp">
<input class="de" type="button" onclick="sercli()" value="Search">
<input class="sa" type="button" onclick="prt('clirec')" value="Print/Save">
<script>
function  prt(clirec){
    var pcon = document.getElementById("clirec").innerHTML;
    var ocon = document.body.innerHTML;
    document.body.innerHTML = pcon;
    window.print();
    document.body.innerHTML = ocon;
}
</script>
    <div class="rgttbl" id="clirec">
    <br><br><br><h1 style="color: green;">ENTER CLIENT ID OR DP TO SEE FULL CREDIT RECORD</h1>
    <script>
        function sercli(){
            var clid = $("#serid").val();
            if (clid == ""){
                alert ("PLEASE ENTER CLIENT ID OR DP TO CONTINUE");
            }else{
    $.ajax({
    url: "clicrrec.php",
    method: "POST",
    data: {
        clidr: clid
    },
    cache: false,
    processData: true,
    success: function (crec){
    $("#clirec").html(crec);
    }
    });
            }
}
    </script>
    </div>
</section>


    
</section>
</body>
<footer>
    <label><a class="add" href="https://sandscomputers.godaddysites.com/home" target="_blank" title="GOTO S&S COMPUTERS" class="add">Software Design by S&S Computers.</a></label>
</footer>
</html>