<?php
session_start();
unset($_SESSION['statusInfo']);
$_SESSION['statusInfo'] = "";
session_destroy();
header("Location: ../login/login.php");

?>
