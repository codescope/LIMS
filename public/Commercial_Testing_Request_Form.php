<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php
// For populating previous records
if(isset($_GET['prev_record'])){
   $customer =get_recent_customer();
   if(isset($customer)){
       $c_name = $customer['name'];
       $city = $customer['city'];
       $organization = $customer['organization'];
       $designation = $customer['designation'];
       $phone = $customer['phone'];
       $email = $customer['email'];
       $address = $customer['address'];
   }
   else{
       $c_name = "";
       $city = "";
       $organization = "";
       $designation = "";
       $phone = "";
       $email = "";
       $address = null;
   }
}
// prev_customer_id coming from get_previous_customer_info.php page
elseif (isset($_GET['prev_customer'])){
    $customer =get_customer_by_id($_GET['prev_customer']);
    if(isset($customer)){
        $c_name = $customer['name'];
        $city = $customer['city'];
        $organization = $customer['organization'];
        $designation = $customer['designation'];
        $phone = $customer['phone'];
        $email = $customer['email'];
        $address = $customer['address'];
    }
    else{
        $c_name = "";
        $city = "";
        $organization = "";
        $designation = "";
        $phone = "";
        $email = "";
        $address = null;
    }
}
else {
//initialize customer attributes
    $c_name = "";
    $city = "";
    $organization = "";
    $designation = "";
    $phone = "";
    $email = "";
    $address = null;
}
//  Form Submission
if(isset($_POST['cancel'])){
    redirect_to("reception.php");
}
elseif (isset($_POST['submit'])) {
  // Process the form
  
  // validations
    $fields = array("cname","city","organization","phone","email");
    validate_presences($fields);
    $fields_with_max_lengths = array("cname" => 30,"city" => 30,"organization" => 50,"phone" => 50,"email" =>50,"address" => 300);
    validate_max_lengths($fields_with_max_lengths);
// $fields_with_max_values = array("no_of_tests" => 11);
//  validate_max_lengths_for_integers($fields_with_max_values);

  if (empty($errors)) {
    // Perform Create
        $sample_id=get_sample_id();
        $customer_id=get_customer_id();
        $expected_date = date("Y-m-d", strtotime($_POST['expected_date']));
        $expected_date = mysql_prep($expected_date);
        $c_name = mysql_prep($_POST["cname"]);
        $city = mysql_prep($_POST["city"]);
        $designation = mysql_prep($_POST["designation"]);
        $organization = mysql_prep($_POST["organization"]);
        $phone = mysql_prep($_POST["phone"]);
        $email = mysql_prep($_POST["email"]);
        $address = null;
        if(isset($_POST["address"])) {
            $address = mysql_prep($_POST["address"]);
        }
        $concerned_lab = mysql_prep($_POST["concerned_lab"]); 
        $customer_type = mysql_prep($_POST["customer_type"]); 
        $sample_type = mysql_prep($_POST["sample_type"]);
        $lab = mysql_prep($_POST["lab"]);
        $tests=$_POST['tests'];

        if ($tests)
        {
            foreach ($tests as $test)
            {
                $all_tests[]=$test;
            }
        }
      $no_of_tests = count($all_tests);
      $tensile_strength_test=0;
      $tear_strength_test=0;
      $color_fastness_to_crocking_test=0;
      $payment=0;
      
      if(in_array("tensile_strength",$all_tests)){
          $tensile_strength_test=1;
          $test = find_test_by_name("Tensile Strength");
          if(isset($test)){
              $payment +=$test["price"];
          }
      }
      if(in_array("tear_strength",$all_tests)){
          $tear_strength_test=1;
          $test = find_test_by_name("Tearing Strength by Elmendorf Tester");
          if(isset($test)){
              $payment +=$test["price"];
          }
      }
      if(in_array("color_fastness_to_crocking",$all_tests)){
          $color_fastness_to_crocking_test=1;
           $test = find_test_by_name("Color Fastness to Crocking");
          if(isset($test)){
              $payment +=$test["price"];
          }
      }
      else{
       // validation pending for other tests   
      }

      if($customer_type=="academic commercial"){
          // 50 percent off for academic commercials
          $payment = (50/100) * $payment;
      }
      
        
    $query  = "INSERT INTO commercial_customers (";
    $query .= "  customer_id, name, city, designation, organization, phone, email, address ";
    $query .= ") VALUES (";
    $query .= "  '{$customer_id}', '{$c_name}', '{$city}', '{$designation}', '{$organization}', '{$phone}', '{$email}', '{$address}'";
    $query .= ")";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_affected_rows($connection) == 1) {
        // Now upto this point customer record inserted

        $second_query = "INSERT INTO samples (";
        $second_query .= "  sample_id, customer_id, expected_date, concerned_lab, sample_type, no_of_tests, lab, tensile_strength_test, tear_strength_test, color_fastness_to_crocking_test, type, payment, status ";
        $second_query .= ") VALUES (";
        $second_query .= "  '{$sample_id}', '{$customer_id}', '{$expected_date}', '{$concerned_lab}', '{$sample_type}', {$no_of_tests}, '{$lab}', {$tensile_strength_test}, {$tear_strength_test}, {$color_fastness_to_crocking_test}, '{$customer_type}', '{$payment}', 'submitted' ";
        $second_query .= ")";
        $second_result = mysqli_query($connection, $second_query);
        if ($second_result && mysqli_affected_rows($connection) == 1) {
//      $_SESSION["message"] = "User created.";
            redirect_to("view_sample_record.php?customer_id=$customer_id");
        }
        else{
            $_SESSION["message"] = "Sample Submission failed.";
        }
    }
    else {
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
        <title>NTRC Testing Request Form</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/default.css"/>
       
    </head>
    
    <body>  
        <header>
            <h1>LIMS</h1>
            <nav style="padding-left:220px">
              <a href="home.php">Home</a>
              <a href="faq.php#barchart">Help</a>
              <a href="reception.php">Reception</a>
              <a href="reception.php">Records Panel</a>    
              <a class="logoutbtn" href="logout.php" style="float:right; margin-right:25px;">log out</a>    
            </nav>
        </header>
        <?php echo message(); ?>
        <?php echo form_errors($errors); ?>
        <form action="Commercial_Testing_Request_Form.php" class="register" method="post">
            <h1 id="first-heading">Commercial Testing Request Form</h1>
            <fieldset class="row1">
<!--
                <legend>Details
                </legend>
-->
                <p>
                    <label for="submiited_date">Date *
                    </label>
                    <input id="submitted_date" name="submitted_date" type="date"/>
                    <label for="expected_date">Expected Date *
                    </label>
                    <input id="expected_date" name="expected_date" type="date" required/>
                </p>
                <p>
                    <label for="no_of_tests">No. of tests&nbsp;
                    </label>
                    <input id="no_of_tests" name="no_of_tests" type="number" value=""/>
                    <label class="obinfo">* obligatory fields
                    </label>
                </p>
            </fieldset>
            <fieldset class="row2">
                <legend>Personal Details
                </legend>
                <p>
                    <label for="cname">Name *
                    </label>
                    <input id="cname" name="cname" type="text" value="<?php echo $c_name;?>" class="long" required/>
                </p>
                <p>
                    <label for="city">City *
                    </label>
                    <input id="city" name="city" type="text" value="<?php echo $city;?>" required/>
                </p>
                <p>
                    <label for="designation">Designation *
                    </label>
                    <select id="designation" name="designation" required>
                        <option value="" <?php if($designation==="") echo "selected";?>>Choose...</option>
                        <option value="CEO" <?php if($designation==="CEO") echo "selected";?>>CEO
                        </option>
                        <option value="G.M" <?php if($designation==="G.M") echo "selected";?>>GM
                        </option>
                        <option value="Manager" <?php if($designation==="Manager") echo "selected";?>>Manager
                        </option>
                        <option value="Lecturar" <?php if($designation==="Lecturar") echo "selected";?>>Lecturar
                        </option>
                        <option value="Professor" <?php if($designation==="Professor") echo "selected";?>>Professor
                        </option>
                        <option value="Q.S" <?php if($designation==="Q.S") echo "selected";?>>QS
                        </option>
                        <option value="P.M" <?php if($designation==="P.M") echo "selected";?>>Project Manager
                        </option>
                        <option value="Employee" <?php if($designation==="Employee") echo "selected";?>>Employee
                        </option>
                        <option value="Student" <?php if($designation==="Student") echo "selected";?>>Student
                        </option>
                    </select>
                </p>
                <p>
                    <label for="organization">Organization *
                    </label>
                    <input id="organization" name="organization" type="text" class="long" value="<?php echo $organization;?>" required/>
                </p>
                <p>
                    <label for="phone">Phone *
                    </label>
                    <input id="phone" name="phone" type="text" class="long" value="<?php echo $phone;?>" required/>
                </p>
                <p>
                    <label for="email">Email *
                    </label>
                    <input id="email" name="email" class="long" type="email" value="<?php echo $email;?>" required/>

                </p>
                 <p>
                  <label for="address">Address&nbsp;&nbsp;</label>
                  <textarea id="address" name="address" placeholder="Write address"><?php echo $address;?></textarea>
                 </p>
                <a style="margin-left: 205px;" href="Commercial_Testing_Request_Form.php?prev_record=1">Insert the previous record</a>
            </fieldset>
            <fieldset class="row3">
                <legend>Sample Information
                </legend>
<!--
                <p>
                    <label>Gender *</label>
                    <input type="radio" value="radio"/>
                    <label class="gender">Male</label>
                    <input type="radio" value="radio"/>
                    <label class="gender">Female</label>
                </p>
-->
                 <p>
                    <label class="left">Concerned Lab *
                    </label>
                    <input id="physical" name="concerned_lab" type="radio" value="Physical" checked/>
                    <label class="labs" for="physical">Physical</label>
                    <input id="chemical" name="concerned_lab" type="radio" value="Chemical"/>
                    <label class="labs" for="chemical">Chemical</label>
                   
                </p>
                <p class="chk"> <input type="radio" id="product_dev" name="concerned_lab" value="Product dev" />
                    <label for="product_dev" class="labs">Product dev</label>
                    <input type="radio" id="analytical" name="concerned_lab" value="Analytical" />
                    <label class="labs" for="analytical">Analytical</label>
                </p>
                
                 <p>
                    <label for="customer_type">Customer Type*
                    </label>
                    <select id="customer_type" name="customer_type" required>
                    <option selected value="">Choose...</option>
                       
                        <option value="commercial" selected>Commercial
                        </option>
                        <option value="academic commercial">Academic Commercial
                        </option>
                    </select>
                    
                </p>
                
                <p>
                    <label class="left-allign" for="sample_type">Sample Types*
                    </label>
                    <select id="sample_type" name="sample_type" required>
                        <option selected="selected" value="">Choose...
                        </option>
                        <option value="Fabric">Fabric
                        </option>
                        <option value="Fiber">Fiber
                        </option>
                        <option value="Film">Film
                        </option>
                        <option value="Liquid">Liquid
                        </option>
                        <option value="Powder">Powder
                        </option>
                        <option value="Non-wooven">Non-wooven
                        </option>
                        <option value="Nano-Fibres">Nano-Fibers
                        </option>
                        <option value="Yarn">Yarn
                        </option>
                        <option value="Coating">Coating
                        </option>
                        <option value="Garments">Garments
                        </option>
                        <option value="Miscelleneous">Miscelleneous
                        </option>
                    </select>
                </p>
                <p>
                    <label for="lab">Lab *
                    </label>
                    <select id="lab" name="lab" required>
                    <option selected value="">Choose...</option>
                        <option value="mechanical" selected>Mechanical
                        </option>
                        <option value="spectroscopy">Spectroscopy
                        </option>
                        <option value="comfort">Comfort
                        </option>
                    </select>
                    
                </p>
                <p> <label for="last">Tests*
                    </label>
                    <select id="last" name="tests[]" multiple required>
                        <option disabled>Choose...</option>
                        <option value="tensile_strength">Tensile Strength
                        </option>
                        <option value="tear_strength">Tear Strength
                        </option>
                        <option value="color_fastness_to_crocking">Color Fastness to Crocking
                        </option>
                        <option value="1">Steam Strength of Jute bag
                        </option>
                        <option value="2">Breaking Strength by Strip method
                        </option>
                        <option value="3">Color Fastness to light
                        </option>
                        <option value="4">Color Fastness to Dry Cleaning
                        </option>
                        <option value="5">Color Fastness to Crocking
                        </option>
                        <option value="5">Color Fastness to Crocking
                        </option>
                       
                    </select>
                </p>
                <!--<p> <label style="font-weight:600;">Payment *
                    </label>
                    <input type="text" required/>
                    <button style="width:80px;height:22px;border-radius:15px;border: 1px solid #555;">Calculate</button>
                </p>-->
            </fieldset>
            <fieldset class="row4" style="margin-top:-25px;">
                <legend>Terms and Mailing
                </legend>
                <p class="agreement">
                    <input id="send_email" name="send_email" type="checkbox" value="" checked/>
                    <label for="send_email">Send an email to customer</label>
                </p>
                <p class="agreement">
                    <input type="checkbox" value=""/>
                    <label>Send SMS to customer</label>
                </p>
                
            </fieldset>
            <div><button class="button" type="button" onclick="location.href='reception.php';" name="cancel">Cancel &raquo;</button></div>
            <div><button class="button submitbtn" type="submit" name="submit">Submit &raquo;</button></div>
            
        </form>
        <div id="footer">
  <p>&copy; <a href="http://www.ntu.edu.com" title="National textile University" target="_blank">NTU</a> | follow us on Twitter! <a href="https://twitter.com/NTUOfficial" title="Follow us on Twitter">@NTUOfficial</a> 
  <br>For additional information. please visit the main or about page</p>
  </div>
    </body>
</html>
<?php if (isset($connection)) {
    mysqli_close($connection);
} ?>




