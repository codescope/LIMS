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
    redirect_to("view_sample_detail.php?sample_id={$sample['sample_id']}&test_name=tensile_test");
}
elseif (isset($_POST['submit'])) {
    // Process the form

    // validations
    $fields = array("test_standard","temperature","humidity","mean_strength_wrap","mean_percent_elongation_wrap","mean_strength_weft","mean_percent_elongation_weft");
    validate_presences($fields);
    $fields_with_max_lengths = array("sample_id" => 20,"sample_type" => 15,"sample_description" => 1500,"test_standard" => 400,"temperature" =>40,"humidity" => 40,
        "mean_strength_wrap"=>80,"mean_strength_wrap_unit"=>10,"mean_percent_elongation_wrap"=>80,"mean_strength_weft"=>80,"mean_strength_weft_unit"=>10,"mean_percent_elongation_weft"=>80,
        "first_cv"=>80,"second_cv"=>80,"third_cv"=>80,"fourth_cv"=>80);
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
        $mean_strength_wrap = mysql_prep($_POST["mean_strength_wrap"]);
        $mean_strength_wrap_unit = mysql_prep($_POST["mean_strength_wrap_unit"]);
        $mean_strength_wrap = $mean_strength_wrap . " " .$mean_strength_wrap_unit;
        $mean_percent_elongation_wrap = mysql_prep($_POST["mean_percent_elongation_wrap"]);
        $mean_strength_weft = mysql_prep($_POST["mean_strength_weft"]);
        $mean_strength_weft_unit = mysql_prep($_POST["mean_strength_weft_unit"]);
        $mean_strength_weft = $mean_strength_weft . " " .$mean_strength_weft_unit;
        $mean_percent_elongation_weft = mysql_prep($_POST["mean_percent_elongation_weft"]);
        $first_cv = mysql_prep($_POST["first_cv"]);
        $second_cv = mysql_prep($_POST["second_cv"]);
        $third_cv = mysql_prep($_POST["third_cv"]);
        $fourth_cv = mysql_prep($_POST["fourth_cv"]);
        $conditions = $_POST["conditions"];

        $test_conditions="";
        if($test_standard=="ISO 13934-1"){
            $test_conditions = "Speciman Size (200mm x 50 mm), Rate of Extension (20mm/min), Pretension (2N).";
        }
        elseif ($test_standard=="ISO 13934-2"){
            $test_conditions = "Speciman Size (100mm x 100 mm), Rate of Extension (50mm/min).";
        }
        elseif ($test_standard=="ASTM D5034"){
            $test_conditions = "Specimen was tested as directed in test method ASTM D5034, Tested on LLOYD LRxPlus CRE type machine, Gage Length=75mm, Max. Obtainable force= 5KN, Jaw faces 25mmx100mm, Pneumatic Jaws with Rubber Gisps, Condtion.";
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


        $query  = "UPDATE tensile_strength ";
        $query .= "SET status='pending', sample_description='{$sample_description}', test_standard='{$test_standard}', temperature='{$temperature}', humidity='{$humidity}', mean_strength_wrap='{$mean_strength_wrap}', mean_percent_elongation_wrap='{$mean_percent_elongation_wrap}', mean_strength_weft='{$mean_strength_weft}', mean_percent_elongation_weft='{$mean_percent_elongation_weft}', first_cv='{$first_cv}', sec_cv='{$second_cv}', third_cv='{$third_cv}', fourth_cv='{$fourth_cv}', test_conditions='{$test_conditions}' ";
        $query .= "WHERE sample_id='{$sample_id}' LIMIT 1";
        $result = mysqli_query($connection, $query);


        if ($result && mysqli_affected_rows($connection) == 1) {

            $_SESSION["message"] = "Sample Test information updated.";
            redirect_to("view_sample_detail.php?sample_id={$sample['sample_id']}&test_name=tensile_test");
        }
        elseif($result){
            $_SESSION["message"] = "Sample Test information is not updated.";
            redirect_to("view_sample_detail.php?sample_id={$sample['sample_id']}&test_name=tensile_test");

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
    <title>Edit Tensile Strength Testing Form</title>
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

    <h2 class="text-md-center mb-3">Tensile Testing Result Form</h2>

    <form action="edit_tensile_strength_test.php?sample_id=<?php echo $sample['sample_id']; ?>" method="post">

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
                    <option value="" >Choose standard...</option>
                    <option value="ISO 13934-1" data-foo="NOTE: Speciman Size (200mm x 50 mm), Rate of Extension (20mm/min), Pretension (2N), Condtion:" <?php if($sample['test_standard']==="ISO 13934-1") echo "selected";?>>ISO 13934-1 (Strip Method)</option>
                    <option value="ISO 13934-2" data-foo= "NOTE: Speciman Size (100mm x 100 mm), Rate of Extension (50mm/min), Condtion: " <?php if($sample['test_standard']==="ISO 13934-2") echo "selected";?>>ISO 13934-2 (Grab Method)</option>

                    <option value="ASTM D5034" data-foo= "NOTE: Specimen was tested as directed in test method ASTM D5034, Tested on LLOYD LRxPlus CRE type machine, Gage Length=75mm, Max. Obtainable force= 5KN, Jaw faces 25mmx100mm, Pneumatic Jaws with Rubber Gisps, Condtion: " <?php if($sample['test_standard']==="ASTM D5034") echo "selected";?>>ASTM D5034 (Grab Test)</option>

                    <option value="ASTM D5035" <?php if($sample['test_standard']==="ASTM D5035") echo "selected";?>>ASTM D5035 (Strip Test)</option>
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
        if($sample['mean_stength-wrap']){
           list($mean_str_warp,$mean_str_warp_unit)= explode(' ',$sample['mean_strength_wrap']);
        }
        if($sample['mean_stength-weft']){
            list($mean_str_weft,$mean_str_weft_unit)= explode(' ',$sample['mean_strength_weft']);
        }
        ?>
        <fieldset class="form-group mb-0">
            <legend>Test outcomes</legend>
            <div class="form-group row mb-0">
                <div class="form-group col-md-6">
                    <label class="form-control-label" for="mean_strength_wrap">Mean Strength&#40;N&#41; &#40;wrap&#41;</label>
                    <div class="input-group">
                        <input class="form-control" type="text" id="mean_strength_wrap" name="mean_strength_wrap" placeholder="Enter Tensile Strength wrap" value="<?php echo $mean_str_warp;?>" required>
                        <span class="input-group-addon">
                    <select id="mean_strength_unit" name="mean_strength_wrap_unit" required>
                        <option <?php if($mean_str_warp_unit==='CN') echo "selected"; ?>>CN</option>
                        <option <?php if($mean_str_warp_unit==='N') echo "selected"; ?>>N</option>
                        <option <?php if($mean_str_warp_unit==='lbf') echo "selected"; ?>>lbf</option>
                        <option <?php if($mean_str_warp_unit==='kgf') echo "selected"; ?>>kgf</option>
                    </select>
                    </span>
                    </div><!-- input-group -->
                </div><!-- form-group -->
                <div class="form-group col-md-4">
                    <label class="form-control-label" for="first_cv">C.V.</label>
                    <input class="form-control" type="text" id="first_cv" name="first_cv" placeholder="Enter C.V." value="<?php echo $sample['first_cv']; ?>">
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="form-group col-md-6">
                    <label class="form-control-label" for="mean_elongation_wrap">Mean Percentage Elongation &#40;wrap&#41;</label>
                    <input class="form-control" type="text" id="mean_elongation_wrap" name="mean_percent_elongation_wrap" placeholder="Enter Mean Percentage elongation wrap" value="<?php echo $sample['mean_percent_elongation_wrap']; ?>" required>
                </div><!-- form-group -->
                <div class="form-group col-md-4">
                    <label class="form-control-label" for="second_cv">C.V.</label>
                    <input class="form-control" type="text" id="second_cv" name="second_cv" placeholder="Enter C.V." value="<?php echo $sample['sec_cv']; ?>">
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="form-group col-md-6">
                    <label class="form-control-label" for="mean_strength_weft">Mean Strength&#40;N&#41; &#40;weft&#41;</label>
                    <div class="input-group">
                        <input class="form-control" type="text" id="mean_strength_weft" name="mean_strength_weft" placeholder="Enter Tensile Strength weft" value="<?php echo $mean_str_weft; ?>" required>
                        <span class="input-group-addon">
                    <select id="mean_strength_unit" name="mean_strength_weft_unit">
                        <option <?php if($mean_str_weft_unit==='CN') echo "selected"; ?>>CN</option>
                        <option <?php if($mean_str_weft_unit==='N') echo "selected"; ?>>N</option>
                        <option <?php if($mean_str_weft_unit==='lbf') echo "selected"; ?>>lbf</option>
                        <option <?php if($mean_str_weft_unit==='kgf') echo "selected"; ?>>kgf</option>
                    </select>
                  </span>
                    </div><!-- input-group -->
                </div><!-- form-group -->
                <div class="form-group col-md-4">
                    <label class="form-control-label" for="third_cv">C.V.</label>
                    <input class="form-control" type="text" id="third_cv" name="third_cv" placeholder="Enter C.V." value="<?php echo $sample['third_cv']; ?>">
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="form-group col-md-6">
                    <label class="form-control-label" for="mean_percentage_elongation_weft">Mean Percentage Elongation &#40;weft&#41;</label>
                    <input class="form-control" type="text" id="mean_percentage_elongation_weft" name="mean_percent_elongation_weft" placeholder="Enter Mean Percentage Elongation weft" value="<?php echo $sample['mean_percent_elongation_weft']; ?>" required>
                </div><!-- form-group -->
                <div class="form-group col-md-4">
                    <label class="form-control-label" for="fourth_cv">C.V.</label>
                    <input class="form-control" type="text" id="fourth_cv" name="fourth_cv" placeholder="Enter C.V." value="<?php echo $sample['fourth_cv']; ?>">
                </div>
            </div>

        </fieldset>
        <fieldset>
            <div id="dynamicInput" class="form-group">
                <label class="form-control-label">Condition</label>
                <input type="text" class="form-control" name="conditions[]">
            </div>
            <input type="button" value="Add another field" onClick="addInput('dynamicInput');">
        </fieldset>

        <div class="row">
            <div class="col-1 offset-md-10">
                <button class="btn btn-primary" type="submit" onclick="location.href='view_sample_detail.php?sample_id=<?php echo $sample['sample_id'];?>&test_name=tensile_test';" name="cancel">Cancel</button>
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
<!--<footer id="footer">
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
