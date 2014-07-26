<?php
require './StatusInfo.php';
$con = mysql_connect("localhost","akash","shakdwipeea");
if(!$con)
{
	die("Error in Connection!".mysql_error());
}
$login = $_POST["email"];
$pass = $_POST["password"];
$fcount = 1;
if($login!="" && $pass!="")
{
    mysql_select_db("security") or die("Invalid DB");


    $data = mysql_query("select last_failed_login,incorrect_login from users where email='$login'") or die("Query Error IN 1");
    $info = mysql_fetch_array($data);
   // echo $info;
    if($info){ 
        $fdate = $info["last_failed_login"];
        $fcount = $info["incorrect_login"];
        //$fd = new DateTime($fdate);
        //$fdate = $fd->getTimestamp();
           $curr = time();
          $p =   $fdate - $curr;
       // echo "<script>alert('".$p."      ');</script>";

        if($fcount >= 5) {
            if(($curr - $fdate) < 120) {
                echo "<script>alert('Incorrect attempts exceeded.Try again after 2 minutes');</script>";
                echo "<script>".
                    "window.location.href = './login/login.php';"
                    ."</script>";
            } else {
                 check($login,$pass,$fcount);
            }
        } else {
            check($login,$pass,$fcount);
        }
    } else {
	    echo "<script>".
                  "window.location.href = './login/login.php';"
                   ."</script>";
    }






}
else
{
echo "Missing Values <br>";
echo $_POST["pass"];
}

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


        function check($login,$pass,$fcount) {
            $data =  mysql_query("Select * from users where email='$login'") or die("Query Error IN 2");
            $info = mysql_fetch_array($data);

            if($info){
                $dlogin = $info["email"];
                $dpass = $info["pass"];
                $cname = $info['name'];
                $org = $info['org'];
                $contact_info = $info['mob'];
                if(!(strcmp($dpass,md5($pass))) && !(strcmp($dlogin, $login)))
                {
                    $data = mysql_query("update users set incorrect_login='0' where email='$login'") or die(mysql_error());
                    startHtml($login,$cname,$contact_info,$org);
                    //echo(md5($pass));
                }
                else {
                    /* 	printf("Pass: %s\n Login: %s\n",$pass,*/
                    $fcount++;
                    $curr = time();
                    $data = mysql_query("update users set last_failed_login='$curr',incorrect_login='$fcount' where email='$login'") or die(mysql_error());
                    //header('Location: ./login/login.php');
                       echo "<script>".
                               "window.location.href = './login/login.php';"
                          ."</script>";
                }
            }
            else {
                //  header('Location: ./login/login.php');
                  echo "<script>".
                    "window.location.href = './login/login.php';"
                     ."</script>";

            }
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
