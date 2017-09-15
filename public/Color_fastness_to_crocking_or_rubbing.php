<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/styles.css">  
  <title>Color fastness to Crocking/Rubbing Testing Form</title>
</head>
<body>

<nav class="navbar navbar-inverse bg-primary navbar-toggleable-sm">
  <div class="container">
    <h1 class="navbar-brand mb-0">National Textile Research Center</h1>
    <div class="navbar-nav mr-auto">
      <a class="nav-item nav-link active" href="#">Home</a>
      <a class="nav-item nav-link" href="#">Mission</a>
      <a class="nav-item nav-link" href="#">Labs</a>
      <a class="nav-item nav-link" href="#">Staff</a>
      <a class="nav-item nav-link" href="#">Testimonials</a>
    </div><!-- navbar-nav -->
    <form class="form-inline">
        <input class="form-control" type="search" placeholder="Search">
        <button class="btn btn-info" type="button">Go</button>
    </form>

  </div><!-- container -->
</nav>

<div class="container mt-4">

<h2 class="text-md-center mb-3">Color fastness to Crocking/Rubbing Testing Form</h2>

<form>

  <fieldset class="form-group mb-0">
    <legend>Sample Information</legend>
    <div class="form-group row mb-0">
        <div class="form-group col-6">
              <label class="form-control-label sr-only" for="id">Sample ID</label>
              <input class="form-control" type="text" id="id" placeholder="Enter Sample ID">
        </div><!-- form-group -->
        <div class="form-group col-6">
          <label class="form-control-label sr-only" for="sample_type">Sample Type</label>
          <input class="form-control" type="text" id="sample_type" placeholder="Enter Sample Type">
        </div>
    </div>
    <!--<div class="form-group row mb-0">
        <div class="form-group col-6">
            <label class="form-control-label" for="date_received">Date Received</label>
            <input class="form-control" type="date" id="date_received">
        </div>
        <div class="form-group col-6">
            <label class="form-control-label" for="date_delievered">Date Delievered</label>
            <input class="form-control" type="date" id="date_delievered">
        </div>
    </div>     --> 

      
    <div class="form-group">
      <label class="form-control-label sr-only" for="sample_description">Sample Description</label>
      <textarea class="form-control" rows="3" id="sample_description" placeholder="Enter Sample Description"></textarea>
    </div>   
      
   <!-- <div class="form-group row mb-0"> 
        <div class="form-group col-6">
          <label class="form-control-label" for="client">Client</label>
          <input class="form-control" type="text" id="client" placeholder="Enter Client">  
        </div>  

        <div class="form-group col-6">  
           <label class="form-control-label" for="client_ref">Client Ref.</label>
           <input class="form-control" type="text" id="client_ref" placeholder="Enter Client Reference"> 
        </div>    
    </div> form-group -->
    </fieldset><!-- fieldset -->
    
    <fieldset class="form-group mb-0">
        <legend>Test Parameters</legend>
        
        <div class="form-group">
        <label class="form-control-label" for="test_standard">Test Standard</label>   
        <select class="form-control" id="test_standard">
        <option disabled selected>Choose standard...</option>    
        <option value="ISO 13934-1" data-foo="NOTE: Speciman Size (200mm x 50 mm), Rate of Extension (20mm/min), Pretension (2N), Condtion:" >ISO 10512 2002</option>
        <option value="ISO 13934-2" data-foo= "NOTE: Speciman Size (100mm x 100 mm), Rate of Extension (50mm/min), Condtion: ">AATCC 08 2016</option>
    
        </select>
        </div>
        
        <label>Test Conditions</label>
        <div class="form-group row mb-0">
            <div class="form-group col-6">
                  <label class="form-control-label sr-only" for="temperature">Temperature</label>
                <div class="input-group">
                  <input class="form-control" type="text" id="temperature" placeholder="Enter temperature">
                <span class="input-group-addon">&deg;C</span>    
                </div><!-- input-group -->
            </div><!-- form-group -->
            <div class="form-group col-6">
              <label class="form-control-label sr-only" for="humidity">Humidity</label>
             <div class="input-group">    
                 <input class="form-control" type="text" id="humidity" placeholder="Enter humidity">
                 <span class="input-group-addon">&#37;</span>  
            </div>
            </div>
        </div>
    </fieldset>   
    
    <fieldset class="form-group mb-0">
        <legend>Test outcomes</legend>
        <div class="form-group row mb-0">
            <div class="form-group col-md-6">
                  <label class="form-control-label" for="dry">Dry</label>
                   
                    <select class="form-control" id="dry">
                        <option selected disabled>--G.S. Rating--</option>
                        <option>1</option>
                        <option>1-2</option>
                        <option>2</option>
                        <option>2-3</option>
                        <option>3</option>
                         <option>3-4</option>
                        <option>4</option>
                        <option>4-5</option>
                        <option>5</option>
                    </select> 
            </div><!-- form-group -->
            <div class="form-group col-md-4">
              <label class="form-control-label" for="first_cv">C.V.</label>
              <input class="form-control" type="text" id="first_cv" placeholder="Enter C.V.">
            </div>
        </div>
        
        <div class="form-group row mb-0">
            <div class="form-group col-md-6">
                <label class="form-control-label" for="wet">Wet</label>
                   
                    <select class="form-control" id="wet">
                        <option selected disabled>--G.S. Rating--</option>
                        <option>1</option>
                        <option>1-2</option>
                        <option>2</option>
                        <option>2-3</option>
                        <option>3</option>
                         <option>3-4</option>
                        <option>4</option>
                        <option>4-5</option>
                        <option>5</option>
                    </select> 
            </div><!-- form-group -->
            <div class="form-group col-md-4">
              <label class="form-control-label" for="second_cv">C.V.</label>
              <input class="form-control" type="text" id="second_cv" placeholder="Enter C.V.">
            </div>
        </div>
        
        
    </fieldset>    
    
    <div class="row">
        <div class="col-1 offset-md-11">
         <button class="btn btn-primary" type="submit">Submit</button>
        </div>
    </div>
         
   
</form>


</div><!-- content container -->
 <footer id="footer">
        <div class="container">
            
            <div class="row">
                <div class="col-sm-6">
                    &copy; 2016 <a>Admission System</a>. All Rights Reserved.
                </div>
                <div class="col-sm-4 offset-sm-2">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Faq</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>  
            </div>
        </div>
    </footer><!--footer-->    

<script src="js/jquery.slim.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/scripts.js"></script>
</body>
</html>
