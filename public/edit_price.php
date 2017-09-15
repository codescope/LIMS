<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php
if(isset($_GET["id"])){
  $test = find_test_by_id($_GET["id"]);
if (!$test) {
    // test ID was missing or invalid or 
    // test couldn't be found in database
    redirect_to("manage_test_prices.php");
  }
}
else{
    redirect_to("manage_test_prices.php");
}
?>
<?php
if (isset($_POST['submit'])) {
  // Process the form
  
  // validations
  $required_fields = array("nature_of_test", "price");
  validate_presences($required_fields);
  
  $fields_with_max_lengths = array("nature_of_test" => 80,"price" => 8);
  validate_max_lengths($fields_with_max_lengths);
  
  if (empty($errors)) {
    
    // Perform Update

    $id = $test["id"];
    $nature_of_test = mysql_prep($_POST["nature_of_test"]);
    $price = mysql_prep($_POST["price"]);
  
    $query  = "UPDATE testing_charges SET ";
    $query .= "price = '{$price}' ";
    $query .= "WHERE id = {$id} ";
    $query .= "LIMIT 1";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_affected_rows($connection) == 1) {
      // Success
      $_SESSION["message"] = "Price of (" .  $nature_of_test . ") updated.";
      redirect_to("manage_test_prices.php");
    } else {
      // Failure
      $_SESSION["message"] = "Price update failed.";
    }
  
  }
} else {
  // This is probably a GET request
  
} // end: if (isset($_POST['submit']))

?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <title>test Panel</title>
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
           <li><a href="test.php">&raquo; Main Page</a></li>
           <br />
            <li><a href="manage_test_prices.php">Manage Users</a></li>   
           </ul>
       </div>
        <div id="content">
    
    
    <?php echo message(); ?>
    <?php echo form_errors($errors); ?>
            
    <h2 style="font-family:cursive,fantasy,sans-serif;margin-bottom:35px;">Edit Test: <?php echo htmlentities($test["nature_of_test"]); ?></h2>        
            
    <form action="edit_price.php?id=<?php echo urlencode($test["id"]); ?>" method="post">
      <p>Nature of Test:
        <input style="width:250px" type="text" name="nature_of_test" value="<?php echo htmlentities($test["nature_of_test"]); ?>" readonly/>
      </p>
      <p>Price of Test:&nbsp;&nbsp;&nbsp;
        <input style="width:250px" type="text" name="price" value="<?php echo htmlentities($test["price"]); ?>" required/>
      </p>
      
      <input type="submit" name="submit" value="Update price" />
    </form>
    <br />
    <br />
    <a href="manage_test_prices.php">Cancel</a>
           
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
