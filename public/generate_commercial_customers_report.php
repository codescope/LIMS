<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once ("../includes/FPDF/fpdf.php")?>
<?php
class PDF extends FPDF{
    function Header(){

        // with the word sample receipt written
        $this->SetFont('Arial','B',17);
        $this->Cell(43);
        $this->Image('images/ntrc.png',15,10,25,20);
        $this->Cell(100,20,'National Textile Research Center',0,0,'C');
        $this->Image('images/ntu.jpg',165,10,25,20);
        $this->Cell(0,15,'',0,1);
        // dummy cell at the bottom of pic
        $this->Cell(43,5,'',0,0);
        $this->SetFont('Arial','',10);
        $this->Cell(100,5,'Commercial Customers Report',0,1,'C');
        $this->Ln(6);
    }

}
if(isset($_POST['generate_report'])) {
    // Initializing variables to use in reporting form at the bottom of the page
    $type = $_POST['type'];
    $starting_date = "";
    $ending_date = "";
    $quantity = "";

    $query = "SELECT * ";
    $query .= "FROM commercial_customers, samples ";
    $query .= "WHERE commercial_customers.customer_id=samples.customer_id ";
    $query .= "AND type='{$type}' ";


    if (!empty($_POST['starting_date']) && !empty($_POST['ending_date'])) {
        $starting_date = date("Y-m-d", strtotime($_POST['starting_date']));
        $ending_date = date("Y-m-d", strtotime($_POST['ending_date']));
        $query .= "AND creation_time BETWEEN '$starting_date' AND '$ending_date' + INTERVAL 1 DAY ";
    } elseif (!empty($_POST['starting_date'])) {
        $starting_date = date("Y-m-d", strtotime($_POST['starting_date']));
        $query .= "AND creation_time >= '$starting_date' ";
    } elseif (!empty($_POST['ending_date'])) {
        $ending_date = date("Y-m-d", strtotime($_POST['ending_date']));
        $query .= "AND creation_time <= '$ending_date' + INTERVAL 1 DAY ";
    } else {
        // do nothing
    }
    if (isset($_POST["quantity"]) && !empty($_POST["quantity"])) {
        $quantity = $_POST["quantity"];
        if ($_POST["quantity"] !== "all") {
            $query .= "LIMIT {$quantity}";
        }
    }
    $customer_set = mysqli_query($connection, $query);
    confirm_query($customer_set);
    if(mysqli_num_rows($customer_set)>0) {
        $selected_customers = mysqli_num_rows($customer_set);
        $pdf = new PDF('p','mm','A4');
        $pdf->AddPage();
        // below header content
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(29,8,' Customers Type: ',0,0);
        $pdf->Cell(99,8, ucwords($type),0,0);
        $pdf->Cell(60,8,' Selected Customers: '. $selected_customers,0,1);
        if(isset($_POST['starting_date'])) {
            if (!empty($_POST['starting_date'])) {
                $pdf->Cell(24, 8, ' Starting Date: ', 0, 0);
                $pdf->Cell(104, 8, $starting_date, 0, 0);
            }
            else{
                $pdf->Cell(24, 8, ' Starting Date: ', 0, 0);
                $pdf->Cell(104, 8, 'N/A', 0, 0);
            }
        }
        if(isset($_POST['ending_date'])) {
            if (!empty($_POST['ending_date'])) {
                    $pdf->Cell(60, 8, ' Ending Date: ' . $ending_date, 0, 1);
            }
            else {
                    $pdf->Cell(60, 8, ' Ending Date: N/A', 0, 1);
            }
        }
        if(isset($_POST['quantity'])) {
            if (!empty($_POST['quantity'])) {
                if ($_POST["quantity"] !== "all") {
                    $pdf->Cell(70, 8, ' Constraint: Limit ' . $quantity, 0, 1);
                }
                else{
                    $pdf->Cell(70,8,' Constraint: N/A',0,1);
                }
            }
            else {
                $pdf->Cell(70,8,' Constraint: N/A',0,1);
            }
        }

        //dump empty cell as a vertical spacer
        $pdf->Cell(189,3,'',0,1);
        $pdf->Output();

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
else{
    redirect_to(rawurlencode("view_customers.php") . "?err=" .
        urlencode("Customers Record does not exist"));
}