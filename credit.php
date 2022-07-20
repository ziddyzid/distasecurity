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
    <link rel="stylesheet" href="design/cred.css">
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
<section class="credsec">
<div class="reg">
<div class="crdnam">
<label class="titl">CREDIT BILL</label><br>
<label>NAME :</label>
<label for="fnam">First: </label>
<input type="text" id="fnam" size="10" placeholder="john">
<label for="lnam">Last: </label>
<input type="text" id="lnam" size="10" placeholder="doe"><br>
<label for="adr">Address :</label>
<textarea  id="adr" cols="20" rows="3" placeholder="#36 ali mohammed rd, penal"></textarea>
<label for="tel">Cell :</label>
<input type="text" id="tel" size="7" placeholder="123 4567"><br>
<label for="iddp">ID/DP #</label>
<input class="numin" type="number" id="iddp" size="7" placeholder="18000714543"><br>
<input class="savcre" type="button" onclick="crdsav()" value="Credit Client">
<script>
    crdate = new Date().toLocaleString();
    function crdsav(){
        fst = $("#fnam").val().toUpperCase();
        lst = $("#lnam").val().toUpperCase();
        loc = $("#adr").val().toUpperCase();
        tele = $("#tel").val();
        ide = $("#iddp").val();
        if (fst == "" || lst == "" || loc == "" || tele == "" || ide == ""){
            alert ("ERROR ALL INFORMATION ON CLIENT MUST BE FILLED TO CONTINUE");
        }else{
$.ajax({
url: "credbl.php",
method: "POST",
data: {
    cdat: crdate,
    cfst: fst,
    clst: lst,
    cloc: loc,
    cel: tele,
    cide: ide
},
cache: false,
processData: true,
success: function (svcr){
$("#msgs").html(svcr);
$("#shotbl").load("bldsp.php").fadeIn("slow");
$("#crdis").load("actcred.php").fadeIn("slow");
$("#fnam").val("");
$("#lnam").val("");
$("#adr").val("");
$("#tel").val("");
$("#iddp").val("");
}
});
        }
}
</script>
</div>
    <label>Home Plus</label><br>
<div id="shotbl">

<script>
$.ajax({
url: "bldsp.php",
method: "POST",
data: {
},
cache: false,
processData: true,
success: function (tb){
$("#shotbl").html(tb);
}
});

</script>
</div>

</div>
<label id="msgs"></label>
</section>

<section class="crerec">
<div class="crser">
<label class="titl">CREDIT RECORDS</label><br>
<label for="cser">Search Credit Record :</label>
<input class="numin" type="number" id="cser" placeholder="Enter ID or DP..."><br>
<input class="creser" type="button" onclick="ser()" value="Search">
<input class="crres" type="button" onclick="res()" value="Reset">
<script>
    function res(){
        $("#crinfo").load(window.location.href + " #crinfo" ).fadeIn("slow");
    }
    function ser(){
        var criddp = $("#cser").val();
        if (criddp == ""){
            alert ("ERROR PLEASE ENTER CLIENT ID OR DP# TO CONTINUE");
        }else{
$.ajax({
url: "credinfo.php",
method: "POST",
data: {
    cliide: criddp
},
cache: false,
processData: true,
success: function (sres){
    $("#crinfo").html(sres);
    $("#cser").val("");
}
});
        }
}
</script>
</div>
<label class="titl">ACTIVE CREDIT BILLS</label>
<div class="crrec" id="crdis">
<script>
$.ajax({
url: "actcred.php",
method: "POST",
data: {
},
cache: false,
processData: true,
success: function (btdsp){
$("#crdis").html(btdsp);
}
});

</script>
</div>
</section>

<section class="crp">
<div class="crpt">
<label class="titl">CREDIT PAYMENT</label><br>
<label for="">Make Payment : </label>
<input class="pnumin" type="number" id="pym" placeholder="enter amt">
<input class="crres" type="button" onclick="pmt()" value="Save Payment">
<input class="crres" style="float: right;" type="button" onclick="prt('crinfo')" value="Print/Save">
<script>
    function prt(crinfo){
var pcon = document.getElementById('crinfo').innerHTML;
var ocon = document.body.innerHTML;
document.body.innerHTML = pcon;
window.print();
document.body.innerHTML = ocon;
}
</script>
</div>
<div class="pmtrec" id="crinfo">
<h1>!! WARNING !!<br>SEARCH CREDIT RECORDS OR SELECT FROM ACTIVE CREDIT BILL BEFOR MAKING A PAYMENT</h1>
<script>
    function pmt(){
        var credpay = $("#pym").val();
        var clieid = document.getElementById("recid").innerHTML;
        if (credpay == "" || credpay <= 0.00){
            alert ("ERROR PLEASE ENTER AMOUNT TO BE PAID >> ID# " + clieid);
        }else if (confirm("PLEASE CHECK PAYMENT AMOUNT AND BE SURE BEFORE YOU CONTINUE ( PAYMENT AMOUNT = " + credpay + ")")){
    $.ajax({
    url: "crepay.php",
    method: "POST",
    data: {
        padat: crdate,
        crpay: credpay,
        cliddp: clieid
    },
    cache: false,
    processData: true,
    success: function (crpay){
        $("#pym").val("");
        $("#crinfo").html(crpay);
    }
    });
        }else {
            alert ("PAYMENT CANCEL");
        }
}
    function cliid(element){
        var criddp = element.value;
$.ajax({
url: "credinfo.php",
method: "POST",
data: {
    cliide: criddp
},
cache: false,
processData: true,
success: function (crinf){
$("#crinfo").html(crinf);
}
});
}

function paidfull(){
    var bkcrid = document.getElementById("recid").innerHTML;
    alert (bkcrid);
$.ajax({
url: "fullpay.php",
method: "POST",
data: {
    creid: bkcrid
},
cache: false,
processData: true,
success: function (flpa){
$("#flmsg").html(flpa)
$("#crdis").load("actcred.php").fadeIn("slow");
$("#crinfo").load(window.location.href + " #crinfo" ).fadeIn("slow");
}
});
}
</script> 
   
</div>
<label id="flmsg"></label> 
</section>

</section>
</body>
<footer>
    <label><a class="add" href="https://sandscomputers.godaddysites.com/home" target="_blank" title="GOTO S&S COMPUTERS" class="add">Software Design by S&S Computers.</a></label>
</footer>
</html>