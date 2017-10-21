<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php
if(isset($_GET['sample_id'])) {
    $sample = get_bursting_test_by_id($_GET['sample_id']);
    if (!$sample) {
        redirect_to("lab_manager.php");
    }
}
else{
    redirect_to("lab_manager.php");
}
//  Form Submission
if(isset($_POST['cancel'])){
    $_SESSION["message"] = "Sample Test information is not updated";
    redirect_to("view_sample_detail.php?sample_id={$sample['sample_id']}&test_name=bursting_test");
}
elseif (isset($_POST['submit'])) {
    // Process the form

    // validations
    $fields = array("sample_id","sample_type","test_standard","temperature","humidity","mean_busting_strength","mean_height","test_area","volume_increase_rate","time_to_burst");
    validate_presences($fields);
    $fields_with_max_lengths = array("sample_id" => 20,"sample_type" => 15,"sample_description" => 1500,"test_standard" => 400,"temperature" =>40,"humidity" => 40,
        "mean_busting_strength"=>80,"mean_height"=>80,"test_area"=>80,"volume_increase_rate"=>80,"time_to_burst"=>80,
        "first_cv"=>80,"second_cv"=>80,"third_cv"=>80,"fourth_cv"=>80,"fifth_cv"=>80);
    validate_max_lengths($fields_with_max_lengths);
// $fields_with_max_values = array("no_of_tests" => 11);
//  validate_max_lengths_for_integers($fields_with_max_values);

    if (empty($errors)) {
        // Perform Create
        $sample_id=$sample['sample_id'];
        $sample_type=$sample['sample_type'];
        $sample_description = mysql_prep($_POST["sample_description"]);
        $test_standard = mysql_prep($_POST["test_standard"]);
        $temperature = mysql_prep($_POST["temperature"]);
        $humidity = mysql_prep($_POST["humidity"]);
        $mean_busting_strength = mysql_prep($_POST["mean_busting_strength"]);
        $mean_busting_strength_unit = mysql_prep($_POST["mean_busting_strength_unit"]);
        $mean_busting_strength = $mean_busting_strength . " ".$mean_busting_strength_unit;
        $mean_height = mysql_prep($_POST["mean_height"]);
        $mean_height_unit = mysql_prep($_POST["mean_height_unit"]);
        $mean_height = $mean_height . " ".$mean_height_unit;
        $test_area = mysql_prep($_POST["test_area"]);
        $test_area = $test_area . " cm<sup>2</sup>";
        $volume_increase_rate = mysql_prep($_POST["volume_increase_rate"]);
        $volume_increase_rate = $volume_increase_rate . " kg/cm<sup>3</sup>";
        $time_to_burst = mysql_prep($_POST["time_to_burst"]);
        $time_to_burst = $time_to_burst . " secs";
        $first_cv = mysql_prep($_POST["first_cv"]);
        $second_cv = mysql_prep($_POST["second_cv"]);
        $third_cv = mysql_prep($_POST["third_cv"]);
        $fourth_cv = mysql_prep($_POST["fourth_cv"]);
        $fifth_cv = mysql_prep($_POST["fifth_cv"]);
        $conditions = $_POST["conditions"];

        $test_conditions="";
        if($test_standard=="ASTM D3786"){
            $test_conditions = "Tested as directed in test method D3786 using Gatelab hydraulic inflated diaphragm bursting tester";
        }

        else{

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


        $query  = "UPDATE bursting_properties_of_fabrics ";
        $query .= "SET status='pending', sample_description='{$sample_description}', test_standard='{$test_standard}', temperature='{$temperature}', humidity='{$humidity}', mean_burst_strength='{$mean_busting_strength}', mean_burst_height='{$mean_height}', test_area='{$test_area}',volume_increase_rate='{$volume_increase_rate}',time_to_burst='{$time_to_burst}',first_cv='{$first_cv}', sec_cv='{$second_cv}',third_cv='{$third_cv}',fourth_cv='{$fourth_cv}',fifth_cv='{$fifth_cv}' ,test_conditions='{$test_conditions}' ";
        $query .= "WHERE sample_id='{$sample_id}' LIMIT 1";
        $result = mysqli_query($connection, $query);


        if ($result && mysqli_affected_rows($connection) == 1) {

            $_SESSION["message"] = "Sample Test information updated.";
            redirect_to("view_sample_detail.php?sample_id={$sample['sample_id']}&test_name=bursting_test");
        }
        elseif($result){
            $_SESSION["message"] = "Sample Test information is not updated.";
            redirect_to("view_sample_detail.php?sample_id={$sample['sample_id']}&test_name=bursting_test");

        }
        else{
            $_SESSION["message"] = "Sample Test update query failed";
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
    <title>Edit Bursting Properties Testing Form</title>
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
<?php echo message(); ?>
<?php echo form_errors($errors); ?>

<div class="container mt-4">

    <h2 class="text-md-center mb-3">Bursting Properties Testing Form</h2>

    <form action="edit_bursting_properties_of_fabrics.php?sample_id=<?php echo $sample['sample_id']; ?>" method="post">

        <fieldset class="form-group mb-0">
            <legend>Sample Information</legend>
            <div class="form-group row mb-0">
                <div class="form-group col-6">
                    <label class="form-control-label sr-only" for="id">Sample ID</label>
                    <input class="form-control" type="text" id="id" name="sample_id" placeholder="Enter Sample ID" value="<?php echo $sample['sample_id']; ?>" readonly>
                </div><!-- form-group -->
                <div class="form-group col-6">
                    <label class="form-control-label sr-only" for="sample_type">Sample Type</label>
                    <input class="form-control" type="text" id="sample_type" name="sample_type" placeholder="Enter Sample Type" value="<?php echo $sample['sample_type']; ?>" readonly>
                </div>
            </div>

            <div class="form-group">
                <label class="form-control-label sr-only" for="sample_description">Sample Description</label>
                <textarea class="form-control" rows="3" id="sample_description" name="sample_description" placeholder="Enter Sample Description"><?php echo $sample['sample_description']; ?></textarea>
            </div>

        </fieldset><!-- fieldset -->

        <fieldset class="form-group mb-0">
            <legend>Test Parameters</legend>

            <div class="form-group">
                <label class="form-control-label" for="test_standard">Test Standard</label>
                <select class="form-control" id="test_standard" name="test_standard" required>
                    <option value="">Choose standard...</option>
                    <option value="ISO 13938-1, 1999" <?php if($sample['test_standard']==="ISO 13938-1, 1999") echo "selected"; ?>>ISO 13938-1, 1999
                    </option>
                    <option value="ASTM D3786" <?php if($sample['test_standard']==="ASTM D3786") echo "selected"; ?>>ASTM D3786</option>
                </select>
            </div>

            <label>Test Conditions</label>
            <div class="form-group row mb-0">
                <div class="form-group col-6">
                    <label class="form-control-label sr-only" for="temperature">Temperature</label>
                    <div class="input-group">
                        <input class="form-control" type="text" id="temperature" name="temperature" placeholder="Enter temperature" value="<?php echo $sample['temperature'];?>" required>
                        <span class="input-group-addon">&deg;C</span>
                    </div><!-- input-group -->
                </div><!-- form-group -->
                <div class="form-group col-6">
                    <label class="form-control-label sr-only" for="humidity">Humidity</label>
                    <div class="input-group">
                        <input class="form-control" type="text" id="humidity" name="humidity" placeholder="Enter humidity" value="<?php echo $sample['humidity'];?>" required>
                        <span class="input-group-addon">&#37;</span>
                    </div>
                </div>
            </div>
        </fieldset>
        <?php
        if($sample['mean_burst_strength']){
            list($mean_burst_strength,$mean_burst_strength_unit)= explode(' ',$sample['mean_burst_strength']);
        }
        if($sample['mean_burst_height']){
            list($mean_burst_height,$mean_burst_height_unit)= explode(' ',$sample['mean_burst_height']);
        }
        if($sample['test_area']){
            list($test_area_value,$test_area_unit)= explode(' ',$sample['test_area']);
        }
        if($sample['volume_increase_rate']){
            list($volume_increase_rate_value,$volume_increase_rate_unit)= explode(' ',$sample['volume_increase_rate']);
        }
        if($sample['time_to_burst']){
            list($time_to_burst_value,$time_to_burst_unit)= explode(' ',$sample['time_to_burst']);
        }
        ?>

        <fieldset class="form-group mb-0">
            <legend>Test outcomes</legend>
            <div class="form-group row mb-0">
                <div class="form-group col-md-6">
                    <label class="form-control-label" for="mean_busting_strength">Mean Busting Strength</label>
                    <div class="input-group">
                        <input class="form-control" type="text" id="mean_busting_strength" name="mean_busting_strength" placeholder="Enter Mean Busting Strength" value="<?php echo $mean_burst_strength?>" required>
                        <span class="input-group-addon">
                    <select id="mean_strength_unit" name="mean_busting_strength_unit" required>
                        <option <?php if($mean_burst_strength_unit==="KiloPascals") echo "selected"; ?>>KiloPascals</option>
                    </select>
                    </span>
                    </div><!-- input-group -->
                </div><!-- form-group -->
                <div class="form-group col-md-4">
                    <label class="form-control-label" for="first_cv">C.V.</label>
                    <input class="form-control" type="text" id="first_cv" name="first_cv" placeholder="Enter C.V." value="<?php echo $sample['first_cv'];?>">
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="form-group col-md-6">
                    <label class="form-control-label" for="mean_height">Mean Burst Height</label>
                    <div class="input-group">
                        <input class="form-control" type="text" id="mean_height" name="mean_height" placeholder="Enter Mean Height" value="<?php echo $mean_burst_height;?>" required>
                        <span class="input-group-addon">
                    <select id="mean_strength_unit" name="mean_height_unit" required>
                        <option <?php if($mean_burst_height_unit==="mm") echo "selected"; ?>>mm</option>
                    </select>
                  </span>
                    </div><!-- input-group -->
                </div><!-- form-group -->
                <div class="form-group col-md-4">
                    <label class="form-control-label" for="second_cv">C.V.</label>
                    <input class="form-control" type="text" id="second_cv" name="second_cv" placeholder="Enter C.V." value="<?php echo $sample['sec_cv'];?>">
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="form-group col-md-6">
                    <label class="form-control-label" for="test_area">Test Area</label>
                    <div class="input-group">
                        <input class="form-control" type="text" id="test_area" name="test_area" placeholder="Enter Test area" value="<?php echo $test_area_value;?>" required>
                        <span style="position: relative;" class="input-group-addon">cm<span class="pow">2</span></span>
                    </div><!-- input-group -->
                </div><!-- form-group -->
                <div class="form-group col-md-4">
                    <label class="form-control-label" for="third_cv">C.V.</label>
                    <input class="form-control" type="text" id="third_cv" name="third_cv" placeholder="Enter C.V." value="<?php echo $sample['third_cv'];?>">
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="form-group col-md-6">
                    <label class="form-control-label" for="volume_increase_rate">Volume Increase Rate</label>
                    <div class="input-group">
                        <input class="form-control" type="text" id="volume_increase_rate" name="volume_increase_rate" placeholder="Enter Volume Increase Rate" value="<?php echo $volume_increase_rate_value;?>" required>
                        <span style="position: relative;" class="input-group-addon">kg/cm<span class="sec_pow">3</span></span>
                    </div><!-- input-group -->
                </div><!-- form-group -->
                <div class="form-group col-md-4">
                    <label class="form-control-label" for="fourth_cv">C.V.</label>
                    <input class="form-control" type="text" id="fourth_cv" name="fourth_cv" placeholder="Enter C.V." value="<?php echo $sample['fourth_cv'];?>">
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="form-group col-md-6">
                    <label class="form-control-label" for="time_to_burst">Time to Burst</label>
                    <div class="input-group">
                        <input class="form-control" type="text" id="time_to_burst" name="time_to_burst" placeholder="Enter Time to Burst" value="<?php echo $time_to_burst_value;?>" required>
                        <span class="input-group-addon">secs</span>
                    </div><!-- input-group -->
                </div><!-- form-group -->
                <div class="form-group col-md-4">
                    <label class="form-control-label" for="fifth_cv">C.V.</label>
                    <input class="form-control" type="text" id="fifth_cv" name="fifth_cv" placeholder="Enter C.V." value="<?php echo $sample['fifth_cv'];?>">
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
                <button class="btn btn-primary" type="button" onclick="location.href='view_sample_detail.php?sample_id=<?php echo $sample['sample_id'];?>&test_name=bursting_test';" name="cancel">Cancel</button>
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
