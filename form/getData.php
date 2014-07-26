<?php
/**
 * Created by PhpStorm.
 * User: Akash
 * Date: 19/7/14
 * Time: 8:43 PM
 */

$q = $_GET['q'];
$display = $_GET['display'];
$con = mysqli_connect('localhost','akash','shakdwipeea','security');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"security");
$sql="SELECT * FROM userlist WHERE software = '".$q."'";
$result = mysqli_query($con,$sql);

$html = "<h2>".strtoupper($q)."</h2><br><br>";

$html .= "<table id='table' border='1'>
<tr>
<th>Name</th>
<th>Email</th>
<th>Email of Distributer</th>
<th>phone</th>
<th>address</th>
<th>city</th>
<th>country</th>
</tr>";



while($row = mysqli_fetch_array($result)) {
   $html .= "<tr>";
    $html .= "<td>" . $row['Name'] . "</td>";
    $html .= "<td>" . $row['email'] . "</td>";
    $html .= "<td>" . $row['emailVerifier'] . "</td>";
    $html .= "<td>" . $row['phone'] . "</td>";
    $html .= "<td>" . $row['address'] . "</td>";
    $html .= "<td>" . $row['city'] . "</td>";
    $html .= "<td>" . $row['country'] . "</td>";
    $html .= "</tr>";
}
$html .= "</table>";

if($display == 1)
echo $html;

mysqli_close($con);
?>