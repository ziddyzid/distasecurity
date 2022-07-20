<?php
session_start();
require ("customerdb.php");
echo '<table class ="disptbl">
<thead>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Address</th>
    <th>Cell</th>
    <th>ID/DP</th>
    <th>Del</th>
</thead>
<tbody>';
$clique = $clidb->query("SELECT * FROM cust ORDER BY fnam ASC");
while ($clires = $clique->fetchArray()){
 echo "<tr>
 <td>" .$clires['fnam']. "</td>
 <td>" .$clires['lnam']. "</td>
 <td>" .$clires['addr']. "</td>
 <td>" .$clires['cell']. "</td>
 <td>" .$clires['iddp']. "</td>
 <td><button type='button' onclick='del(this)' value='" .$clires['id']. "'>Del</button></td>
</tr>";   
}
echo '</tbody>
</table>';
?>