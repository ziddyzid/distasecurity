<?php
session_start();
require ("accodb.php");
echo " <table class= 'distbl'>
<thead>
    <tr>
        <th>User Name</th>
        <th>User Password</th>
        <th>User Status</th>
    </tr>
</thead>
<tbody>";
$alque = $accdb->query("SELECT * FROM acco");
while ($alres = $alque->fetchArray()){
$anm = $alres['unam'];
$apw = $alres['upw'];
$ast = $alres['stat'];
echo "<tr>
        <td>".$anm."</td>
        <td>".$apw."</td>
        <td>".$ast."</td>
        </tr>";
}
echo "</tbody>
</table>";
?>