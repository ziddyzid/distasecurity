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
    <link rel="stylesheet" href="design/rege.css">
    <title>Regester</title>
  
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
  <!-------Insert into recipet ------>
  <section class="mstr">

<div class="cout">
  <label id="demsg" class="err"></label><br>
  <div class="ctnn">
  <input class="but" type="button" value="Cash Tend" onclick="ctd()">
  <input style="width:35%;" type="number" id="amo" value="0.00">
</div>
<script>
  function ctd(){
    var ct = $("#amo").val();
    var to = document.getElementById("t").innerHTML;
$.ajax({
url: "caten.php",
method: "POST",
data: {
  cte: ct,
  tota: to
},
cache: false,
processData: true,
success: function (ctn){
$("#ten").html(ctn);
}
});
}
</script>
<div class="deit" style="float: right;">
 <input type="number" style="width:40%;" id="dit" placeholder="Del Item ">
<input class="but" type="button" value="DEL" onclick="dele()">
<input class="but" type="button" onclick="neb()" value="New Bill">
<script>
  function neb(){
    var buda = da;
$.ajax({
url: "newbl.php",
method: "POST",
data: {
  bkdat: buda
},
cache: false,
processData: true,
success: function (nbl){
  $("#demsg").html(nbl);
  $("#shotbl").load("bldsp.php").fadeIn("slow");
  $("#amo").val("0.00");
  document.getElementById("ten").innerHTML = "";
}
});
}
  function dele(){
    var deit = $("#dit").val();
    if (deit == ""){
      alert ("PLEASE ENTER REGESTER ITEM ID# TO CONTINUE");
    }else{
$.ajax({
url: "delreg.php",
method: "POST",
data: {
  dite: deit
},
cache: false,
processData: true,
success: function (di){
$("#demsg").html(di);
$("#shotbl").load("bldsp.php").fadeIn("slow");
$("#dit").val("");
}
});
    }
}
</script>
<input class="but" style="float:right;" type="button" onclick="printDiv('printableArea')" value="print Recipet!" />
 </div><br><br><br>
 <script>
  function printDiv(printableArea) {
     var printContents = document.getElementById(printableArea).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
<label id="dat"></label>
<script>
const da = new Date().toLocaleString();
  document.getElementById("dat").innerHTML = da;
</script>
<section class="pr" id="printableArea">
<div class="reci">
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
<table class="btbl">
  <thead>
    <tr id='ten'>
    </tr>
  </thead>
</table>
</section>
</div>
 <!-------Insert into recipet end------>
 <div class="allm" >

<div class="dcm">
 <!--input cash directly--> 
       <label>CASH INPUT</label><br>
    <input class="siz" type="text" value="" id="mvar" /><br>
    <input class="dirc" type="button" class="fbutton" value="1" id="1" onClick=addNumber(this); />
    <input class="dirc" type="button" class="fbutton" value="2" id="2" onClick=addNumber(this); />
    <input class="dirc" type="button" class="fbutton" value="3" id="3" onClick=addNumber(this); />
    <input class="dirc" type="button" class="fbutton" name="x" value="x" id="x" onClick=mulNumber(this); />
    <input class="dirc" type="button" class="fbutton" value="cl  " id="c" onClick=delNumber(this); /><br>
    <input class="dirc" type="button" class="fbutton" value="4" id="4" onClick=addNumber(this); />
    <input class="dirc" type="button" class="fbutton" value="5" id="5" onClick=addNumber(this); />    
    <input class="dirc" type="button" class="fbutton" value="6" id="6" onClick=addNumber(this); />
    <input class="dirc" type="button" class="fbutton" value="." id="d" onClick=addNumber(this); />
    <input class="dirc" type="button" class="fbutton" value=" " id="s" onClick=subNumber(this); /><br>
    <input class="dirc" type="button" class="fbutton" value="7" id="7" onClick=addNumber(this); />
    <input class="dirc" type="button" class="fbutton" value="8" id="8" onClick=addNumber(this); />
    <input class="dirc" type="button" class="fbutton" value="9" id="9" onClick=addNumber(this); />
    <input class="dirc" type="button" class="fbutton" value="0" id="0" onClick=addNumber(this); />
    <input class="dirc" type="button" class="fbutton" value="=" id="e" onClick=equNumber(this); /><br>
   
    <input style="background-color: red;" type="button" value="DIRECT CASH" onclick="dcash()">
     <!-------------------------input cash directly end------------------------------------------>
      <!--js for input cash directly buttons-->  
    <script>
function addNumber(element){
  document.getElementById('mvar').value = document.getElementById('mvar').value+element.value;
}
function delNumber(element){
  document.getElementById('mvar').value = "";
}
function mulNumber(element){
  mul = document.getElementById('mvar').value;
  document.getElementById('mvar').value = "";
  val = document.getElementById('x').value;
  localStorage.setItem("mult", mul);
  localStorage.setItem("valu", val);
  
}
function equNumber(element){
  xx =localStorage.getItem("mult");
  xxx = localStorage.getItem("valu");
  if (xxx = "*"){
  xx2 = document.getElementById("mvar").value;
  ans = xx2 * xx;
  document.getElementById('mvar').value = ans;
  localStorage.removeItem("multi");
  localStorage.removeItem("valu");
}
else{
  
  alert ("error");
}
}
function dcash(){
  var outp = $("#mvar").val();
  if (outp == ""){
    alert ("ERROR DIRECT CASH OUTPUT IS EMPTY PLEASE ENTER CASH AMOUNT TO CONTINUE");
  }else{
$.ajax({
url: "dircas.php",
method: "POST",
data: {
  otpt: outp
},
cache: false,
processData: true,
success: function (dic){
  $("#demsg").html(dic);
  $("#mvar").val("");
  $("#shotbl").load("bldsp.php").fadeIn("slow");
}
});
    }
}
</script>
<!--------------js for input cash directly buttons end-------------------->
</div>
<div class="bcit1" id="prodis">
  <script>
  $.ajax({
  url: "disppro.php",
  method: "POST",
  data: {
  },
  cache: false,
  processData: true,
  success: function (pdis){
  $("#prodis").html(pdis);
  }
  });

  function bitem(value){
    var bpro = value;
    var qta = $("#qty1").val(); 
$.ajax({
url: "allpcas.php",
method: "POST",
data: {
  butp: bpro,
  qtal: qta
},
cache: false,
processData: true,
success: function (btnp){
  $("#shotbl").load("bldsp.php").fadeIn("slow");
  $("#qty1").val("1");
  $("#demsg").html(btnp);
}
});
}
  </script>

</div>
<div class="bcit" >
  <!--------------inputby item or code -------------------->
  <label>BARCODE / ITEM INPUT</label><br><br>
  <label>B-Code : </label><input type="text" id="bcod" ><br><br>
  <label>Item : </label><input type="text" id="prod" ><br><br>
  <label>Qty : </label><input size="3px" type="text" id="brqty" value="1"><br><br>
  <input class="but" type="button" value="ADD ITEM" onclick="adb()"><br>
  <script>
    function adb(){
      var brcod = $("#bcod").val();
      var aproi = $("#prod").val();
      var proi = aproi.toUpperCase();
      var bcqty = $("#brqty").val();
      if (brcod == "" && proi == ""){
        alert ("ERROR PLEASE ENTER A BARCODE OR ITEM TO CONTINUE");
      }else if (brcod != "" && proi != ""){
        alert ("ERROR CANNOT ENTER A BARCODE AND ITEM TOGETHER ENTER ONLY ONE BARCODE OR ITEM!!");
      }else{
  $.ajax({
  url:"bcodcas.php",
  method: "POST",
  data: {
    bcd: brcod,
    ipr: proi,
    bcqt: bcqty
  },
  cache: false,
  processData: true,
  success: function (adbc){
    $("#shotbl").load("bldsp.php").fadeIn("slow");
    $("#demsg").html(adbc);
    $("#bcod").val("");
    $("#prod").val("");
    $("#brqty").val("1");
  }
  });
      }
}
  </script>
</div>
</div>
  <!--------------inputby item or code end-------------------->
  <!--------------button make / delete-------------------->
<div class="butm">

<div class="debt">
  <form method="POST" action="regester.php">
<label>"Quantity"</label><br>
<input class="qtsz" type="number" id="butqy" value="1" >
</div>

<div class="mkbt" >
<input class="but" type="button" onclick="mak()" value="Set Button">

<input type="text" id="buco" placeholder="Enter B-Code">
<script>
  function mak(){
    var btcod = $("#buco").val();
    if (btcod == ""){
      alert ("ERROR TO MAKE A BUTTON THE ITEM BARCODE# IS NEEDED!!");
    }else{
$.ajax({
url: "mkbut.php",
method: "POST",
data: {
  btnco: btcod
},
cache: false,
processData: true,
success: function (mbut){
  $("#demsg").html(mbut);
  $("#buco").val("");
  $("#bdip").load("butdisp.php").fadeIn("slow");
}
});
    }
}
function btcode(value){
  var butcd = value;
  var butq = $("#butqy").val();
  $.ajax({
url: "casbut.php",
method: "POST",
data: {
  bcod: butcd,
  buqty: butq
},
cache: false,
processData: true,
success: function (butca){
  $("#shotbl").load("bldsp.php").fadeIn("slow");
  $("#butqy").val("1");
  $("#demsg").html(butca);
}
});
}

</script>
</div>

<h3 style="text-align: center;">Fast Cash</h3><br>
<div class="btaera" id="bdip">
<script>
$.ajax({
url: "butdisp.php",
method: "POST",
data: {
},
cache: false,
processData: true,
success: function (bdisp){
$("#bdip").html(bdisp);
}
});
</script>

</div>
</div>
<!--------------button make / delete end-------------------->
</section>
</body>
<footer>
    <label><a class="add" href="https://sandscomputers.godaddysites.com/home" target="_blank" title="GOTO S&S COMPUTERS" class="add">Software Design by S&S Computers.</a></label>
</footer>
</html>