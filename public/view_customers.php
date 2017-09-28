<?php require_once("../includes/session.php");?>
<?php require_once("../includes/db_connection.php");?>
<?php require_once("../includes/functions.php");?>
<?php
$result = NULL;
if(isset($_POST['sub'])){


        $st = $db->prepare('Select * from applications where program=? ORDER BY aggregiate DESC LIMIT 10');

        $st->execute(array($_POST['uni']));
        $all = $st->fetchAll();
        if(!$all){
            header("Location:" . rawurlencode("index.php") . "?err=" .
                urlencode("Query Failed"));
            exit();
        }
        if(count($all)==0){
            header("Location:" . rawurlencode("index.php") . "?err=" .
                urlencode("Students Record not exists"));
            exit();
        }
        else{
            $result = "<table id=\"courses\" class=\"focus-highlight\">
				<thead>
					<tr>
                        <th>Applicant ID</th>
						<th>Name</th>
						<th>Father</th>
						<th>Aggregiate</th>
					</tr>
				</thead>
				<tbody>";

            foreach($all as $rec){
                $result  = $result . "<tr>";
                $result  = $result . "<td>" . $rec['id'] ."</td>";
                $result  = $result . "<td>" . $rec['name'] ."</td>";
                $result  = $result . "<td>" . $rec['father'] ."</td>";
                $result  = $result . "<td>" . $rec['aggregiate'] ."</td>";
                $result  = $result . "</tr>";
            }
            $result  = $result . "</tbody>";
            $result  = $result . " <tfoot>
					<tr>
						<td colspan=\"4\">
							<p>Errors and Omissions are accepted. For more information, Visit the NTU main page <a href=\"http://ntu.edu.pk\" target=\"_blank\">NTU</a></p>
						</td>
					</tr>
				</tfoot>";
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
    <title>Customers Record</title>
    <link rel="stylesheet" type="text/css" href="css/css_table_design.css">
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/jquery.tablesorter.js"></script>
    <script type="text/javascript" src="js/table_sorter.js"></script>
</head>
<body>
<header>
    <h1>Customers Record</h1>
</header>
<article>
    <h2>Select the option to filter the merit list</h2>
    <marquee>The first merit list is released while the second merit list will be released on Jan 29, 2017</marquee>
    <div id="first_block">
        <form id="first_form" action="view_customers.php" method="post">

            <label for="uni_sel">Select Course</label>
            <select id="uni_sel" name="uni" required>
                <option value="" selected>Select Course</option>
                <option value="cs" >Computer Science</option>
                <option value="soft" >Software Engineering</option>
                <option value="tex">Textile Engineering</option>
                <option value="pol">Polymer Engineering</option>
                <option value="bba">BBA</option>
                <option value="knit">Knitting</option>

            </select>

            <label for="uni_list">Select Merit List</label>
            <select id="uni_list" name="list" required>
                <option value="" selected>Select Merit List</option>
                <option value="ist" >Ist Merit List</option>
                <option value="sec" >2nd Merit List</option>
                <option value="third">3rd Merit List</option>

            </select>

            <button type="submit" name="sub">Filter</button>

        </form>

    </div>
    <?php
    if($result){
        echo $result;
    }
    if(isset($_GET['err'])){
        echo $_GET['err'];
    }
    ?>

</article>
</body>
</html>