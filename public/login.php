<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php
//Check whether admin already logged in or not
if(logged_in()){
    if($_SESSION["privileges"]==='admin' || $_COOKIE['privileges']==='admin'){
        redirect_to("admin.php");
    }
    elseif($_SESSION["privileges"]==='reception' || $_COOKIE['privileges']==='reception'){
        redirect_to("reception.php");
    }
     elseif($_SESSION["privileges"]==='lab' || $_COOKIE['privileges']==='lab'){
        redirect_to("lab_manager.php");
    }
    else{}
    
}
$username = "";

if (isset($_POST['submit'])) {
  // Process the form
  
  // validations
  $required_fields = array("username", "password");
  validate_presences($required_fields);
  
  if (empty($errors)) {
    // Attempt Login

		$username = $_POST["username"];
		$password = $_POST["password"];
		
		$found_admin = attempt_login($username, $password);

    if ($found_admin) {
      // Success
			// Mark user as logged in and giving relevant access
        	$_SESSION["admin_id"] = $found_admin["id"];
			$_SESSION["username"] = $found_admin["username"];
            $_SESSION["privileges"] = $found_admin["privileges"];
            if(isset($_POST["chk"])){
                setcookie("admin_id",$found_admin["id"],time()+60*30);
                setcookie("username",$found_admin["username"],time()+60*30);
                setcookie("privileges",$found_admin["privileges"],time()+60*30);
            }
            if($found_admin["privileges"]==='admin'){
                redirect_to("admin.php");
            }
            elseif($found_admin["privileges"]==='reception'){
                redirect_to("reception.php");
            }
           else{
               redirect_to("lab_manager.php");
           }
    } else {
      // Failure
      $_SESSION["message"] = "Username/password not found.";
    }
  }
} else {
  // This is probably a GET request
  
} // end: if (isset($_POST['submit']))

?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <title>NTRC Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <script src="../public/js/jquery.slim.min.js" type="text/javascript"></script>
         <link href="../public/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
         <link href="../public/css/styles.css" rel="stylesheet" type="text/css"/>
        
     
    </head>
    <body>
        <header>
            <h1>LIMS</h1>
            <nav>
              <a href="home.php">Home</a>
              <a href="Login.php" class="selected">Login</a>
              <a href="faq.php#barchart">Help</a>
            </nav>
        </header>
    <div id="main" style="padding-top:50px;min-height:78vh;">
    <br>
<!--        This function exists in session.php-->
        <?php echo message(); ?>
<!--        This function exists in fuctions.php-->
        <?php echo form_errors($errors); ?>
<!--        In case of redirecting from logout page, function exists in fuctions.php-->
         <?php echo get_success(); ?>
    <div class="login-block">
        <form action="login.php" method="post">
    <h1>Login</h1>
    <input type="text" value="<?php echo htmlentities($username); ?>" placeholder="Username" name="username" id="username" required/>
    <input type="password" value="" placeholder="Password" id="password" name="password" required/>

    <p>
    <input type="checkbox" checked="checked" name="chk" id="checkbox"><label for="checkbox">Remember me</label> 
    </p>
            
    <button type="submit" name="submit">Login</button>
<!--
    <p><a href="forgot_password.php">Forgot Password?</a></p>
    <p>Not an account? <a href="Register.php">Register</a></p>
-->
    </form>
</div>
    
    <br>
    <br>
    
</div>
    <footer id="footer">
        <p style="text-align:center;"> &copy; <?php echo date("Y"); ?> <a href="login.php">Labs Information Management System</a>, All Rights Reserved.</p>
    </footer><!--/#footer-->
    </body>
</html>
<?php
  // 5. Close database connection
	if (isset($connection)) {
	  mysqli_close($connection);
	}
?>
