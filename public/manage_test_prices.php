<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php
  $price_set = find_all_test_prices();
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
               <li><a href="manage_users.php">Manage Users</a></li>
               <br />
               <li><a href="manage_test_prices.php" class="active">Price Catalog</a></li>   
           </ul>
       </div>
        <div id="content">
            <?php echo message(); ?>
    <h2 style="font-family:cursive,fantasy,sans-serif;margin-bottom:35px;">Manage Test Prices</h2>
    <table style="margin:30px 0;">
      <tr>
        <th style="text-align: left; width: 80px;">Sr#</th>
        <th style="text-align: left; width: 240px;">Nature of Test</th>
        <th style="text-align: left; width: 200px;">Sample Type</th>
        <th style="text-align: left; width: 300px;">Test methods</th>
        <th style="text-align: left; width: 150px;">Price &#40;Rs.&#41;</th>
        <th colspan="2" style="text-align: left;">Actions</th>
      </tr>
     <?php $count=1;?> 
    <?php while($test = mysqli_fetch_assoc($price_set)) { ?>
      <tr>
        <td><?php echo $count; ?></td>
        <td><?php echo htmlentities($test["nature_of_test"]); ?></td>
        <td><?php echo htmlentities($test["sample_type"]); ?></td>
        <td><?php echo htmlentities($test["test_method"]); ?></td>
        <td><?php echo htmlentities($test["price"]); ?></td>
        <td><a href="edit_price.php?id=<?php echo urlencode($test["id"]); ?>">Edit Price</a></td>
      </tr>
      
    <?php $count++; } ?>
    </table>
    <br />
         
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
