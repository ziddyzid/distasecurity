<?php
session_start();
$_SESSION['cash'] = "0.00";
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
    <meta name="viewport" >
    <script src="jquery/jquery.js"></script>
    <link rel="stylesheet" href="design/login.css">
    <title>Sign-In</title>
    
</head>
<header>
<h1 class="tit">Home Plus</h1> 
</header>
<body>
<section class="dispm">
<div class="allo">
    <h1 class="tit">Administrator<br>Log-in</h1>
    <label class="un">Username : </label><input type="text" id="user" size="10%"><br><br>
    <label class="un">Password : </label><input type="password" id="pw" size="10%"><br><br>
    <input class="but" type="button" onclick="acc()" value="ACCESS"><br>
    <label id="admsg"></label>
    </div>
    <script>
        function acc(){
            var adpw = $("#pw").val();
            var au = $("#user").val();
            var adusr = au.toUpperCase();
        if (adpw == "" || au == ""){
            alert ("ERROR PLEASE ENTER A USERNAME & PASSWORD!!!");
            $("#pw").val("");
            $("#user").val("");
        }else{
    $.ajax({
    url: "adminlog.php",
    method: "POST",
    data: {
        admpw: adpw,
        admusr: adusr
    },
    cache: false,
    processData: true,
    success: function (ada){
        $("#admsg").html(ada);
        $("#pw").val("");
        $("#user").val("");
        var s = document.getElementById("al").innerHTML;
        if (s == "1"){
            location.href = "inventory.php";
        }
    }
    });
        }
}
    </script>

<div class="all">
<label class="un">Admin PW : </label><input type="password" id="adpwdel" size="6%"><br>
<label class="un">Status : </label>
        <select class="opt" id="ustatus">
            <option value="user" selected="selected">USER</option>
            <option value="admin">ADMIN</option>
        </select> 
    <h1 class="tit">Delete User</h1>
    <label class="un">User : </label><input type="text" id="deluser" size="10%"><br><br>
    <input class="but" type="button" onclick="delacc()" value="DELETE"><br>
    <label id="delmsg"></label>
</div>
    <script>
        function delacc(){
            var adpw = $("#adpwdel").val();
            var st = $("#ustatus").val();
            var delus = $("#deluser").val();
            var dus = delus.toUpperCase();
    $.ajax({
    url: "delusr.php",
    method: "POST",
    data: {
        admpw: adpw,
        sta: st,
        deus: dus
    },
    cache: false,
    processData: true,
    success: function (del){
            $("#delmsg").html(del);
            $("#adpwdel").val("");
            $("#deluser").val("");
            $("#ustatus").prop('selectedIndex', 0);
            $("#ausr").load("allusr.php").fadeIn("slow");
    }
    });
}
    </script>

    <div class="nusr">
    <label class="un">Admin PW : </label><input type="password" id="adpw" size="6%">
        
    <h1 class="tit">Create New User</h1>
    <label class="un">Status : </label>
        <select class="opt" id="statu">
            <option value="user" selected="selected">USER</option>
            <option value="admin">ADMIN</option>
        </select> 
    <label class="un">User : </label><input type="text" id="nuser" size="8%"><br><br>
    <label class="un">Password : </label><input type="password" id="npw" size="8%"><br>
    <label class="un">Re-enter Password : </label><input type="password" id="rnpw" size="8%"><br><br>
    <input class="but" type="button" onclick="nacc()" value="SAVE"><br>
    <label id="numsg"></label>
    </div>
    <script>
        function nacc(){
            var st = $("#statu").val();
            var aps = $("#adpw").val();
            var nus = $("#nuser").val();
            var nusr = nus.toUpperCase();
            var nps = $("#npw").val();
            var rnps = $("#rnpw").val();
            
            if(aps == "" || nus == "" || nps == "" || rnpw == ""){
                alert ("ERROR ALL FIELDS MUST BE FILLED TO CONTINUE");
            }else if (nps != rnps){
                alert ("ERROR BOTH PASSWORD IS NOT THE SAME TRY AGAIN");
            }
            else{
    $.ajax({
    url: "newusr.php",
    method: "POST",
    data: {
        nst: st,
        naps: aps,
        nnus: nusr,
        nnps: nps,
        nrnps: rnps
    },
    cache: false,
    processData: true,
    success: function (nac){
    $("#numsg").html(nac);
    $("#ausr").load("allusr.php").fadeIn("slow");
    $("#statu").prop('selectedIndex', 0);
    $("#adpw").val("");
    $("#nuser").val("");
    $("#npw").val("");
    $("#rnpw").val("");
    }
    });
            }
}
    </script>
</section>

<section class="dispm2">
<div class="all">
    <h1 class="tit">Casher<br>Log-in</h1>
    <label class="un">Username : </label><input type="text" id="cuser" size="10%"><br><br>
    <label class="un">Password : </label><input type="password" id="cpw" size="10%"><br><br>
    <input class="but" type="button" onclick="accu()" value="ACCESS"><br>
    <label id="camsg"></label>
    </div>
    <script>
        function accu(){
            var capw = $("#cpw").val();
            var cu = $("#cuser").val();
            var causr = cu.toUpperCase();
            if (capw == "" || cu == ""){
            alert ("ERROR PLEASE ENTER A USERNAME & PASSWORD!!!");
            $("#cpw").val("");
            $("#cuser").val("");
        }else{
    $.ajax({
    url: "casherlog.php",
    method: "POST",
    data: {
        caspw: capw,
        casusr: causr
    },
    cache: false,
    processData: true,
    success: function (cda){
        $("#camsg").html(cda);
        $("#cpw").val("");
        $("#cuser").val("");
        var s = document.getElementById("al").innerHTML;
        if (s == "1"){
            location.href = "regester.php";
        }
    }
    });
        }
}
    </script>
    <div class="ans">
    <h1 class="tit">All Users<br>(FOR DEMO PURPOSE)</h1>
    <div id="ausr">
    <script>
    $.ajax({
    url: "allusr.php",
    method: "POST",
    data: {
    },
    cache: false,
    processData: true,
    success: function (all){
    $("#ausr").html(all);
    }
    });
    </script>   
    </div>
    </div>
</section>
</body>
<footer>
    <label><a class="add" href="https://sandscomputers.godaddysites.com/home" target="_blank" title="GOTO S&S COMPUTERS" class="add">Software Design by S&S Computers.</a></label>
</footer>
</html>