<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/test_styles.css">
  <title>Bursting Properties Testing Form</title>
    <style>
        .pow{
        position:absolute; 
        top:4px;
        left: 30px;
        font-size:0.6em;
        font-weight: bold;
        }
        .sec_pow{
        position:absolute; 
        top:4px;
        left: 52px;
        font-size:0.6em;
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

<h2 class="text-md-center mb-3">Bursting Properties Testing Form</h2>

<form action="Bursting_properties_of_fabrics.php" method="post">

  <fieldset class="form-group mb-0">
    <legend>Sample Information</legend>
    <div class="form-group row mb-0">
        <div class="form-group col-6">
              <label class="form-control-label sr-only" for="id">Sample ID</label>
              <input class="form-control" type="text" id="id" name="id" placeholder="Enter Sample ID" >
        </div><!-- form-group -->
        <div class="form-group col-6">
          <label class="form-control-label sr-only" for="sample_type">Sample Type</label>
          <input class="form-control" type="text" id="sample_type" name="sample_type" placeholder="Enter Sample Type">
        </div>
    </div>

    <div class="form-group">
      <label class="form-control-label sr-only" for="sample_description">Sample Description</label>
      <textarea class="form-control" rows="3" id="sample_description" name="sample_description" placeholder="Enter Sample Description"></textarea>
    </div>   

    </fieldset><!-- fieldset -->
    
    <fieldset class="form-group mb-0">
        <legend>Test Parameters</legend>
        
        <div class="form-group">
        <label class="form-control-label" for="test_standard">Test Standard</label>   
        <select class="form-control" id="test_standard" name="test_standard" required>
        <option selected value="">Choose standard...</option>
        <option value="ISO 13938-1, 1999" >ISO 13938-1, 1999
        </option>
        <option value="ASTM D3786" >ASTM D3786</option>
        </select>
        </div>
        
        <label>Test Conditions</label>
        <div class="form-group row mb-0">
            <div class="form-group col-6">
                  <label class="form-control-label sr-only" for="temperature">Temperature</label>
                <div class="input-group">
                  <input class="form-control" type="text" id="temperature" name="temperature" placeholder="Enter temperature" required>
                <span class="input-group-addon">&deg;C</span>    
                </div><!-- input-group -->
            </div><!-- form-group -->
            <div class="form-group col-6">
              <label class="form-control-label sr-only" for="humidity">Humidity</label>
             <div class="input-group">    
                 <input class="form-control" type="text" id="humidity" name="humidity" placeholder="Enter humidity" required>
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
                    <input class="form-control" type="text" id="mean_busting_strength" name="mean_busting_strength" placeholder="Enter Mean Busting Strength" required>
                    <span class="input-group-addon">
                    <select id="mean_strength_unit" name="mean_strength_unit" required>
                        <option selected>KiloPascals</option>
                    </select>
                    </span> 
                </div><!-- input-group -->    
            </div><!-- form-group -->
            <div class="form-group col-md-4">
              <label class="form-control-label" for="first_cv">C.V.</label>
              <input class="form-control" type="text" id="first_cv" name="first_cv" placeholder="Enter C.V.">
            </div>
        </div>
        
        <div class="form-group row mb-0">
            <div class="form-group col-md-6">
                  <label class="form-control-label" for="mean_height">Mean Burst Height</label>
                <div class="input-group">
                  <input class="form-control" type="text" id="mean_height" name="mean_height" placeholder="Enter Mean Height" required>
                  <span class="input-group-addon">
                    <select id="mean_strength_unit" name="mean_strength_unit" required>
                        <option selected>mm</option>
                    </select>
                  </span> 
                </div><!-- input-group -->        
            </div><!-- form-group -->
            <div class="form-group col-md-4">
              <label class="form-control-label" for="second_cv">C.V.</label>
              <input class="form-control" type="text" id="second_cv" name="second_cv" placeholder="Enter C.V.">
            </div>
        </div>
        
         <div class="form-group row mb-0">
            <div class="form-group col-md-6">
                  <label class="form-control-label" for="test_area">Test Area</label>
                <div class="input-group">
                    <input class="form-control" type="text" id="test_area" name="test_area" placeholder="Enter Test area" required>
                    <span style="position: relative;" class="input-group-addon">cm<span class="pow">2</span></span>
                </div><!-- input-group -->  
            </div><!-- form-group -->
            <div class="form-group col-md-4">
              <label class="form-control-label" for="third_cv">C.V.</label>
              <input class="form-control" type="text" id="third_cv" name="third_cv" placeholder="Enter C.V.">
            </div>
        </div>
        
        <div class="form-group row mb-0">
            <div class="form-group col-md-6">
                  <label class="form-control-label" for="volume_increase_rate">Volume Increase Rate</label>
                <div class="input-group">
                  <input class="form-control" type="text" id="volume_increase_rate" name="volume_increase_rate" placeholder="Enter Volume Increase Rate" required>
                    <span style="position: relative;" class="input-group-addon">kg/cm<span class="sec_pow">3</span></span>
                </div><!-- input-group -->  
            </div><!-- form-group -->
            <div class="form-group col-md-4">
              <label class="form-control-label" for="fourth_cv">C.V.</label>
              <input class="form-control" type="text" id="fourth_cv" name="fourth_cv" placeholder="Enter C.V.">
            </div>
        </div>
        
         <div class="form-group row mb-0">
            <div class="form-group col-md-6">
                  <label class="form-control-label" for="time_to_burst">Time to Burst</label>
                <div class="input-group">
                  <input class="form-control" type="text" id="time_to_burst" name="time_to_burst" placeholder="Enter Time to Burst" required>
                    <span class="input-group-addon">sec</span> 
                </div><!-- input-group -->  
            </div><!-- form-group -->
            <div class="form-group col-md-4">
              <label class="form-control-label" for="fourth_cv">C.V.</label>
              <input class="form-control" type="text" id="fourth_cv" name="fourth_cv" placeholder="Enter C.V.">
            </div>
        </div>
           
    </fieldset>
    <!--    Notes-->
    <fieldset id="dynamicInput">
        <div class="form-group">
            <label class="form-control-label">Condition</label>
            <input type="text" class="form-control" name="conditions[]">
        </div>

    </fieldset>
    <input type="button" value="Add another Condition" onClick="addInput('dynamicInput');">

    <div class="row">
        <div class="col-1 offset-md-10">
            <button class="btn btn-primary" onclick="location.href='lab_manager.php';" name="cancel">Cancel</button>
        </div>
        <div class="col-1">
            <button class="btn btn-primary" type="submit" name="submit">Submit</button>
        </div>
    </div>
         
   
</form>

</div><!-- content container -->

<footer class="footer">
    <p>&copy; <a href="http://www.ntu.edu.com" title="National textile University" target="_blank">NTU</a> | follow us on Twitter! <a href="https://twitter.com/NTUOfficial" title="Follow us on Twitter">@NTUOfficial</a>
        <br>For additional information. please visit the main or about page</p>
</footer>


<script src="js/jquery.slim.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/scripts.js"></script>
<script>
    var counter = 1;
    var limit = 3;
    function addInput(divName){
        if (counter == limit)  {
            alert("You have reached the limit of adding " + counter + " inputs");
        }
        else {

            var newdiv = document.createElement('div');
            newdiv.setAttribute("class","form-group");
            newdiv.innerHTML = "<label class=\"form-control-label\">Condition</label> " + (counter + 1) + "<input type=\"text\" class=\"form-control\" name=\"conditions[]\">";
            document.getElementById(divName).appendChild(newdiv);
            counter++;
        }
    }
</script>
</body>
</html>
