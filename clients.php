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
    <link rel="stylesheet" href="design/cli.css">
    <title>Credit Clients</title>
  
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
<section class="dispm">
    <section class="cout">
    <label id="delmsg"></label>
<label><b>All Clients</b></label>
<div class="cldsp" id="dsp">
    <script>
    $.ajax({
    url: "cusdisp.php",
    method: "POST",
    data: {
    },
    cache: false,
    processData: true,
    success: function (cus){
    $("#dsp").html(cus);
    }
    });
    
function del(element){
    var delid = element.value;
    if(confirm("ARE YOU SURE YOU WNAT TO DELETE THIS CUSTOMER THIS CANNOT BE UNDONE")){
        $.ajax({
    url: "cusdel.php",
    method: "POST",
    data: {
        deid: delid
    },
    cache: false,
    processData: true,
    success: function (delcus){
    $("#delmsg").html(delcus);
    $("#dsp").load("cusdisp.php").fadeIn("slow");
    }
    });
    }else{
        alert ("Customer Delete Canceled");
    }
}
</script>
</div>

</section>

<section class="updcli">
    <div class="ins">
    <label><b>Save Client Info</b></label><br><br>
    <label for="fn">First Name :</label>
    <input type="text" id="fn" placeholder="john">
    <label for="ln">First Name :</label>
    <input type="text" id="ln" placeholder="doe"><br><br>
    <label for="adr">Address :</label><br>
    <textarea id="adr" cols="50" rows="2" placeholder="00 frog lane, curry village, penal."></textarea><br>
    <label for="cel">Cell# :</label>
    <input style="width: 10%;" type="text" id="cel" placeholder="123 4567">
    <label for="cdp">Client ID/DP# :</label>
    <input style="width: 15%;" type="number" id="cdp" placeholder="18000511666"><br><br>
    <input class="but" type="button" onclick="sav()" value="SAVE"><br>
    <label class="msg" id="svmsg"></label>
    <script>
        function sav(){
            var fsn = $("#fn").val().toUpperCase();
            var lsn = $("#ln").val().toUpperCase();
            var adre = $("#adr").val().toUpperCase();
            var cell = $("#cel").val();
            var cid = $("#cdp").val();
            if (fsn == "" || lsn == "" || cid == "" || cell == "" || adre == ""){
                alert ("ERROR ALL INFORMATION MUST BE INSERTED TO CONTINUE");
            }else{
    $.ajax({
    url: "savcli.php",
    method: "POST",
    data: {
        fstn: fsn,
        lstn: lsn,
        addr: adre,
        tel: cell,
        clid: cid
    },
    cache: false,
    processData: true,
    success: function (sv){
    $("#svmsg").html(sv);
    $("#dsp").load("cusdisp.php").fadeIn("slow");
    $("#fn").val("");
    $("#ln").val("");
    $("#adr").val("");
    $("#cel").val("");
    $("#cdp").val("");
    }
    });
            }
}
    </script>
    </div>
    <div class="upd">
    <label><b>Update Client Info</b></label><br><br>
    <label for="upid">Client ID/DP :</label>
    <input style="width: 15%;" type="number" id="upid" placeholder="18001212666">
    <div class="upinfo">
        <label><b>Update Info</b></label><br><br>
        <label for="uadr">Update Address :</label><br>
        <textarea id="uadr" cols="50" rows="2" placeholder="00 frog lane, curry village, penal."></textarea><br>
        <label for="ucel">Update Cell# :</label>
    <input style="width: 10%;" type="text" id="ucel" placeholder="123 4567"><br><br>
    <input class="but" type="button" onclick="upd()" value="UPDATE"><br>
    </div>
    <script>
        function upd(){
            var upid = $("#upid").val();
            var ucell = $("#ucel").val();
            var uadrr = $("#uadr").val().toUpperCase();
            if (upid == ""){
                alert ("ERROR CANNOT CONTINUE WITHOUT CLIENT ID/DP");
            }else if (ucell == "" && uadrr == ""){
                alert ("PLEASE ENTER ADDRESS OR CELL NUMBER TO UPDATE");
            }else{
    $.ajax({
    url: "updcli.php",
    method: "POST",
    data: {
        udpid: upid,
        udcell: ucell,
        udadrr: uadrr
    },
    cache: false,
    processData: true,
    success: function (upd){
    $("#svmsg").html(upd);
    $("#dsp").load("cusdisp.php").fadeIn("slow");
    $("#upid").val("");
    $("#ucel").val("");
    $("#uadr").val("");
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