<?php require_once("../includes/session.php");?>
<?php require_once("../includes/db_connection.php");?>
<?php require_once("../includes/functions.php");?>
<?php
$tests = "";
if(isset($_GET['customer_id'])){
   $customer =get_customer_by_id($_GET['customer_id']);
   if(!$customer){
       $_SESSION["message"] = "Customer ID doesn't exist.";
   }
   // now gather the name of tests of this sample in string
   if(isset($customer)){
       if($customer['tensile_strength_test']){$tests .= "Tensile Strength, "; }
       if($customer['tear_strength_test']){$tests .= "Tear Strength, "; }
       if($customer['color_fastness_to_crocking_test']){$tests .= "Color Fastness to Crocking, "; }
       $tests = substr($tests,0,strlen($tests)-2);
   }
}
elseif(isset($_POST['customer_id'])){
    $customer =get_customer_by_id($_POST['customer_id']);
    if(!$customer){
        $_SESSION["message"] = "Customer ID doesn't exist.";
    }
    // now gather the name of tests of this sample in string
    if(isset($customer)){
        if($customer['tensile_strength_test']){$tests .= "Tensile Strength, "; }
        if($customer['tear_strength_test']){$tests .= "Tear Strength, "; }
        if($customer['color_fastness_to_crocking_test']){$tests .= "Color Fastness to Crocking, "; }
        $tests = substr($tests,0,strlen($tests)-2);
    }
}
else{
    $_SESSION["message"] = "Search by Customer ID to find the sample details";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/view_sample_record_styles.css">
    <title>View Sample Record</title>
</head>
<body>

<nav class="navbar fixed-top navbar-light bg-faded navbar-toggleable-sm">
    <div class="container">
        <h1 class="navbar-brand mb-0 mr-5">National Textile Research Center</h1>
        <div class="navbar-nav mr-auto">
            <a class="nav-item nav-link active" href="home.php">Home</a>
            <a class="nav-item nav-link" href="faq.php">Help</a>
            <a class="nav-item nav-link" href="reception.php">Reception</a>
            <a class="nav-item nav-link" href="logout.php">Log Out</a>
        </div><!-- navbar-nav -->
        <form action="view_sample_record.php" method="post" class="form-inline">
            <input class="form-control" name="customer_id" type="search" placeholder="Search by Customer ID">
            <button class="btn btn-info" type="submit">Go</button>
        </form>

    </div><!-- container -->
</nav>
<?php echo message(); ?>

<?php if(isset($customer)) {?>
<!--     Code for displaying modal-->
    <div class="modal fade" id="confirmation_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Do you want to delete this sample?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div> <!-- modal-header -->
                <div class="modal-body">
                    <p>Warning!! Deleting sample will delete all the customer
                        and sample information from the record. Click Yes to delete and No to cancel.</p>
                </div>  <!-- modal-body -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-secondary" href="delete_commercial_testing_request_form.php?customer_id=<?php echo $customer['customer_id'];?>">Yes</a>
                </div>
            </div> <!-- modal-content -->
        </div> <!-- modal-dialog -->
    </div> <!-- modal -->

<div class="container" style="margin-top: 90px;margin-bottom: 200px;">

    <h2 class="text-md-center mb-3">Sample Record Details</h2>
    <div class="row">
    <div class="col settings_box">
        <span>Sample Record</span>
        <a class="btn btn-success" href="send_email.php?customer_id=<?php echo $customer['customer_id'];?>">Send Email</a>
        <a class="btn btn-danger" data-toggle="modal" href="#confirmation_modal">Delete</a>
        <a class="btn btn-primary" href="edit_commercial_testing_request_form.php?customer_id=<?php echo $customer['customer_id'];?>">Edit</a>
    </div>
    </div>
    <div class="row" style="border:2px solid black; border-top: none; background-color:snow">
         <div class="row pt-3" style="padding-left: 150px;">
            <div class="col-3 font-weight-bold text-primary">Customer ID</div>
            <div class="col-3"><?php echo $customer['customer_id']?></div>
            <div class="col-3 font-weight-bold">Name</div>
            <div class="col-3"><?php echo $customer['name']?></div>
            <div class="col-3 font-weight-bold">City</div>
            <div class="col-3"><?php echo $customer['city']?></div>
            <div class="col-3 font-weight-bold">Designation</div>
            <div class="col-3"><?php echo $customer['designation']?></div>
            <div class="col-3 font-weight-bold">Organization</div>
            <div class="col-3"><?php echo $customer['organization']?></div>
            <div class="col-3 font-weight-bold">Phone</div>
            <div class="col-3"><?php echo $customer['phone']?></div>
            <div class="col-3 font-weight-bold">Email</div>
            <div class="col-3"><?php echo $customer['email']?></div>
            <div class="col-3 font-weight-bold">Address</div>
            <div class="col-3"><?php echo $customer['address']?></div>
        </div>

        <div class="row pt-5 pb-3" style="padding-left: 150px;">
            <div class="col-3 font-weight-bold text-primary">Sample ID</div>
            <div class="col-3"><?php echo $customer['sample_id']?></div>
            <div class="col-3 font-weight-bold">Creation time</div>
            <div class="col-3"><?php echo $customer['timestamp']?></div>
            <div class="col-3 font-weight-bold">Expected Date</div>
            <div class="col-3"><?php echo $customer['expected_date']?></div>
            <div class="col-3 font-weight-bold">Customer type</div>
            <div class="col-3"><?php echo $customer['type']?></div>
            <div class="col-3 font-weight-bold">Concerned Lab</div>
            <div class="col-3"><?php echo $customer['concerned_lab']?></div>
            <div class="col-3 font-weight-bold">Lab</div>
            <div class="col-3"><?php echo $customer['lab']?></div>
            <div class="col-3 font-weight-bold">Sample Type</div>
            <div class="col-3"><?php echo $customer['sample_type']?></div>
            <div class="col-3 font-weight-bold">No. of tests</div>
            <div class="col-3"><?php echo $customer['no_of_tests']?></div>
            <div class="col-3 font-weight-bold">Tests</div>
            <div class="col-3"><?php echo $tests?></div>
            <div class="col-3 font-weight-bold text-primary">Payment</div>
            <div class="col-3"><?php echo $customer['payment']?></div>
            <div class="col-3 font-weight-bold text-primary">Status</div>
            <div class="col-3"><?php echo $customer['status']?></div>
            <div class="col-3 font-weight-bold">Finished Date</div>
            <div class="col-3"><?php echo $customer['finished_date']?></div>
        </div>

    </div>
    <div class="row ">
        <div class="col receipt_box">

           <a class="btn btn-primary" href="receipt_content.php?customer_id=<?php echo $customer['customer_id']; ?>" target="_blank">View Receipt</a>
            <a class="btn btn-primary" href="customer_sample_receipt.php?customer_id=<?php echo $customer['customer_id']; ?>" target="_blank">Print Receipt</a>
        </div>
    </div>

</div><!-- content container -->
<?php }?>

<footer class="footer">
        <p>&copy; <a href="http://www.ntu.edu.com" title="National textile University" target="_blank">NTU</a> | follow us on Twitter! <a href="https://twitter.com/NTUOfficial" title="Follow us on Twitter">@NTUOfficial</a>
            <br>For additional information. please visit the main or about page</p>
</footer>


<script src="js/jquery.slim.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/scripts.js"></script>
</body>
</html>
<?php if (isset($connection)) {
    mysqli_close($connection);
}?>