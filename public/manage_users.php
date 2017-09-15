<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php
  $admin_set = find_all_admins();
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
          table {font-size: 1.1em;}
          table tr th{
                padding-bottom: 10px;
            }
            table tr td{
                padding-bottom: 5px;
            }
            #content a{
               color: #8D0D19;  
               margin-right: 10px;    
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
                <li><a href="manage_users.php" class="active">Manage Users</a></li>
                <br /> 
                <li><a href="manage_test_prices.php">Price Catalog</a></li>   
           </ul>
              
       </div>
        <div id="content">
            <?php echo message(); ?>
    <h2 style="font-family:cursive,fantasy,sans-serif;margin-bottom:35px;">Manage Users</h2>
    <table style="margin:30px 0;">
      <tr>
        <th style="text-align: left; width: 200px;">Username</th>
        <th style="text-align: left; width: 200px;">Password</th>
        <th style="text-align: left; width: 200px;">Privileges</th>
        <th colspan="2" style="text-align: left;">Actions</th>
      </tr>
    <?php while($admin = mysqli_fetch_assoc($admin_set)) { ?>
      <tr>
        <td><?php echo htmlentities($admin["username"]); ?></td>
        <td><?php echo htmlentities($admin["password"]); ?></td>
        <td><?php echo htmlentities($admin["privileges"]); ?></td>
        <td><a href="edit_user.php?id=<?php echo urlencode($admin["id"]); ?>">Edit</a></td>
        <td><a href="delete_user.php?id=<?php echo urlencode($admin["id"]); ?>" onclick="return confirm('Are you sure?');">Delete</a></td>
      </tr>
    <?php } ?>
    </table>
    <br />
    <a href="new_user.php">Add new User</a>
      <br /> 
    <?php        
        $root_admin = find_root_admin();
        /* there is no need to verify whether root admin is set or not, we know it already exists  */
    ?>        
    <a href="change_password.php?id=<?php echo urlencode($root_admin["id"]); ?>">Change admin Password</a>        
           
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
