<?php
require 'php/session.php';

if(checkIfLoggedIn()) {
  header("Location: dashboard.php");
  exit;
}
?>

<html>
  <head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="css/login.css">
  </head>
  <main>
    <div class = "container">
    	<div class="wrapper">
    		<form action="login.php" id='login' method="post" name="Login_Form" accept-charset='UTF-8' class="form-signin">
    		    <h3 class="form-signin-heading">Admin panel JCloud Inc.</h3>
    			  <hr class="colorgraph"><br>

    			  <input type="text" class="form-control" name="username" placeholder="Username" required="" autofocus="" />
    			  <input type="password" class="form-control" name="password" placeholder="Password" required=""/>

    			  <button class="btn btn-lg btn-primary btn-block"  name="Submit" value="Login" type="Submit">Login</button>
    		</form>
    	</div>
    </div>
  </main>
</html>
