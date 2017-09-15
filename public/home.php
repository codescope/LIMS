<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <title>NTRC Home</title>
    <style>
        body{
             background:white;
        }
         header{
          padding-top: 50px;
          position: relative;
          margin-bottom: 70px;

        }
         header h1{

            font-family:fantasy,Arial,Helvetica,sans-serif;
            position:fixed;
            top:3px;
            margin-left: 40px;
            padding: 10px;
            z-index: 3;
            font-size: 50px;
        }
        nav {
          text-align: center;
          background: #f5f5f0;
          position: fixed;
          padding: 18px;
          top: 0;
          width: 100%;
          z-index: 2;    
        }
        nav a {
          display: inline-block;
          color: #cc0000;
          padding: 15px 20px;
          text-decoration: none;
          text-transform: uppercase;
          font-weight: 700;
        }
        nav a:hover{
           color:#2e2e2e;

        }
        .about h3{
            text-align: center;
            color: #cc0000;
            padding: 5px 0;
        }
        .about p{
            text-align: justify;
            padding: 15px;
            background-color:beige;
        }
        .about ol{
            background-color: beige;
            padding-left: 25px;  
            padding-top: 10px;
            padding-right: 10px;
            padding-bottom: 10px;
        }
        
     #featured .carousel-item img{
            width: 100%;
            height: 70vh;
            border-radius:25px;
        }
        .carousel-caption h3{
            color: cornsilk;
        }
        .carousel-caption p{
            color: cornsilk;
        }
        .selected{
            color:black;
        }
        #footer {
          border-radius: 100px 100px 0 0;
/*
          height: 10vh;    
          padding-top: 30px;  
*/        padding:20px 10px 10px;
       
          color: #fff;
          background: #2e2e2e;
          text-align: center;    
        }
        .selected{
            color:black;
        }

        #footer a {
          color: #fff;
        }

        #footer a:hover {
          color: #c52d2f;

        }
    </style>
</head>
<body>
        <header>
            <h1>LIMS</h1>
            <nav>
              <a href="home.php" class="selected">Home</a>
              <a href="Login.php">Login</a>
              <a href="faq.php#barchart">Help</a>
            </nav>
        </header>
<div class="container">
      
  <div class="row">
    <section class="col-12">

<div class="content container">
  <div class="row">
    <section class="col-sm-12">

<div class="carousel slide" id="featured" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#featured" data-slide-to="0" class="active">
        <li data-target="#featured" data-slide-to="1">
        <li data-target="#featured" data-slide-to="2">
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block img-fluid" src="images/textile_testing1.jpg" alt="Lifestyle Photo">
        </div>
         <div class="carousel-item">
            <img class="d-block img-fluid" src="images/textile_testing2.jpg" alt="Mission">
            <div class="carousel-caption d-none d-md-block">
             <h3>Mechanical Lab</h3>
             <p>A number of tests are perfomed at ISO lab. It contains many modern instruments for textile testing</p>    
            </div> 
        </div>    
        <div class="carousel-item">
             <img class="d-block img-fluid" src="images/tensile_testing4.jpg" alt="Vaccinations">
        </div>
   </div> <!--class="carousel-inner"-->
    <a class="carousel-control-prev" href="#featured" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true">
            <span class="sr-only">Previous</span>
        </span>
    </a>
     <a class="carousel-control-next" href="#featured" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true">
            <span class="sr-only">Next</span>
        </span>
    </a>
</div>    <!--class="carousel"-->

    </section>
  </div><!-- row -->
</div><!-- content container -->

    </section>
      
      </div><!-- row -->
    <div class="row about mt-4">
      <div class="col">
           <h3>Our Objectives</h3>
           <ol>
                <li>Achieving Excellence in Education
                   <ul>
                       <li>Increasing number of PhD faculty.</li>
                       <li>Improving its Infra-structure for world-class practical facilities in the field of textile and ready-made clothing technology.</li>
                       <li>Establishing international collaboration in teaching and education.</li>

                   </ul>
               </li>
                <li>Achieving Excellence in Fibres and Textile Research 
                    <ul>
                        <li>Improving its infra-structure for conducting fundamental and advanced level research.</li>
                        <li>Increasing research facilities for MS and PhD programs</li>
                        <li>Increasing the research output program in terms of publications/citations.</li>

                    </ul>
               </li>
                <li>Developing Collaborations with Research Institutions and Textile Industry
                    <ul>
                        <li>Developing relations with top researchers of various textile intuitions for collaboration in highly advanced level researches.</li>
                        <li> Developing relations with industry to transfer research results into practical applications.</li>
                        <li>Extending world class testing facilities to textile industry.</li>
                    
                    </ul>
               </li>
          </ol>
        </div>
    </div><!-- row -->
  
    <div class="row about mb-5">
      <div class="col-6 mt-4">
            <h3>Our Mission</h3>
            <p>The mission of the Department of Fibre Technology is to contribute towards the improvement of the textile industry of Pakistan by producing technically trained post-graduates in the field of fibre sciences &amp; technology, and to provide textile testing facilities to the government/private sector. We want to set up an institute of knitting technology to cover-up the deficiency of technical personnel in this fast growing dynamic textile sub-sector</p>
        
      </div>
      <div class="col-6 mt-4" >
            <h3>Our Vision</h3>
            <p>The industrial developments are so much advanced &amp; sophisticated that conventional knowledge is now left far behind to catch the pace of the future challenges. Hence there is a dire need to upgrade and escalate our academics to the level of Ph.D. degree programme in the field of fibre science &amp; textile technology, to meet the demand for research &amp; development set-up in the fast growing textile sector of Pakistan.</p>
        
      </div>
    
    </div>
    </div><!-- container -->
</div><!-- content container -->
   <footer id="footer">
       <div class="container">
            <p style="text-align:center;"> &copy; <?php echo date("Y"); ?> <a href="login.php">Labs Information Management System</a>, All Rights Reserved.</p>
       </div>       
    </footer><!--/#footer-->
<script src="js/jquery.slim.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/scripts.js"></script>
</body>
</html>
