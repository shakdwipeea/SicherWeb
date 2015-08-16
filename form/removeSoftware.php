<?php
require '../StatusInfo.php';
session_start();
if (!isset($_SESSION['statusInfo'])) {
  echo("Invalid access");
}
else
  $statusInfo = $_SESSION['statusInfo'];
 ?>
 <!DOCTYPE html>
 <html lang="en" class="no-js">
 	<head>
 		<title>Remove Software</title>
 		<link rel="shortcut icon" href="../favicon.ico">
 		<link rel="stylesheet" type="text/css" href="css/default.css" />
 		<link rel="stylesheet" type="text/css" href="css/component.css" />
 		<link rel="stylesheet" type="text/css" href="css/style.css" />
 		<script src="js/modernizr.custom.js"></script>
 	</head>
  <body>
    <div class="container">
      <header class="clearfix">
        <h1>Remove Software</h1>
        <nav>
					<div id="dd" class="wrapper-dropdown-5 right" tabindex="1"> <span class="name"><?php echo $statusInfo->cname ?></span>
						<ul class="dropdown">
							<li><a href="index.php">Home</a></li>
							<li><a href="logout.php">Log out</a></li>
						</ul>
					</div>
				</nav>
			</header>
      <div class="pos">
        <form action="delete.php" method="post">
       <?php
       //echo var_dump($statusInfo->softwares);
       foreach ($statusInfo->softwares as $key => $value)
            echo "<input type='checkbox' name='software[]' value='$value'>$value<br><br><br>";
            ?>
            <!-- <div class="cbp-mc-submit-wrap"><input class="cbp-mc-submit" type="submit" name="submit" id="submit" value="Delete" /></div> -->
            <input class="cbp-mc-submit" type="submit" name="submit" id="submit" value="Delete">


          </form>
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
