<?php
require './StatusInfo.php';
$con = mysql_connect("localhost","akash","shakdwipeea");
if(!$con)
{
	die("Error in Connection!".mysql_error());
}
$login = $_POST["email"];
$pass = $_POST["password"];
if($login!="" && $pass!="")
{
    mysql_select_db("security") or die("Invalid DB");
    $data =  mysql_query("Select * from users where email='$login'") or die("Query Error");
    $info = mysql_fetch_array($data);
    if($info){
    $dlogin = $info["email"];
    $dpass = $info["pass"];
    $cname = $info['name'];
    $org = $info['org'];
    $contact_info = $info['mob'];
    if(!(strcmp($dpass,md5($pass))) && !(strcmp($dlogin, $login)))
    {
        startHtml($login,$cname,$contact_info,$org);
        //echo(md5($pass));
    }
    else {
    /* 	printf("Pass: %s\n Login: %s\n",$pass,$login); */
        echo "<a href=./login/login.php>Login</a>";
    }
}
else {
	echo "User Doesnt Exist!";

}

}
else
{
echo "Missing Values <br>";
echo $_POST["pass"];
}
?>

		<?php
		function startHtml($login,$cname,$contact_info,$org)
		{
			
			//$html_file = file_get_contents(".html");
			// $doc = new DOMDocument();
			// $doc->loadHTMLFILE("View2.html");
			// echo $doc->saveHTML();
			
			$query = "Select * from $org";
			$results = mysql_query($query);
			
			
			$softwares = array();
			while($row = mysql_fetch_array($results))
				array_push($softwares, $row['sname']);
			
			
			session_start();
			$statusInfo = new StatusInfo();
			$statusInfo->setSoftwares($softwares);
			$statusInfo->setInfo($cname,$login,$contact_info);
			$_SESSION['statusInfo'] = $statusInfo;
			header( 'Location: ./form/index.php' );
  			exit();
		}
		?>	

<html>
	<head>
	<title>
		Home Page
	</title>
	</head>
	<body>
	</body>
</html>
