<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/styles.css">  
  <title>Busting Properties Testing Form</title>
    <style>
        .pow{
        position:absolute; 
        top:-20px; 
        left: 15px;    
        font-size:50%;
        font-weight: bold;    
        }
        .sec_pow{
        position:absolute; 
        top:-23px;  
        left: 22px;    
        font-size:50%;
        font-weight: bold;     
        }
    </style>
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

<h2 class="text-md-center mb-3">Busting Properties Testing Form</h2>

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
        <option value="ISO 13934-1" data-foo="NOTE: Speciman Size (200mm x 50 mm), Rate of Extension (20mm/min), Pretension (2N), Condtion:" >ISO 13938-1, 1999
        </option>
        <option value="ASTM D5034" data-foo= "NOTE: Specimen was tested as directed in test method ASTM D5034, Tested on LLOYD LRxPlus CRE type machine, Gage Length=75mm, Max. Obtainable force= 5KN, Jaw faces 25mmx100mm, Pneumatic Jaws with Rubber Gisps, Condtion: ">ASTM D3786</option>
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
                  <label class="form-control-label" for="mean_busting_strength">Mean Busting Strength</label>
                <div class="input-group">
                    <input class="form-control" type="text" id="mean_busting_strength" placeholder="Enter Mean Busting Strength">
                    <span class="input-group-addon">
                    <select id="mean_strength_unit">
                        <option selected>KiloPascals</option>
                    </select>
                    </span> 
                </div><!-- input-group -->    
            </div><!-- form-group -->
            <div class="form-group col-md-4">
              <label class="form-control-label" for="first_cv">C.V.</label>
              <input class="form-control" type="text" id="first_cv" placeholder="Enter C.V.">
            </div>
        </div>
        
        <div class="form-group row mb-0">
            <div class="form-group col-md-6">
                  <label class="form-control-label" for="mean_height">Mean Burst Height</label>
                <div class="input-group">
                  <input class="form-control" type="text" id="mean_height" placeholder="Enter Mean Height">
                  <span class="input-group-addon">
                    <select id="mean_strength_unit">
                        <option selected>mm</option>
                    </select>
                  </span> 
                </div><!-- input-group -->        
            </div><!-- form-group -->
            <div class="form-group col-md-4">
              <label class="form-control-label" for="second_cv">C.V.</label>
              <input class="form-control" type="text" id="second_cv" placeholder="Enter C.V.">
            </div>
        </div>
        
         <div class="form-group row mb-0">
            <div class="form-group col-md-6">
                  <label class="form-control-label" for="test_area">Test Area</label>
                <div class="input-group">
                    <input class="form-control" type="text" id="test_area" placeholder="Enter Test area">
                    <span class="input-group-addon">cm<span style="position: relative" class="pow">2</span></span> 
                </div><!-- input-group -->  
            </div><!-- form-group -->
            <div class="form-group col-md-4">
              <label class="form-control-label" for="third_cv">C.V.</label>
              <input class="form-control" type="text" id="third_cv" placeholder="Enter C.V.">
            </div>
        </div>
        
        <div class="form-group row mb-0">
            <div class="form-group col-md-6">
                  <label class="form-control-label" for="volume_increase_rate">Volume Increase Rate</label>
                <div class="input-group">
                  <input class="form-control" type="text" id="volume_increase_rate" placeholder="Enter Volume Increase Rate">
                    <span class="input-group-addon">kg/cm<span style="position: relative" class="sec_pow">3</span></span> 
                </div><!-- input-group -->  
            </div><!-- form-group -->
            <div class="form-group col-md-4">
              <label class="form-control-label" for="fourth_cv">C.V.</label>
              <input class="form-control" type="text" id="fourth_cv" placeholder="Enter C.V.">
            </div>
        </div>
        
         <div class="form-group row mb-0">
            <div class="form-group col-md-6">
                  <label class="form-control-label" for="time_to_burst">Time to Burst</label>
                <div class="input-group">
                  <input class="form-control" type="text" id="time_to_burst" placeholder="Enter Time to Burst">
                    <span class="input-group-addon">sec</span> 
                </div><!-- input-group -->  
            </div><!-- form-group -->
            <div class="form-group col-md-4">
              <label class="form-control-label" for="fourth_cv">C.V.</label>
              <input class="form-control" type="text" id="fourth_cv" placeholder="Enter C.V.">
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