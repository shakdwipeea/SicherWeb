<?php
require '../StatusInfo.php';
session_start();
//print_r($_SESSION);
if(!isset($_SESSION["statusInfo"]))
{
echo("Invalid Access");
exit(1);
}
else
	$statusInfo = $_SESSION["statusInfo"];
//	print_r($statusInfo->softwares);

/*
function logOut()
{
unset($_SESSION);
$_SESSION["statusInfo"] = "";
session_destroy();
header('Location: ../login/login.php');
}
*/

?>
<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<title>Add Software</title>
		<link rel="shortcut icon" href="../favicon.ico">
		<link rel="stylesheet" type="text/css" href="css/default.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<script src="js/modernizr.custom.js"></script>
	</head>
	<body>
		<div class="container">
			<header class="clearfix">
				<h1>Add Software</h1>
				<nav>
					<div id="dd" class="wrapper-dropdown-5 right" tabindex="1"> <span class="name"><?php echo $statusInfo->cname ?></span>
						<ul class="dropdown">
							<li><a href="index.php">Home</a></li>
							<li><a href="logout.php">Log out</a></li>
						</ul>
					</div>
					
				</nav>					
			</header>

			<div class="main">
				<form class="cbp-mc-form" method="post" action="addSoft.php">
					<div class="cbp-mc-column">
						<label for="first_name">Software Name</label>
	  					<input type="text" id="name" name="name" placeholder="Software Name">
	  				</div>
	  				<div class="cbp-mc-submit-wrap"><input class="cbp-mc-submit" type="submit" name="submit" id="submit" value="Submit" /></div>
	  				
				</form>
			</div>
		</div>
		 <script src="http://code.jquery.com/jquery-latest.js"></script>
		<script type="text/javascript">

			function DropDown(el) {
				this.dd = el;
				this.initEvents();
			}
			DropDown.prototype = {
				initEvents : function() {
					var obj = this;

					obj.dd.on('click', function(event){
						$(this).toggleClass('active');
						event.stopPropagation();
					});	
				}
			}

			$(function() {

				var dd = new DropDown( $('#dd') );

				$(document).click(function() {
					// all dropdowns
					$('.wrapper-dropdown-5').removeClass('active');
				});

			});

		</script>
	</body>
</html>
