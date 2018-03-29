<?php 
require_once '../config/ini_config.php';
require_once '../api/dbquery.php';
require_once '../view/other_user.php';
session_start();
$tables =new DbQuery();
$table = [];
$table[0] = 'name';
$table[1] = 'email';
$table[2] = 'phone';
$table[3] = 'dob';
$table[4] = 'gender';

$email =$_SESSION['email'];

$tableRow = array($tables->select('user', $table, '', ''));
echo "<table id='myTable' class='display'>
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>DOB</th>
            <th>Gender</th>
        </tr>
    </thead>";
echo "<tbody class ='table'>";

for ($i = 0; $i < (sizeof($tableRow, 1)/5) - 1; $i++) {
    if ($email != $tableRow[0][$i][1]) {
            echo "<tr>";
            echo "<td>";
            echo ($tableRow[0][$i][0]);
            echo "</td>";
            echo"<td>";
            echo $tableRow[0][$i][1];
            echo "</td>";
            echo "<td>";
            echo $tableRow[0][$i][2];
            echo "</td>";
            echo "<td>";
            echo $tableRow[0][$i][3];
            echo "</td>";
            echo "<td>";
            echo $tableRow[0][$i][4];
            echo "</td>";
            echo "</tr>";
    }
}

echo "</tbody>
</table>";
