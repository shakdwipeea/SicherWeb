<?php
require 'removeSoftware.php';
$soft = $statusInfo->softwares;
//var_dump($soft);
if(isset($_POST['submit'])){
$con = mysql_connect("localhost","akash","shakdwipeea") or die(" Mysql Connection Error");
mysql_select_db("security") or die("Invalid DB");

//echo var_dump($_POST['software']);

foreach($_POST['software'] as $key => $value){
  $query1 = "Select * from $value";
  $result1 = mysql_query($query1) or die(mysql_error());

  $emparray[] = array();
    while($row = mysql_fetch_assoc($result1))
    {
        $emparray[] = $row;
    }
      //echo json_encode($emparray);
    $fp = fopen("../backup/".$value.".json", 'w');
    fwrite($fp, json_encode($emparray));
    fclose($fp);

 $query2 = "DROP TABLE $value";
 $result2 = mysql_query($query2) or die(mysql_error());

 $query3 = "DELETE FROM softwarelist WHERE sname = '$value'";
 $result3 = mysql_query($query3) or die(mysql_error());
if(($key = array_search($value, $statusInfo->softwares)) !== false) {
   unset($statusInfo->softwares[$key]);
 if(!$result1 && !$result2 && !$result3)
 {
 	echo '<script>alert("Some error on deleting software")</script>';
 	echo "<script>window.location.href='index.php'</script>";
 }
 else{
   echo '<script>alert("Software Deleted!")</script>';
 	 echo "<script>window.location.href='index.php'</script>";
 }
}
}
mysql_close();
}
?>
