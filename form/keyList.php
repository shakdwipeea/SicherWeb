<?php

require '../StatusInfo.php';
session_start();
if(!isset($_SESSION["statusInfo"]))
{
echo("Invalid Access");
header("Location: ../login/login.php");
exit(1);
}
else{
	$statusInfo = $_SESSION["statusInfo"];
	$con = mysql_connect("127.0.0.1","root","");
	mysql_select_db("security") or die("Invalid DB");
	}	
?>
<html lang="en" class="no-js">
	<head>
		<title>Keystore</title>
		<link rel="stylesheet" type="text/css" href="css/default.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="stylesheet" type="text/css" href="DataTables/media/css/jquery.dataTables.css" />
		<script src="js/modernizr.custom.js"></script>
		<script src="js/jquery.js"></script>
		<script src="DataTables/media/js/jquery.dataTables.min.js"></script>		
	</head>
	<body>
		<div class="container">
			<header class="clearfix">
				<h1>Keystore</h1>
				<nav>
						<div id="dd" class="wrapper-dropdown-5 right" tabindex="1"> <span class="name"><?php echo $statusInfo->cname ?></span>
						<ul class="dropdown">
							<li><a href="../login/login.php">Home</a></li>
							<li><a href="logout.php">Log out</a></li>
						</ul>
					</div>
					
				</nav>					
			</header>

			<div class="main">
				<form class="cbp-mc-form" method="post" action="register.php">
	  				<div class="cbp-mc-column">
<?php
$res = mysql_query("Select * from SoftwareList;");

while($row = mysql_fetch_array($res))
{
$s = $row['sname'];
echo("<input type='radio' name='software' value=$s id=$s>$s</input>");
}
?>
	  				</div>
				</form>
				
			<br><br>
				
				
<table border="1" id="keyTable" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>User</th>
            <th>Key</th>
            <th>Bios</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>

			</div>
		</div>

</body>
<script type="text/javascript">

$(document).ready(function(){
     $('#keyTable').dataTable();
    
    $('input[type=radio]').click(function(){
       window.location.href = window.location.pathname+"?SW="+this.value;
    });
    
    var dd = new DropDown( $('#dd') );

				$(document).click(function() {
					// all dropdowns
					$('.wrapper-dropdown-5').removeClass('active');
				});

    
});

function displayKeys(soft,jsonData)
{
$('#'+soft).attr('checked', true);
/* console.log(JSON.stringify(jsonData)); */
for(var v in jsonData)
//console.log(jsonData[v]);
$('#keyTable').dataTable().fnAddData([jsonData[v].user,jsonData[v].actkey,jsonData[v].bios,jsonData[v].email]);
}

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

</script>

<?php	
	if(isset($_GET['SW']))
{
$sw = $_GET['SW'];
$res = mysql_query("Select * from $sw;") or die(mysql_error());
$kdata = array();
while($row = mysql_fetch_array($res))
array_push($kdata, $row);
$kdata = json_encode($kdata);
$sw = json_encode($sw);
echo("<script>
displayKeys($sw,$kdata);</script>");
}
else
	$kdata = null;	
?>
	
</html>
