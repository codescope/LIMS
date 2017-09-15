<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php
if(isset($_GET["id"])){
  $admin = find_admin_by_id($_GET["id"]);
if (!$admin) {
    // admin ID was missing or invalid or 
    // admin couldn't be found in database
    redirect_to("manage_users.php");
  }
}
else{
    redirect_to("manage_users.php");
}
?>
<?php
if (isset($_POST['submit'])) {
  // Process the form
  
  // validations
  $required_fields = array("username", "password");
  validate_presences($required_fields);
  
  $fields_with_max_lengths = array("username" => 30);
  validate_max_lengths($fields_with_max_lengths);
  
  if (empty($errors)) {
    
    // Perform Update

    $id = $admin["id"];
    $username = mysql_prep($_POST["username"]);
    $password = mysql_prep($_POST["password"]);
  
    $query  = "UPDATE lab_managers SET ";
    $query .= "username = '{$username}', ";
    $query .= "password = '{$password}' ";
    $query .= "WHERE id = {$id} ";
    $query .= "LIMIT 1";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_affected_rows($connection) == 1) {
      // Success
      $_SESSION["message"] = "User updated.";
      redirect_to("manage_users.php");
    } else {
      // Failure
      $_SESSION["message"] = "User update failed.";
    }
  
  }
} else {
  // This is probably a GET request
  
} // end: if (isset($_POST['submit']))

?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <title>Admin Panel</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <script src="../public/js/jquery.slim.min.js" type="text/javascript"></script>
         <link href="../public/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
         <link href="../public/css/styles.css" rel="stylesheet" type="text/css"/>
       <style>
           #content a{
                color: #8D0D19;
           }
           #content a:hover { color: #1A446C; }
        
        </style>
    </head>
    <body>
        <header>
            <h1>LIMS</h1>
            <nav style="padding-left:220px">
              <a href="home.php">Home</a>
              <a href="faq.php#barchart">Help</a>
              <a class="logoutbtn" href="logout.php" style="float:right;">log out</a>    
            </nav>
        </header>
    <div id="main">
       <div id="navigation">
           <ul>
           <li><a href="admin.php">&raquo; Main Page</a></li>
           <br />
            <li><a href="manage_users.php">Manage Users</a></li>   
           </ul>
       </div>
        <div id="content">
    
    
    <?php echo message(); ?>
    <?php echo form_errors($errors); ?>
            
    <h2 style="font-family:cursive,fantasy,sans-serif;margin-bottom:35px;">Edit User: <?php echo htmlentities($admin["username"]); ?></h2>        
            
    <form action="edit_user.php?id=<?php echo urlencode($admin["id"]); ?>" method="post">
      <p>Username:
        <input type="text" name="username" value="<?php echo htmlentities($admin["username"]); ?>" />
      </p>
      <p>Password:
        <input type="password" name="password" value="" required/>
      </p>
       <p>Privileges:
        <select name="privileges" required>
            <?php if($admin["privileges"]==='reception'){echo "selected";} ?>
              <option value="">Select Privilege</option>
              <option value="reception" <?php if($admin["privileges"]==='reception'){echo "selected";} ?> >Reception</option>
              <option value="lab" <?php if($admin["privileges"]==='lab'){echo "selected";} ?>>Lab</option>

        </select>
      </p>
      <input type="submit" name="submit" value="Update User" />
    </form>
    <br />
    <br />
    <a href="manage_users.php">Cancel</a>
           
    </div>
    
    </div>
        <footer id="footer" style="border-radius:0;">
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
