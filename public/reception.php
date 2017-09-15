 <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>Admin Panel</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <script src="../public/js/jquery.slim.min.js" type="text/javascript"></script>
         <link href="../public/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
         <link href="../public/css/styles.css" rel="stylesheet" type="text/css"/>
    
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
           <li><a href="reception.php" class="active">Main Page</a></li>
           </ul>
       </div>
        <div id="content">
        <h2 style="text-align:center;font-family:cursive,fantasy,sans-serif;">Welcome, Receptionist!!</h2>
            <ul class="tasks">
              <li><a href="Commercial_Testing_Request_Form.php">Record Commercial Sample Data</a><li>
              <li><a href="Academic_Testing_Request_Form.php">Record Academic Sample Data</a><li>
              <li><a href="#">View Statistics</a><li>
              <li><a href="logout.php">Logout</a></li>
            </ul>    
        </div>
    
    </div>
        <footer id="footer" style="border-radius:0;">
            <p style="text-align:center;"> &copy; <?php echo date("Y"); ?> <a href="login.php">Labs Information Management System</a>, All Rights Reserved.</p>
        </footer><!--/#footer-->
     
    </body>
</html>

