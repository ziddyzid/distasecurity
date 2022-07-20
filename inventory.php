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
    <link rel="stylesheet" href="design/inven.css">
    <title>Inventory</title>
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

<section class="allm">
<!-------------insert items------------------->
<div class="init">
<p class="tit"><b>Insert New Item</b></p> 
<label>Category : </label><select id="catego">
    <option value="general">General</option>
    <option value="electronic">Electronic</option>
    <option value="furniture">Furniture</option>
    <option value="appliances">Appliances</option>
    <option value="tools">Tools</option>
    <option value="misce">Miscellaneous</option>
</select><br><br>
<label>Barcode : </label><input type="text" id="icode" placeholder="Item Code...">
<label>Item : </label><input type="text" id="iname" placeholder="Item Name..."><br>
<label>Size : </label><input size="2px" type="text" id="isize" placeholder="...">
<label>Cost Price : </label><input class="innum" type="number" id="icprice" value="0.00">
<label>Sale price : </label><input class="innum" type="number" id="isprice" value="0.00"><br>
<label>Note : </label><input type="text" id="inote" placeholder="Note...">
<label>Quantity : </label><input size="2px" type="text" id="iqty" placeholder="qty..."><br>
<input class="but" type="button" onclick="sav()" value="Save"><br>
<script>
    function sav() {
        var cat = $("#catego").val().toUpperCase();
        var pcd = $("#icode").val();
        var pna = $("#iname").val().toUpperCase();
        var psz = $("#isize").val();
        var pcop = $("#icprice").val();
        var psap = $("#isprice").val();
        var pno = $("#inote").val().toUpperCase();
        var pqt = $("#iqty").val();
        if (pcd == "" || pna == "" || pcop == "" || psap == "" || pqt == ""){
            alert ("ERROR These fields needs to be filled out to continue Barcode, Item, Cost Price, Sale Price and Quantity.");
        }else{
$.ajax({
url: "insinv.php",
method: "POST",
data: {
    catg: cat,
    pcod: pcd,
    pnam: pna,
    psiz: psz,
    pcos: pcop,
    psal: psap,
    pnot: pno,
    pqty: pqt
},
cache: false,
processData: true,
success: function (savpro){
$("#savmsg").html(savpro);
$("#dsp").load("protbl.php").fadeIn("slow");
$("#catego").prop('selectedIndex',0);
$("#icode").val("");
$("#iname").val("");
$("#isize").val("");
$("#icprice").val("0.00");
$("#isprice").val("0.00");
$("#inote").val("");
$("#iqty").val("");
}
});
        }
}
function dele(element){
        if (confirm("ARE YOU SURE YOU WANT TO DELETE THIS ITEM")){
        var idel = element.value;
        ;
$.ajax({
url: "delite.php",
method: "POST",
data: {
    itdel: idel
},
cache: false,
processData: true,
success: function (dei){
$("#delmsg").html(dei);
$("#dsp").load("protbl.php").fadeIn("slow");
$("#delit").val("");
}
});
    }else{
        console.log('ITEM WAS NOT DELETED.');  
    }
}
</script>
<label id="savmsg"></label>
</div>
<!-------------insert items end------------------->

<!-------------display all items ------------------->
<div class="all">
<label><b>All Items</b></label>
<input class="but" type="button" onclick="res()" value="Reset"><br>
<label>Category : </label><select id="dopt">
<option value="general">General</option>
    <option value="electronic">Electronic</option>
    <option value="furniture">Furniture</option>
    <option value="appliances">Appliances</option>
    <option value="tools">Tools</option>
    <option value="misce">Miscellaneous</option>
</select>
<input class="but" type="button" onclick="discat()" value="Display">

<div id="dsp">
    <script>
        function res(){
            $("#dsp").load("protbl.php").fadeIn("slow");   
        }
        function discat(){
            var sepro = $("#dopt").val().toUpperCase();
    $.ajax({
    url: "procat.php",
    method: "POST",
    data: {
        selpro: sepro
    },
    cache: false,
    processData: true,
    success: function (tbl){
    $("#dsp").html(tbl);
    $("#dopt").prop("selectedIndex",0);
    }
    });   
        }
    $.ajax({
    url: "protbl.php",
    method: "POST",
    data: {
    },
    cache: false,
    processData: true,
    success: function (tbl){
    $("#dsp").html(tbl);
    }
    });
    </script>
    </div>
    </div>
<!-------------display all items end------------------->
</section>

<section class="dispm">
<!-------------update items------------------->
<div class="disp">
<p class="tit">Update Items</p>
<label>Item or Code :</label>
<input type="text" id="itcd" placeholder="enter item or b-code...">
<div class="uite">
<label class="tit">Update Information</label><br>
<label>Size : </label><input size="2px" type="text" id="usize" placeholder="...">
<label>Cost Price : </label><input class="innum" type="number" id="ucprice" value="0.00">
<label>Sale price : </label><input class="innum" type="number" id="usprice" value="0.00"><br>
<label>Note : </label><input type="text" id="unote" placeholder="Note...">
<label>Quantity : </label><input size="2px" type="text" id="uqty" placeholder="qty..."><br>
<input class="but"  type="button" onclick="upd()" value="Update">
<script>
    function upd(){
        var uite = $("#itcd").val().toUpperCase(); 
        var usz = $("#usize").val();
        var ucop = $("#ucprice").val();
        var usap = $("#usprice").val();
        var uno = $("#unote").val().toUpperCase();
        var pqt = $("#uqty").val();
        if (uite == ""){
            alert ("PLEASE ENTER A ITEM NAME OR CODE AND CHOOSE THE CORRECT CATEGORY TO CONTINUE.");
        }else{ 
$.ajax({
url: "updinv.php",
method: "POST",
data: { 
    upite: uite, 
    upsz: usz,
    upcop: ucop,
    upsap: usap,
    upno: uno,
    upqt: pqt
},
cache: false,
processData: true,
success: function (updpro){
$("#updmsg").html(updpro);
$("#dsp").load("protbl.php").fadeIn("slow");
$("#itcd").val(""); 
$("#usize").val("");
$("#ucprice").val("0.00");
$("#usprice").val("0.00");
$("#unote").val("");
$("#uqty").val("");
}
});
        } 
}
</script>
</div>
<label id="updmsg"></label>
</div>
<!-------------display selected items end------------------->
<div class="alls">
<label><b>INVENTORY RE-ORDER ALERTS</b></label><br><br>
<label for="rolev">Select Level</label>
<select id="rolev">
    <option value= 5>5</option>
    <option value= 10>10</option>
    <option value= 15>15</option>
    <option value= 20>20</option>
    <option value= 25>25</option>
    <option value= 30>30</option>
    <option value= 35>35</option>
</select>
<input type="button" onclick="serch()" value="Search">
<div class="reord" id="ordlev">   
<script>
    $.ajax({
    url: "dereorder.php",
    method: "POST",
    data: {
    },
    cache: false,
    processData: true,
    success: function (def){
        $("#ordlev").html(def);
    }
    });
    
    function serch(){
        var lev = $("#rolev").val();
$.ajax({
url: "reorder.php",
method: "POST",
data: {
    leve: lev
},
cache: false,
processData: true,
success: function (realt){
$("#ordlev").html(realt);
}
});
}
</script>
</div>

    
</div>
</section>

</body>
<footer>
    <label><a class="add" href="https://sandscomputers.godaddysites.com/home" target="_blank" title="GOTO S&S COMPUTERS" class="add">Software Design by S&S Computers.</a></label>
</footer>
</html>