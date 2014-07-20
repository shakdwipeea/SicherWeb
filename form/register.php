<?php

$caps = range('A', 'Z');
$small = range('a', 'z');

require ('../StatusInfo.php');
session_start();
if(!isset($_SESSION["statusInfo"]))
{
echo("Invalid Access");
exit(1);
}
else{
	$statusInfo = $_SESSION["statusInfo"];
	//print_r($statusInfo);	
}

if(isset($_POST['submit'])){
$name = $_POST["name"];
$email = $_POST["email"];
$software = $_POST["software"];
$keys = $_POST["keys"];
$trial =$_POST["version"];
$count = $_POST["count"];
$table = $statusInfo->softwares[$software];
$statusInfo->software = $table;
$flag = 0;
    unset($_POST['submit']);

    if($trial == 0 && $count == 0){
        echo "<script>alert('Missing Values!');</script>";
        echo "<script>window.location.href='index.php';</script>";
    }

if($name=="" || $email == "" || $software == "" || $keys == "")
{
	echo "<script>alert('Missing Values!');</script>";
	echo "<script>window.location.href='index.php';</script>";
}


$con = mysql_connect("localhost","akash","shakdwipeea") or die(" Mysql Connection Error");

for($x=0;$x<$keys;$x++){
	if($statusInfo->keyType == "Simple"){
	
	$key[$x] = get_random_no(20);
	$statusInfo->addKey($key[$x],$x);
	
	}
	else{
	
		$key[$x] = get_SecureKey();
		$statusInfo->addKey($key[$x],$x);
	}
}

$statusInfo->addEmail($name,$email);

mysql_select_db("security") or die("Invalid DB");


for($x=0;$x<$keys;$x++){
    $query = "Insert into $table values('$name','$key[$x]',NULL,'$email','$trial','$count')";
    //echo($query);
    $res = mysql_query($query) or die('Error in 1' . mysql_error());
    if(!$res)
    {
        echo '<script>alert("Failed Retry!");</script>';
        echo "<script>window.location.href='index.php';</script>";
    }
    else {
        $flag++;
    }
    //populating the keylist table
   $query2 = "insert into  keylist values ('$key[$x]','$table',0,'$trial')";
    $res2 = mysql_query($query2) or die(mysql_error());
    if(!$res2)
        {
            echo '<script>alert("Failed Retry!");</script>';
            echo "<script>window.location.href='index.php';</script>";
        }



}

mysql_close();

if($flag == $keys)
{
echo "<script> alert('User Registered Successfully');</script>";
sendMail();
}
else
{
echo "<script> alert('Partial Registration');<script>";
echo "<script>window.location.href='index.php';</script>";
}
}
else{
	echo("Form Not submitted");
}

function get_SecureKey()
{
	
	$SecureKey = "";
	
	
	$kH = $GLOBALS['statusInfo']->kH;
	$caps = $GLOBALS['caps'];
	$small = $GLOBALS['small'];
	/* echo "Length = ".sizeof($kH)."<br>"; */
	
	for($i = 0; $i<5; $i++){
	
	$subKey = "";
	$r = substr(number_format(time() * rand(),0,'',''),3,3) % sizeof($kH);
	$a = str_split($kH[$r]);
	
	foreach($a as $k=>$v)
	{
		switch($v){
			
			case "A":
			$subKey = $subKey.$caps[substr(number_format(time() * rand(),0,'',''),5,3) % 26];
			break;
			
			case "N":
				$subKey = $subKey.(substr(number_format(time() * rand(),0,'',''),5,3) % 10);
			break;
			
			case "a":
				$subKey = $subKey.$small[substr(number_format(time() * rand(),0,'',''),5,3) % 26];
			break;
		}
	}
	
	
	$SecureKey = $subKey."-".$SecureKey;
	}
	
	$SecureKey[strlen($SecureKey)-1] = "";
//	print_r($SecureKey);
	return $SecureKey;
}

function get_random_no($len) {
	$random = substr(number_format(time() * rand(), 0, '', ''), 0, $len);	 
	return $random;
}

function sendMail(){
    //echo "In sendmailaaaaa";
	//echo "<script>alert('User Registered. Key sent to email.');</script>";
    echo "<script>window.location.href='mailer.php'</script>";
   // header("Location: ./mailer.php");
}

?>
