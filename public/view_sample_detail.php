<?php require_once("../includes/session.php");?>
<?php require_once("../includes/db_connection.php");?>
<?php require_once("../includes/functions.php");?>
<?php
if(isset($_GET['sample_id'])&&isset($_GET['test_name'])) {
    if ($_GET['test_name'] === "tensile_test") {
        $test = $_GET['test_name'];
        $sample = get_tensile_test_by_id($_GET['sample_id']);
        if (!$sample) {
            redirect_to("lab_manager.php");
        }

    }
    elseif ($_GET['test_name'] === "tear_test") {
        $test = $_GET['test_name'];
        $sample = get_tear_test_by_id($_GET['sample_id']);
        if (!$sample) {
            redirect_to("lab_manager.php");
        }

    }
    elseif ($_GET['test_name'] === "crocking_test") {
        $test = $_GET['test_name'];
        $sample = get_crocking_test_by_id($_GET['sample_id']);
        if (!$sample) {
            redirect_to("lab_manager.php");
        }

    }
    elseif ($_GET['test_name'] === "bursting_test") {
        $test = $_GET['test_name'];
        $sample = get_bursting_test_by_id($_GET['sample_id']);
        if (!$sample) {
            redirect_to("lab_manager.php");
        }

    }
    else{
        redirect_to("lab_manager.php");
    }
}
else{
    redirect_to("lab_manager.php");
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
        <title>View Sample Detail</title>
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
                <input class="form-control" name="sample_id" type="search" placeholder="Search by sample ID">
                <button class="btn btn-info" type="submit">Go</button>
            </form>

        </div><!-- container -->
    </nav>
    <?php echo message(); ?>

    <?php if(isset($sample) && $test==="tensile_test") {?>
        <!--     Code for displaying modal-->
        <div class="modal fade" id="confirmation_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Do you want to delete this sample?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div> <!-- modal-header -->
                    <div class="modal-body">
                        <p>Warning!! Deleting sample will delete all the sample
                            and sample information from the record. Click Yes to delete and No to cancel.</p>
                    </div>  <!-- modal-body -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-secondary" href="delete_commercial_testing_request_form.php?sample_id=<?php echo $sample['sample_id'];?>">Yes</a>
                    </div>
                </div> <!-- modal-content -->
            </div> <!-- modal-dialog -->
        </div> <!-- modal -->

        <div class="container" style="margin-top: 90px;margin-bottom: 200px;">

            <h2 class="text-md-center mb-3">Sample Test Details</h2>
            <div class="row">
                <div class="col settings_box" style="background-color: #464a4c">
                    <span style="color: white">Tensile Test Results</span>

                    <a class="btn btn-success" data-toggle="modal" href="#confirmation_modal">Confirm</a>
                    <a class="btn btn-info" href="edit_tensile_strength_test.php?sample_id=<?php echo $sample['sample_id'];?>">Edit</a>
                </div>
            </div>
            <div class="row" style="border:2px solid black; border-top: none; border-radius:0 0 30px 30px; background-color:snow">

                <div class="row pt-3" style="padding-left: 100px;">
                    <div class="col-12 pb-2"><h4 style="font-family: 'Caveat', cursive; color: #66512c">Sample Details:</h4></div>
                    <div class="col-3 font-weight-bold text-primary">Sample ID</div>
                    <div class="col-3"><?php echo $sample['sample_id']?></div>
                    <div class="col-3 font-weight-bold text-primary">Status</div>
                    <div class="col-3"><?php echo $sample['status']?></div>
                    <div class="col-3 font-weight-bold">Creation Time</div>
                    <div class="col-3"><?php echo $sample['creation_time']?></div>
                    <div class="col-3 font-weight-bold">Sample Description</div>
                    <div class="col-3"><?php echo $sample['sample_description']?></div>
                    <div class="col-3 font-weight-bold">Test Standard</div>
                    <div class="col-3"><?php echo $sample['test_standard']?></div>
                    <div class="col-3">&nbsp;</div>
                    <div class="col-3">&nbsp;</div>
                    <div class="col-3">&nbsp;</div>
                    <div class="col-3">&nbsp;</div>
                    <div class="col-3">&nbsp;</div>
                    <div class="col-3">&nbsp;</div>
                    <div class="col-12 pb-2"><h4 style="font-family: 'Caveat', cursive; color: #66512c">Conditions:</h4></div>
                    <div class="col-3 font-weight-bold">Temperature</div>
                    <div class="col-3"><?php echo $sample['temperature']?> &deg;C</div>
                    <div class="col-3 font-weight-bold">Humidity</div>
                    <div class="col-3"><?php echo $sample['humidity']?> %</div>

                </div>

                <div class="row pt-3 pb-3" style="padding-left: 100px;">
                    <div class="col-12 pb-2"><h4 style="font-family: 'Caveat', cursive; color: #66512c">Test Results:</h4></div>
                    <div class="col-3 font-weight-bold ">Mean Strength Wrap</div>
                    <div class="col-3"><?php echo $sample['mean_strength_wrap']?></div>
                    <div class="col-3 font-weight-bold">C.V.</div>
                    <div class="col-3"><?php echo $sample['first_cv']?></div>
                    <div class="col-3 font-weight-bold">Mean Percent Elongation Wrap</div>
                    <div class="col-3"><?php echo $sample['mean_percent_elongation_wrap']?></div>
                    <div class="col-3 font-weight-bold">C.V.</div>
                    <div class="col-3"><?php echo $sample['sec_cv']?></div>
                    <div class="col-3 font-weight-bold">Mean Strength Weft</div>
                    <div class="col-3"><?php echo $sample['mean_strength_weft']?></div>
                    <div class="col-3 font-weight-bold">C.V.</div>
                    <div class="col-3"><?php echo $sample['third_cv']?></div>
                    <div class="col-3 font-weight-bold">Mean Percent Elongation Weft</div>
                    <div class="col-3"><?php echo $sample['mean_percent_elongation_weft']?></div>
                    <div class="col-3 font-weight-bold">C.V.</div>
                    <div class="col-3"><?php echo $sample['fourth_cv']?></div>

                </div>
                <?php
                $conditions = $sample['test_conditions'];
                if(!empty($conditions)){
                    $output = test_notes($conditions);
                    echo $output;
                }
                ?>

            </div>

        </div><!-- content container -->
    <?php }?>

    <?php if(isset($sample) && $test==="tear_test") {?>
        <!--     Code for displaying modal-->
        <div class="modal fade" id="confirmation_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Do you want to delete this sample?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div> <!-- modal-header -->
                    <div class="modal-body">
                        <p>Warning!! Deleting sample will delete all the sample
                            and sample information from the record. Click Yes to delete and No to cancel.</p>
                    </div>  <!-- modal-body -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-secondary" href="delete_commercial_testing_request_form.php?sample_id=<?php echo $sample['sample_id'];?>">Yes</a>
                    </div>
                </div> <!-- modal-content -->
            </div> <!-- modal-dialog -->
        </div> <!-- modal -->

        <div class="container" style="margin-top: 90px;margin-bottom: 200px;">

            <h2 class="text-md-center mb-3">Sample Test Details</h2>
            <div class="row">
                <div class="col settings_box" style="background-color: #464a4c">
                    <span style="color: white">Tear Test Results</span>

                    <a class="btn btn-success" data-toggle="modal" href="#confirmation_modal">Confirm</a>
                    <a class="btn btn-info" href="edit_tear_strength_test.php?sample_id=<?php echo $sample['sample_id'];?>">Edit</a>
                </div>
            </div>
            <div class="row" style="border:2px solid black; border-top: none; border-radius:0 0 30px 30px;  background-color:snow">

                <div class="row pt-3" style="padding-left: 100px;">
                    <div class="col-12 pb-2"><h4 style="font-family: 'Caveat', cursive; color: #66512c">Sample Details:</h4></div>
                    <div class="col-3 font-weight-bold text-primary">Sample ID</div>
                    <div class="col-3"><?php echo $sample['sample_id']?></div>
                    <div class="col-3 font-weight-bold text-primary">Status</div>
                    <div class="col-3"><?php echo $sample['status']?></div>
                    <div class="col-3 font-weight-bold">Creation Time</div>
                    <div class="col-3"><?php echo $sample['creation_time']?></div>
                    <div class="col-3 font-weight-bold">Sample Description</div>
                    <div class="col-3"><?php echo $sample['sample_description']?></div>
                    <div class="col-3 font-weight-bold">Test Standard</div>
                    <div class="col-3"><?php echo $sample['test_standard']?></div>
                    <div class="col-3">&nbsp;</div>
                    <div class="col-3">&nbsp;</div>
                    <div class="col-3">&nbsp;</div>
                    <div class="col-3">&nbsp;</div>
                    <div class="col-3">&nbsp;</div>
                    <div class="col-3">&nbsp;</div>
                    <div class="col-12 pb-2"><h4 style="font-family: 'Caveat', cursive; color: #66512c">Conditions:</h4></div>
                    <div class="col-3 font-weight-bold">Temperature</div>
                    <div class="col-3"><?php echo $sample['temperature']?> &deg;C</div>
                    <div class="col-3 font-weight-bold">Humidity</div>
                    <div class="col-3"><?php echo $sample['humidity']?> %</div>

                </div>

                <div class="row pt-3 pb-3" style="padding-left: 100px;">
                    <div class="col-12 pb-2"><h4 style="font-family: 'Caveat', cursive; color: #66512c">Test Results:</h4></div>
                    <div class="col-3 font-weight-bold ">Mean Strength Wrap</div>
                    <div class="col-3"><?php echo $sample['mean_strength_wrap']?></div>
                    <div class="col-3 font-weight-bold">C.V.</div>
                    <div class="col-3"><?php echo $sample['first_cv']?></div>
                    <div class="col-3 font-weight-bold">Mean Percent Elongation Wrap</div>
                    <div class="col-3"><?php echo $sample['mean_percent_elongation_wrap']?></div>
                    <div class="col-3 font-weight-bold">C.V.</div>
                    <div class="col-3"><?php echo $sample['sec_cv']?></div>
                    <div class="col-3 font-weight-bold">Mean Strength Weft</div>
                    <div class="col-3"><?php echo $sample['mean_strength_weft']?></div>
                    <div class="col-3 font-weight-bold">C.V.</div>
                    <div class="col-3"><?php echo $sample['third_cv']?></div>
                    <div class="col-3 font-weight-bold">Mean Percent Elongation Weft</div>
                    <div class="col-3"><?php echo $sample['mean_percent_elongation_weft']?></div>
                    <div class="col-3 font-weight-bold">C.V.</div>
                    <div class="col-3"><?php echo $sample['fourth_cv']?></div>

                </div>
                <?php
                $conditions = $sample['test_conditions'];
                if(!empty($conditions)){
                    $output = test_notes($conditions);
                    echo $output;
                }
                ?>

            </div>

        </div><!-- content container -->
    <?php }?>

    <?php if(isset($sample) && $test==="crocking_test") {?>
        <!--     Code for displaying modal-->
        <div class="modal fade" id="confirmation_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Do you want to delete this sample?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div> <!-- modal-header -->
                    <div class="modal-body">
                        <p>Warning!! Deleting sample will delete all the sample
                            and sample information from the record. Click Yes to delete and No to cancel.</p>
                    </div>  <!-- modal-body -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-secondary" href="delete_commercial_testing_request_form.php?sample_id=<?php echo $sample['sample_id'];?>">Yes</a>
                    </div>
                </div> <!-- modal-content -->
            </div> <!-- modal-dialog -->
        </div> <!-- modal -->

        <div class="container" style="margin-top: 90px;margin-bottom: 200px;">

            <h2 class="text-md-center mb-3">Sample Test Details</h2>
            <div class="row">
                <div class="col settings_box" style="background-color: #464a4c">
                    <span style="color: white">Color Fastness to Crocking Test Results</span>

                    <a class="btn btn-success" data-toggle="modal" href="#confirmation_modal">Confirm</a>
                    <a class="btn btn-info" href="edit_color_fastness_to_crocking_or_rubbbing.php?sample_id=<?php echo $sample['sample_id'];?>">Edit</a>
                </div>
            </div>
            <div class="row" style="border:2px solid black; border-top: none; border-radius:0 0 30px 30px;  background-color:snow">

                <div class="row pt-3 pb-3" style="padding-left: 100px;">
                    <div class="col-12 pb-2"><h4 style="font-family: 'Caveat', cursive; color: #66512c">Sample Details:</h4></div>
                    <div class="col-3 font-weight-bold text-primary">Sample ID</div>
                    <div class="col-3"><?php echo $sample['sample_id']?></div>
                    <div class="col-3 font-weight-bold text-primary">Status</div>
                    <div class="col-3"><?php echo $sample['status']?></div>
                    <div class="col-3 font-weight-bold">Creation Time</div>
                    <div class="col-3"><?php echo $sample['creation_time']?></div>
                    <div class="col-3 font-weight-bold">Sample Description</div>
                    <div class="col-3"><?php echo $sample['sample_description']?></div>
                    <div class="col-3 font-weight-bold">Test Standard</div>
                    <div class="col-3"><?php echo $sample['test_standard']?></div>
                    <div class="col-3">&nbsp;</div>
                    <div class="col-3">&nbsp;</div>
                    <div class="col-3">&nbsp;</div>
                    <div class="col-3">&nbsp;</div>
                    <div class="col-3">&nbsp;</div>
                    <div class="col-3">&nbsp;</div>
                    <div class="col-12 pb-2"><h4 style="font-family: 'Caveat', cursive; color: #66512c">Conditions:</h4></div>
                    <div class="col-3 font-weight-bold">Temperature</div>
                    <div class="col-3"><?php echo $sample['temperature']?> &deg;C</div>
                    <div class="col-3 font-weight-bold">Humidity</div>
                    <div class="col-3"><?php echo $sample['humidity']?> %</div>
                    <div class="col-12">&nbsp;</div>
                    <div class="col-12 pb-2"><h4 style="font-family: 'Caveat', cursive; color: #66512c">Test Results:</h4></div>
                    <div class="col-3 font-weight-bold ">Dry</div>
                    <div class="col-3"><?php echo $sample['dry']?></div>
                    <div class="col-3 font-weight-bold">C.V.</div>
                    <div class="col-3"><?php echo $sample['first_cv']?></div>
                    <div class="col-3 font-weight-bold">Wet</div>
                    <div class="col-3"><?php echo $sample['wet']?></div>
                    <div class="col-3 font-weight-bold">C.V.</div>
                    <div class="col-3"><?php echo $sample['second_cv']?></div>

                </div>

                <?php
                $conditions = $sample['test_conditions'];
                if(!empty($conditions)){
                    $output = test_notes($conditions);
                    echo $output;
                }
                ?>

            </div>

        </div><!-- content container -->
    <?php }?>

    <?php if(isset($sample) && $test==="bursting_test") {?>
        <!--     Code for displaying modal-->
        <div class="modal fade" id="confirmation_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Do you want to delete this sample?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div> <!-- modal-header -->
                    <div class="modal-body">
                        <p>Warning!! Deleting sample will delete all the sample
                            and sample information from the record. Click Yes to delete and No to cancel.</p>
                    </div>  <!-- modal-body -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-secondary" href="delete_commercial_testing_request_form.php?sample_id=<?php echo $sample['sample_id'];?>">Yes</a>
                    </div>
                </div> <!-- modal-content -->
            </div> <!-- modal-dialog -->
        </div> <!-- modal -->

        <div class="container" style="margin-top: 90px;margin-bottom: 200px;">

            <h2 class="text-md-center mb-3">Sample Test Details</h2>
            <div class="row">
                <div class="col settings_box" style="background-color: #464a4c">
                    <span style="color: white">Bursting Properties of Fabrics Test Results</span>

                    <a class="btn btn-success" data-toggle="modal" href="#confirmation_modal">Confirm</a>
                    <a class="btn btn-info" href="edit_bursting_properties_of_fabrics.php?sample_id=<?php echo $sample['sample_id'];?>">Edit</a>
                </div>
            </div>
            <div class="row" style="border:2px solid black; border-top: none; border-radius:0 0 30px 30px;  background-color:snow">

                <div class="row pt-3" style="padding-left: 100px;">
                    <div class="col-12 pb-2"><h4 style="font-family: 'Caveat', cursive; color: #66512c">Sample Details:</h4></div>
                    <div class="col-3 font-weight-bold text-primary">Sample ID</div>
                    <div class="col-3"><?php echo $sample['sample_id']?></div>
                    <div class="col-3 font-weight-bold text-primary">Status</div>
                    <div class="col-3"><?php echo $sample['status']?></div>
                    <div class="col-3 font-weight-bold">Creation Time</div>
                    <div class="col-3"><?php echo $sample['creation_time']?></div>
                    <div class="col-3 font-weight-bold">Sample Description</div>
                    <div class="col-3"><?php echo $sample['sample_description']?></div>
                    <div class="col-3 font-weight-bold">Test Standard</div>
                    <div class="col-3"><?php echo $sample['test_standard']?></div>
                    <div class="col-3">&nbsp;</div>
                    <div class="col-3">&nbsp;</div>
                    <div class="col-3">&nbsp;</div>
                    <div class="col-3">&nbsp;</div>
                    <div class="col-3">&nbsp;</div>
                    <div class="col-3">&nbsp;</div>
                    <div class="col-12 pb-2"><h4 style="font-family: 'Caveat', cursive; color: #66512c">Conditions:</h4></div>
                    <div class="col-3 font-weight-bold">Temperature</div>
                    <div class="col-3"><?php echo $sample['temperature']?> &deg;C</div>
                    <div class="col-3 font-weight-bold">Humidity</div>
                    <div class="col-3"><?php echo $sample['humidity']?> %</div>

                </div>

                <div class="row pt-3 pb-3" style="padding-left: 100px;">
                    <div class="col-12 pb-2"><h4 style="font-family: 'Caveat', cursive; color: #66512c">Test Results:</h4></div>
                    <div class="col-3 font-weight-bold ">Mean Burst Strength</div>
                    <div class="col-3"><?php echo $sample['mean_burst_strength']?></div>
                    <div class="col-3 font-weight-bold">C.V.</div>
                    <div class="col-3"><?php echo $sample['first_cv']?></div>
                    <div class="col-3 font-weight-bold">Mean Burst Height</div>
                    <div class="col-3"><?php echo $sample['mean_burst_height']?></div>
                    <div class="col-3 font-weight-bold">C.V.</div>
                    <div class="col-3"><?php echo $sample['sec_cv']?></div>
                    <div class="col-3 font-weight-bold">Test Area</div>
                    <div class="col-3"><?php echo $sample['test_area']?></div>
                    <div class="col-3 font-weight-bold">C.V.</div>
                    <div class="col-3"><?php echo $sample['third_cv']?></div>
                    <div class="col-3 font-weight-bold">Volume Increase Rate</div>
                    <div class="col-3"><?php echo $sample['volume_increase_rate']?></div>
                    <div class="col-3 font-weight-bold">C.V.</div>
                    <div class="col-3"><?php echo $sample['fourth_cv']?></div>
                    <div class="col-3 font-weight-bold">Time to Burst</div>
                    <div class="col-3"><?php echo $sample['time_to_burst']?></div>
                    <div class="col-3 font-weight-bold">C.V.</div>
                    <div class="col-3"><?php echo $sample['fifth_cv']?></div>

                </div>
                <?php
                $conditions = $sample['test_conditions'];
                if(!empty($conditions)){
                    $output = test_notes($conditions);
                    echo $output;
                }
                ?>

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