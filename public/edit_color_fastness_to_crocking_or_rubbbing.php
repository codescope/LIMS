<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php
if(isset($_GET['sample_id'])) {
    $sample = get_tensile_test_by_id($_GET['sample_id']);
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
    redirect_to("view_sample_detail.php?sample_id={$sample['sample_id']}&test_name=crocking_test");
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
        $sample_id=$sample['sample_id'];
        $sample_type=$sample['sample_type'];
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


        $query  = "UPDATE color_fastness_to_crocking (";
        $query .= "SET status='pending', sample_description='{$sample_description}', test_standard='{$test_standard}', temperature='{$temperature}', humidity='{$humidity}', dry='{$dry}', wet='{$wet}', first_cv='{$first_cv}', second_cv='{$second_cv}', test_conditions='{$test_conditions}' ";
        $query .= "WHERE sample_id='{$sample_id}' LIMIT 1";
        $result = mysqli_query($connection, $query);


        if ($result && mysqli_affected_rows($connection) == 1) {

            $_SESSION["message"] = "Sample Test information updated.";
            redirect_to("view_sample_detail.php?sample_id={$sample['sample_id']}&test_name=crocking_test");
        }
        elseif($result){
            $_SESSION["message"] = "Sample Test information is not updated.";
            redirect_to("view_sample_detail.php?sample_id={$sample['sample_id']}&test_name=crocking_test");

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
    <title>Edit Color fastness to Crocking/Rubbing Testing Form</title>
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

    <form action="edit_color_fastness_to_crocking_or_rubbbing.php?sample_id=<?php echo $sample['sample_id']; ?>" method="post">

        <fieldset class="form-group mb-0">
            <legend>Sample Information</legend>
            <div class="form-group row mb-0">
                <div class="form-group col-6">
                    <label class="form-control-label sr-only" for="id">Sample ID</label>
                    <input class="form-control" type="text" id="id" name="id" placeholder="Enter Sample ID" value="<?php echo $sample['sample_id']; ?>" readonly>
                </div><!-- form-group -->
                <div class="form-group col-6">
                    <label class="form-control-label sr-only" for="sample_type">Sample Type</label>
                    <input class="form-control" type="text" id="sample_type" name="sample_type" placeholder="Enter Sample Type" value="<?php echo $sample['sample_type']; ?>" readonly>
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
                <textarea class="form-control" rows="3" id="sample_description" name="sample_description" placeholder="Enter Sample Description"><?php echo $sample['sample_description']; ?></textarea>
            </div>


        </fieldset><!-- fieldset -->

        <fieldset class="form-group mb-0">
            <legend>Test Parameters</legend>

            <div class="form-group">
                <label class="form-control-label" for="test_standard">Test Standard</label>
                <select class="form-control" id="test_standard" name="test_standard" required>
                    <option value="">Choose standard...</option>
                    <option value="ISO 105&times;12 2002" <?php if($sample['test_standard']==="ISO 105&times;12 2002") echo "selected"; ?> >ISO 105&times;12 2002</option>
                    <option value="AATCC 08 2016" <?php if($sample['test_standard']==="AATCC 08 2016") echo "selected";?>>AATCC 08 2016</option>

                </select>
            </div>

            <label>Test Conditions</label>
            <div class="form-group row mb-0">
                <div class="form-group col-6">
                    <label class="form-control-label sr-only" for="temperature">Temperature</label>
                    <div class="input-group">
                        <input class="form-control" type="text" id="temperature" placeholder="Enter temperature" name="temperature" value="<?php echo $sample['temperature'];?>" required>
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

        <fieldset class="form-group mb-0">
            <legend>Test outcomes</legend>
            <div class="form-group row mb-0">
                <div class="form-group col-md-6">
                    <label class="form-control-label" for="dry">Dry</label>

                    <select class="form-control" id="dry" name="dry" required>
                        <option value="">--G.S. Rating--</option>
                        <option value="1" <?php if($sample['dry']==='1') echo "selected"; ?>>1</option>
                        <option value="1-2" <?php if($sample['dry']==='1-2') echo "selected"; ?>>1-2</option>
                        <option value="2" <?php if($sample['dry']==='2') echo "selected"; ?>>2</option>
                        <option value="2-3" <?php if($sample['dry']==='2-3') echo "selected"; ?>>2-3</option>
                        <option value="3" <?php if($sample['dry']==='3') echo "selected"; ?>>3</option>
                        <option value="3-4" <?php if($sample['dry']==='3-4') echo "selected"; ?>>3-4</option>
                        <option value="4" <?php if($sample['dry']==='4') echo "selected"; ?>>4</option>
                        <option value="4-5" <?php if($sample['dry']==='4-5') echo "selected"; ?>>4-5</option>
                        <option value="5" <?php if($sample['dry']==='5') echo "selected"; ?>>5</option>
                    </select>
                </div><!-- form-group -->
                <div class="form-group col-md-4">
                    <label class="form-control-label" for="first_cv">C.V.</label>
                    <input class="form-control" type="text" id="first_cv" name="first_cv" placeholder="Enter C.V." value="<?php echo $sample['first_cv']; ?>">
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="form-group col-md-6">
                    <label class="form-control-label" for="wet">Wet</label>

                    <select class="form-control" id="wet" name="wet" required>
                        <option value="">--G.S. Rating--</option>
                        <option value="1" <?php if($sample['wet']==='1') echo "selected"; ?>>1</option>
                        <option value="1-2" <?php if($sample['wet']==='1-2') echo "selected"; ?>>1-2</option>
                        <option value="2" <?php if($sample['wet']==='2') echo "selected"; ?>>2</option>
                        <option value="2-3" <?php if($sample['wet']==='2-3') echo "selected"; ?>>2-3</option>
                        <option value="3" <?php if($sample['wet']==='3') echo "selected"; ?>>3</option>
                        <option value="3-4" <?php if($sample['wet']==='3-4') echo "selected"; ?>>3-4</option>
                        <option value="4" <?php if($sample['wet']==='4') echo "selected"; ?>>4</option>
                        <option value="4-5" <?php if($sample['wet']==='4-5') echo "selected"; ?>>4-5</option>
                        <option value="5" <?php if($sample['wet']==='5') echo "selected"; ?>>5</option>
                    </select>
                </div><!-- form-group -->
                <div class="form-group col-md-4">
                    <label class="form-control-label" for="second_cv">C.V.</label>
                    <input class="form-control" type="text" id="second_cv" name="second_cv" placeholder="Enter C.V." value="<?php echo $sample['second_cv']; ?>">
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
                <button class="btn btn-primary" onclick="location.href='view_sample_detail.php?sample_id=<?php echo $sample['sample_id'];?>&test_name=crocking_test';" name="cancel">Cancel</button>
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
<!-- <footer id="footer">
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
    </footer>--><!--footer-->

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
