<?php require_once("../includes/session.php");?>
<?php require_once("../includes/db_connection.php");?>
<?php require_once("../includes/functions.php");?>
<?php
$result = NULL;
$query_info = NULL;
if(isset($_POST['sub'])){
    // Initializing variables to use in reporting form at the bottom of the page
    $type = $_POST['type'];
    $starting_date = "";
    $ending_date = "";
    $quantity = "";

    $query  = "SELECT * ";
    $query .= "FROM commercial_customers, samples ";
    $query .= "WHERE commercial_customers.customer_id=samples.customer_id ";
    $query .= "AND type='{$type}' ";


    if(!empty($_POST['starting_date']) && !empty($_POST['ending_date'])){
        $starting_date = date("Y-m-d", strtotime($_POST['starting_date']));
        $ending_date = date("Y-m-d", strtotime($_POST['ending_date']));
        $query .= "AND creation_time BETWEEN '$starting_date' AND '$ending_date' + INTERVAL 1 DAY ";
    }
    elseif (!empty($_POST['starting_date'])){
        $starting_date = date("Y-m-d", strtotime($_POST['starting_date']));
        $query .= "AND creation_time >= '$starting_date' ";
    }
    elseif (!empty($_POST['ending_date'])){
        $ending_date = date("Y-m-d", strtotime($_POST['ending_date']));
        $query .= "AND creation_time <= '$ending_date' + INTERVAL 1 DAY ";
    }
    else{
        // do nothing
    }
    if(isset($_POST["quantity"])){
        $quantity =$_POST["quantity"];
        if($_POST["quantity"]!=="all"){
            $query .= "LIMIT {$quantity}";
        }
    }
    $query_info = "<b>Result:</b> " . strstr($query,"type");
    $customer_set = mysqli_query($connection, $query);
    confirm_query($customer_set);
    if(mysqli_num_rows($customer_set)>0) {
        $selected_customers = mysqli_num_rows($customer_set);
        $result = "<table id=\"customers\" class=\"focus-highlight\">
				<thead>
					<tr>
                        <th>ID</th>
						<th>Name</th>
						<th>City</th>
						<th>Organization</th>
						<th>Designation</th>
						<th>Phone</th>
						<th>Email</th>
						
					</tr>
				</thead>
				<tbody>";

        foreach($customer_set as $cus){
            $result  = $result . "<tr>";
            $result  = $result . "<td>" . $cus['id'] ."</td>";
            $result  = $result . "<td>" . $cus['name'] ."</td>";
            $result  = $result . "<td>" . $cus['city'] ."</td>";
            $result  = $result . "<td>" . $cus['organization'] ."</td>";
            $result  = $result . "<td>" . $cus['designation'] ."</td>";
            $result  = $result . "<td>" . $cus['phone'] ."</td>";
            $result  = $result . "<td>" . $cus['email'] ."</td>";
            $result  = $result . "</tr>";
        }
//      Displaying count
        $total_customers = "Select COUNT(*) FROM commercial_customers, samples WHERE commercial_customers.customer_id=samples.customer_id";
        $total = mysqli_query($connection, $total_customers);
        confirm_query($total);
        if($count_value = mysqli_fetch_row($total)) {
            $no_of_customers = $count_value[0];
        }
        else{
            $no_of_customers = 0;
        }

//      Closing Table
        $result  = $result . "</tbody>";
        $result  = $result . " <tfoot>
                   
					<tr>
						<td colspan='7' >
						<p class='show_count'>
                        {$selected_customers} Customers selected out of {$no_of_customers} </p>
							<p>For more information, Visit the <a href=\"view_sample_record.php\" target=\"_blank\">View Customer Record</a> Page.</p>
						</td>
					</tr>
				</tfoot>";
    }
    elseif (mysqli_num_rows($customer_set)==0){
        redirect_to(rawurlencode("view_customers.php") . "?err=" .
            urlencode("Customers Record does not exist"));
    }
    else {
        redirect_to(rawurlencode("view_customers.php") . "?err=" .
            urlencode("Customers Record does not exist"));
    }


    }


?>

<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Commercial Customers Record</title>
    <link rel="stylesheet" type="text/css" href="css/css_table_design.css">
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/jquery.tablesorter.js"></script>
    <script type="text/javascript" src="js/table_sorter.js"></script>
</head>
<body>
<header>
    <h1>Commercial Customers Record</h1>
</header>
<article>
    <h2>Select the option to filter the commercial and academic-commercial customers</h2>
    <marquee>This list contains the record of commercial or academic customers depending upon selected customer types</marquee>
    <div id="first_block">
        <form id="first_form" action="view_customers.php" method="post">
            <p>
            <label for="uni_sel">Select Customers</label>
            <select id="uni_sel" name="type" required>
                <option value="" selected>Select Customer Type</option>
                <option value="commercial">Commercial</option>
                <option value="academic commercial" >Academic Commercial</option>
            </select>

            <label for="uni_list">Select Quantity</label>
            <select id="uni_list" name="quantity">
                <option value="" selected disabled>Select Quantity</option>
                <option value="1" >1</option>
                <option value="10" >10</option>
                <option value="25" >25</option>
                <option value="50" >50</option>
                <option value="100" >100</option>
                <option value="200" >200</option>
                <option value="300">300</option>
                <option value="400" >400</option>
                <option value="500" >500</option>
                <option value="1000">1000</option>
                <option value="2000">2000</option>
                <option value="all">All</option>

            </select>
            </p>
            <p>
            <label for="starting_date" id="start_label">Select Since</label>
            <input type="date" name="starting_date" id="starting_date">

            <label for="ending_date" id="end_label">Select Until</label>
            <input type="date" name="ending_date" id="ending_date">
            </p>

            <button type="submit" name="sub">Filter</button>

        </form>

    </div>
    <?php
        if($query_info){
            echo "<div style='margin-bottom: 15px; text-align: center; font-size: 18px;'>{$query_info}</div>";
        }
        if($result){
            echo $result;
    ?>
     <form id="second_form" action="generate_commercial_customers_report.php" method="post">
         <input type="hidden" name="type" value="<?php echo $type;?>">
         <input type="hidden" name="quantity" value="<?php echo $quantity; ?>">
         <input type="hidden" name="starting_date" value="<?php echo $starting_date;?>">
         <input type="hidden" name="ending_date" value="<?php echo $ending_date;?>">
         <input type="submit" name="generate_report" id="generate_report" value="Generate Report">
     </form>
     <?php
    }
        if(isset($_GET['err'])){
            echo "<div class=message>" . $_GET['err'] . "</div>";
        }
    ?>

</article>
</body>
</html>
<?php
// 5. Close database connection
if (isset($connection)) {
    mysqli_close($connection);
}
if(isset($customer_set)){
    mysqli_free_result($customer_set);
}
?>