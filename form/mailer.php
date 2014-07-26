
<?php

require('../StatusInfo.php');
require('../PHPMailer/class.phpmailer.php');

session_start();
if(!isset($_SESSION['statusInfo'])) {
echo "Invalid access";
exit(1);
}

$status = $_SESSION['statusInfo'];
//print_r($_SESSION);
$Uname = $status->UName;
$Uemail = $status->UEmail;
$software = $status->software;

//echo $Uemail;
//echo $Uname;

$mail = new PHPMailer();
$mail->PluginDir = '../PHPMailer/'; // relative path to the folder where PHPMailer's files are located
$mail->IsSMTP();
$mail->Port = 465;
$mail->Host = 'smtp.mandrillapp.com'; // "ssl://smtp.gmail.com" didn't worked
$mail->IsHTML(true); // if you are going to send HTML formatted emails
$mail->Mailer = 'smtp';
$mail->SMTPSecure = 'ssl';

$mail->SMTPAuth = true;
$mail->Username = "ashakdwipeea@gmail.com";
$mail->Password = "Dfhacm-zBJ6Jo4vcuFxzhA";

$mail->SingleTo = true; // if you want to send mail to the users individually so that no recipients can see that who has got the same email.

$mail->From = "ashakdwipeea@gmail.com";
$mail->FromName = "Akash";

//$mail->addAddress("+919980770077@msg.iridium.com","9980770077");
$mail->addAddress($Uemail,$Uname);

//$mail->addCC("user.3@ymail.com","User 3");
//$mail->addBCC("user.4@in.com","User 4");

$msg= "Registration successful.<br>Your registered keys are as below<br>";
$keys = $status->getKeys();
//print_r($keys);

$kn = count($keys);
for($i=0;$i<$kn;$i++)
{
$n = $i+1;
$msg = $msg."Key($n) : $keys[$i]<br>";
}

//echo $msg;

$mail->Subject = $status->software." Registration";
$mail->Body = $msg;
if(!$mail->Send()){
echo  "<script>Message was not sent <br />PHP Mailer Error: " . $mail->ErrorInfo . "</script>";
}
else{
echo "<script>alert('User registered. Keys sent to your email');</script>";

    $con = mysql_connect("localhost","akash","shakdwipeea") or die(" Mysql Connection Error");

    mysql_select_db("security") or die("Invalid DB");

    $query = "select email from softwarelist where sname= '$software' limit 1";
//echo($query);
    $res = mysql_query($query) or die(mysql_error());

    $info = mysql_fetch_array($res);

    if($info) {
        $em = $info['email'];

        $mail->addAddress($em,$em);
        $mail->Subject = $status->software." Registration";
        $mail->Body = "Your software ".$status->software." has been registered by ".$Uemail." .Thank you";

        $mail->Send();

    }






echo "<script>window.location.href='index.php'</script>";
}



?>