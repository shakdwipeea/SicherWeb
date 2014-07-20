<?php
/**
 * Created by PhpStorm.
 * User: Akash
 * Date: 19/7/14
 * Time: 3:54 PM
 */

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
    $con = mysql_connect("localhost","akash","shakdwipeea");
    mysql_select_db("security") or die("Invalid DB");
}
?>
<html lang="en">
<head>
    <title>Statistics</title>
    <link rel="stylesheet" type="text/css" href="css/default.css" />
    <link rel="stylesheet" type="text/css" href="css/component.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/stats.css" />




</head>
<body>

<div id="container">
    <h1>Statistics</h1>
    <button id='print' onclick='printDiv()'>Print</button>
    <div id = 'details'>

    </div>
    <div id = 'graph'>
        <h2>Select a software to view statistics .</h2>
    </div>
    <div id = 'controls'></div>
    <div id = 'direct'>
    <button>Home</button>
    <button>Overview</button>

    </div>
</div>



<img id = 'menu' src = 'http://aicchile.com/wp-content/themes/caic/assets/img/icon-menu.png' ></img>
<div class = 'drop'>
    <div class = 'gb_7'></div>
    <div class = 'gb_8'>


                <!--<select name = "softwares" onchange="showUser(this.value)" >
                    <option value = "">Select a software: </option> -->
                    <?php

                    foreach($statusInfo->softwares as $key=>$val)
                        echo "<button class='softs'>$val</button>";
                    ?>

                <!--</select> -->



    </div>
</div>

<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src = './js/jqBarGraph.1.1.min.js'></script>
<script src = "./js/statsp.js"></script>

<script>
    var sf = "";
    function showUser(str) {
        if(str == "") {
            $('#details').text("No software selected");
            return;
        }

        if(window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        }

        xmlhttp.onreadystatechange = function () {
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                $('#details').html(xmlhttp.responseText);
                $('#details').slideDown();
                console.log("Here: " + xmlhttp.responseText);
            }
        }

        xmlhttp.open("GET","./getData.php?q=" + str + "&display=1",true);
        xmlhttp.send();
    }

       $('.softs').on('click', function (){
          showUser(this.innerHTML);
          // console.log(this.innerHTML);
           sf = this.innerHTML;
       });




    function printDiv() {
      window.location.href='print.php?q=' + sf + '&display=0';
    }
</script>
</body>
</html>