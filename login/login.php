<html>
<head><title>RVCE</title>

<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Gafata|Nobile:400,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/login-akash.css">
<script type="text/javascript" src="js/login.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>




<body>
<nav id="navigation">
<ul>
<li><a  href="#">Home</a></li>
<li><a href="#">About</a></li>
<li><a href="../Products/index.html">Products</a></li>
<li><a href="#">Services</a></li>
</ul>
</nav>


 <div class="container1">
  <section id="content">
    <form method="post" action="../auth.php">
    <div id="wrapper">
      <div id="box">
          <div id="top_header">
              <h3>Login</h3>
              <h5>Sign in to continue to your control panel.</h5>
          </div>
        
        <div id="inputs">
          <form id='login' action='../auth.php' method='post' accept-charset='UTF-8' style="margin-left:6px;">
        
        <input type='hidden' name='submitted' id='submitted' value='1'/>

        <div class='container'>
          <input type='text' name='email' id='email' value='' maxlength="50" size="30" placeholder="Username"/><br/>
        </div>
        
        <div class='container'>
          <input type='password' name='password' id='password' maxlength="50" size="30" placeholder="Password" /><br/>
        </div>
        
        <div class='container'>
          <input type='submit' name='Submit' value='Login' />
        </div>

      </form>

          <div id="bottom">
            <a href="#">Create an account</a>
            <a class="right_a" href="#">Forgot password</a>
          </div>
        </div>
    
    </form><!-- form -->
    </div><!-- button -->
  </section><!-- content -->
</div><!-- container -->
<script src='http://codepen.io/assets/libs/fullpage/jquery.js'></script>
<script type="text/javascript" src='./js/ak.js'></script>
</body>
</html>