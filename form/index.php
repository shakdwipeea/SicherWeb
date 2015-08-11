<?php
require '../StatusInfo.php';
session_start();
//print_r($_SESSION);
if(!isset($_SESSION["statusInfo"]))
{
echo("Invalid Access");
header("Location: ../login/login.php");
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
		<title>RV Key Generator</title>
		<link rel="stylesheet" type="text/css" href="css/default.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<script src="js/modernizr.custom.js"></script>
	</head>
	<body>
		<div class="container">
			<header class="clearfix">
				<h1>RV Key Generator</h1>
				<nav>
						<div id="dd" class="wrapper-dropdown-5 right" tabindex="1"> <span class="name"><?php echo $statusInfo->cname ?></span>
						<ul class="dropdown">
							<li><a href="addSoftware.php">Add Software</a></li>
							<li><a href="removeSoftware.php">Delete Software</a></li>
							<li><a href="keyList.php">List Keys</a></li>
							<li><a href = 'stats.php'>Statistics</a></li>
							<li><a href="logout.php">Log out</a></li>
						</ul>
					</div>

				</nav>
			</header>

			<div class="main">
				<form class="cbp-mc-form" method="post" action="register.php">
					<div class="cbp-mc-column">
						<label for="first_name">Name</label>
	  					<input type="text" id="name" name="name" placeholder="Name">
						<label for="email">Email</label>
	  					<input type="text" id="email" name="email" placeholder="Email Address">
                        <label for="count">No of trial</label>
                        <input type="number" id="count" name="count" >
	  				</div>
	  				<div class="cbp-mc-column">
	  				<label for="software">Select the Software</label>
	  					<select id="software" name="software"><?php

	  						foreach($statusInfo->softwares as $key=>$val)
	  							echo "<option value='$key'>$val</option>";

	  					?>
	  						<!-- <option value="PunchCard">PunchCard</option> -->
	  					</select>
	  					<label for="keys">Select No of Keys</label>
	  					<select id="keys" name="keys">
	  						<option value="1">1</option>
	  						<option value="2">2</option>
	  						<option value="3">3</option>
	  						<option value="4">4</option>
	  						<option value="5">5</option>
	  					</select>

	  					<label for = 'version'>Select version</label>
	  					<select id = 'version' name = 'version'>
	  						<option value = '0'>Trial</option>
	  						<option value = '1'>Full(Paid)</option>
	  					</select>

	  				</div>
	  				<div class="cbp-mc-submit-wrap"><input class="cbp-mc-submit" type="submit" name="submit" id="submit" value="Submit" /></div>

				</form>
			</div>
		</div>
		 <script src="js/jquery.js"></script>
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
