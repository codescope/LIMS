<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php
// For populating previous records
if(isset($_GET['prev_record'])){
    $sample =get_sample_record();

}
else {
//initialize customer attributes
    $sample_id = "";
    $sample_type = "";
}
//  Form Submission
if(isset($_POST['cancel'])){
    redirect_to("pending_samples.php");
}
elseif (isset($_POST['submit'])) {
    // Process the form

    // validations
    $fields = array("test_standard","temperature","humidity");
    validate_presences($fields);
    $fields_with_max_lengths = array("sample_id" => 20,"sample_type" => 15,"sample_description" => 1500,"test_standard" => 400,"temperature" =>40,"humidity" => 40,
        "first_cv"=>80,"second_cv"=>80);
    validate_max_lengths($fields_with_max_lengths);
// $fields_with_max_values = array("no_of_tests" => 11);
//  validate_max_lengths_for_integers($fields_with_max_values);

    if (empty($errors)) {
        // Perform Create
        $sample_id=mysql_prep($_POST["sample_id"]);
        $sample_type=mysql_prep($_POST["sample_type"]);
        $sample_description = mysql_prep($_POST["sample_description"]);
        $test_standard = mysql_prep($_POST["test_standard"]);
        $temperature = mysql_prep($_POST["temperature"]);
        $humidity = mysql_prep($_POST["humidity"]);
        $dry = mysql_prep($_POST["dry"]);
        $wet = mysql_prep($_POST["wet"]);
        $first_cv = mysql_prep($_POST["first_cv"]);
        $second_cv = mysql_prep($_POST["second_cv"]);
        $conditions = $_POST["conditions"];

        $test_conditions="";
        if($test_standard=="ISO 105&times;12 2002"){
            $test_conditions = "Rubbing finger, 16mm diameter, downward force 9&#177;0.2 N, warp direction";
        }
        elseif ($test_standard=="AATCC 08 2016"){
            $test_conditions = "Gray Scale Rating";
        }
        else{
            $test_conditions ="";
        }
        if ($conditions)
        {
            foreach ($conditions as $condition)
            {
                $condition = mysql_prep($condition);
                if(!empty($condition)){
                    if($test_conditions)
                        $test_conditions .= "@" . $condition;
                    else
                        $test_conditions .= $condition;
                }
            }
        }


        $query  = "INSERT INTO color_fastness_to_crocking (";
        $query .= "  sample_id, status, sample_description, test_standard, temperature, humidity, dry, wet, first_cv, second_cv, test_conditions ";
        $query .= ") VALUES (";
        $query .= "  '099610935517', 'pending', '{$sample_description}', '{$test_standard}', '{$temperature}', '{$humidity}', '{$dry}', '{$wet}' , '{$first_cv}', '{$second_cv}', '{$test_conditions}' ";
        $query .= ")";
        $result = mysqli_query($connection, $query);


        if ($result && mysqli_affected_rows($connection) == 1) {

            redirect_to("view_sample_detail.php?sample_id=099610935517&test_name=crocking_test");
        }
        else{
            $_SESSION["message"] = "Sample Submission failed.";
        }

    }  // if(empty($errors)

} // if(isset($_POST['submit']))

else {
    // This is probably a GET request

} // end: if (isset($_POST['submit']))
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/test_styles.css">
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

<form action="Color_fastness_to_crocking_or_rubbing.php" method="post">

  <fieldset class="form-group mb-0">
    <legend>Sample Information</legend>
    <div class="form-group row mb-0">
        <div class="form-group col-6">
              <label class="form-control-label sr-only" for="id">Sample ID</label>
              <input class="form-control" type="text" id="id" name="id" placeholder="Enter Sample ID">
        </div><!-- form-group -->
        <div class="form-group col-6">
          <label class="form-control-label sr-only" for="sample_type">Sample Type</label>
          <input class="form-control" type="text" id="sample_type" name="sample_type" placeholder="Enter Sample Type">
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
      <textarea class="form-control" rows="3" id="sample_description" name="sample_description" placeholder="Enter Sample Description"></textarea>
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
        <select class="form-control" id="test_standard" name="test_standard" required>
        <option selected value="">Choose standard...</option>
        <option value="ISO 105&times;12 2002" >ISO 105&times;12 2002</option>
        <option value="AATCC 08 2016">AATCC 08 2016</option>
    
        </select>
        </div>
        
        <label>Test Conditions</label>
        <div class="form-group row mb-0">
            <div class="form-group col-6">
                  <label class="form-control-label sr-only" for="temperature">Temperature</label>
                <div class="input-group">
                  <input class="form-control" type="text" id="temperature" placeholder="Enter temperature" name="temperature" required>
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
                  <label class="form-control-label" for="dry">Dry</label>
                   
                    <select class="form-control" id="dry" name="dry" required>
                        <option selected value="">--G.S. Rating--</option>
                        <option value="1" >1</option>
                        <option value="1-2" >1-2</option>
                        <option value="2">2</option>
                        <option value="2-3">2-3</option>
                        <option value="3">3</option>
                        <option value="3-4">3-4</option>
                        <option value="4">4</option>
                        <option value="4-5">4-5</option>
                        <option value="5">5</option>
                    </select> 
            </div><!-- form-group -->
            <div class="form-group col-md-4">
              <label class="form-control-label" for="first_cv">C.V.</label>
              <input class="form-control" type="text" id="first_cv" name="first_cv" placeholder="Enter C.V.">
            </div>
        </div>
        
        <div class="form-group row mb-0">
            <div class="form-group col-md-6">
                <label class="form-control-label" for="wet">Wet</label>
                   
                    <select class="form-control" id="wet" name="wet" required>
                        <option selected value="">--G.S. Rating--</option>
                        <option value="1">1</option>
                        <option value="1-2">1-2</option>
                        <option value="2">2</option>
                        <option value="2-3">2-3</option>
                        <option value="3">3</option>
                        <option value="3-4">3-4</option>
                        <option value="4">4</option>
                        <option value="4-5">4-5</option>
                        <option value="5">5</option>
                    </select> 
            </div><!-- form-group -->
            <div class="form-group col-md-4">
              <label class="form-control-label" for="second_cv">C.V.</label>
              <input class="form-control" type="text" id="second_cv" name="second_cv" placeholder="Enter C.V.">
            </div>
        </div>
        
        
    </fieldset>

    <!--    Notes-->
    <fieldset>
        <div id="dynamicInput" class="form-group">
            <label class="form-control-label">Condition</label>
            <input type="text" class="form-control" name="conditions[]">
        </div>
        <input type="button" value="Add another field" onClick="addInput('dynamicInput');">
    </fieldset>

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
