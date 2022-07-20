<?php
session_start();
require('button.php');
require('products.php');
$mkbsr = filter_input(INPUT_POST,"btnco");
$mkbque = $dbp->query("SELECT * FROM list WHERE bcode = '$mkbsr'");
$mkbres = $mkbque->fetchArray();
if ($mkbres){
$butite = $mkbres['item'];
$butcod = $mkbres['bcode'];
$butprc = $mkbres['sprice'];
$cheb = $dbbu->query("SELECT * FROM but WHERE bucode = '$mkbsr'");
$chebres = $cheb->fetchArray();
        if (! $chebres){
        $dbbu->exec("INSERT INTO but (bucode, buitem) VALUES ('$butcod', '$butite')");
        echo "ITEM BUTTON CREATED SUCCESSFULLY";
            }else if ($chebres){
                echo "CANNOT MAKE DUPLICATE BUTTON ITEM ALREADY HAS A FAST CASH BUTTON";
            }
}
else if (! $mkbres){
    echo "ERROR ITEM NOT IN INVENTORY CHECK CODE AND TRY AGAIN!!";
}
?>