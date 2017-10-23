<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once ("../includes/FPDF/fpdf.php")?>
<?php
$tests = "";
if(isset($_GET['customer_id'])){
    $customer =get_customer_by_id($_GET['customer_id']);
    if(!$customer){
        $_SESSION["message"] = "Customer ID doesn't exist.";
        redirect_to("view_sample_record.php");
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
        redirect_to("view_sample_record.php");
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
    redirect_to("view_sample_record.php");
}
class PDF extends FPDF{
 function Header(){
     // without the word sample receipt
  /*   $this->SetFont('Arial','B',17);
     $this->Cell(43);
     $this->Image('images/ntrc.png',15,10,25,20);
     $this->Cell(100,20,'National Textile Research Center',1,0,'C');
     $this->Image('images/ntu.jpg',165,10,25,20);
     $this->Cell(0,20,'',0,1);
     $this->Ln(5);*/
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
     $this->Cell(100,5,'Sample Receipt',0,1,'C');
     $this->Ln(6);
 }

}
$pdf = new PDF('p','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','',10);

$pdf->Cell(28,8,' Receiving Date:',0,0);
$pdf->Cell(90,8,$customer['timestamp'],0,0);
$pdf->Cell(70,8,' Customer ID: '. $customer['customer_id'],0,1);
$pdf->Cell(28,8,' Expected Date:',0,0);
$pdf->Cell(90,8,$customer['expected_date'],0,0);
$pdf->Cell(70,8,' Concerned Person: Abdullah',0,1);
$pdf->Cell(118,8,'',0,0);
$pdf->Cell(70,8,' Email: '. $customer['email'],0,1);

//dump empty cell as a vertical spacer
$pdf->Cell(189,3,'',0,1);
// table start
$pdf->Cell(35,8,' Name',1,0);
$pdf->Cell(59,8," ". $customer['name'],1,0);
$pdf->Cell(35,8,' Designation',1,0);
$pdf->Cell(59,8," ". $customer['designation'],1,1);

$pdf->Cell(35,8,' Organization',1,0);
$pdf->Cell(59,8," ". $customer['organization'],1,0);
$pdf->Cell(35,8,' Sample Type',1,0);
$pdf->Cell(59,8," ". $customer['sample_type'],1,1);

$pdf->Cell(35,8,' Concerned lab',1,0);
$pdf->Cell(59,8," ". $customer['concerned_lab'],1,0);
$pdf->Cell(35,8,' No. of tests',1,0);
$pdf->Cell(59,8," ". $customer['no_of_tests'],1,1);

// for multi column
$cellWidth = 59; // wrapped cell width
$cellHeight=8;   // normal one line cell height

// check whether the text is overflowing
if($pdf->GetStringWidth($tests)< $cellWidth){
    $line =1;
    // do nothing
}
else{
    // if content is large then calculate the number of lines to fit the content
    $cellHeight=6; // for multiple lines we can reduce the height of the cells to maintain the structure
    $textLength= strlen($tests);
    $errMargin = 10;
    $startChar = 0;
    $maxChar = 0;
    $textArray = array();
    $tmpString = '';

    while($startChar < $textLength){
        while ($pdf->GetStringWidth($tmpString) < ($cellWidth-$errMargin) &&
            ($startChar+$maxChar)<$textLength){
                $maxChar++;
                $tmpString = substr($tests,$startChar,$maxChar);
        }
        $startChar =$startChar +$maxChar;
        array_push($textArray,$tmpString);
        $maxChar = 0;
        $tmpString = '';
    }
    $line = count($textArray);
}

$pdf->Cell(35,($line*$cellHeight),' Payment(Rs.)',1,0);
$pdf->Cell(59,($line*$cellHeight)," ". $customer['payment'],1,0);
$pdf->Cell(35,($line*$cellHeight),' Tests',1,0);
$pdf->MultiCell(59,$cellHeight,$tests,1);

$pdf->Ln(5);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(35,8,'Receptionist',0,1);
// add dummy cell for a cut-line
$pdf->Cell(0,5,'','B',1);


// for second receipt
// Header of second receipt
$pdf->SetFont('Arial','B',17);
$pdf->Ln(5);
$pdf->Cell(43);
$pdf->Image('images/ntrc.png',15,122,25,20);
$pdf->Cell(100,20,'National Textile Research Center',0,0,'C');
$pdf->Image('images/ntu.jpg',165,122,25,20);
$pdf->Cell(0,15,'',0,1);
// dummy cell at the bottom of pic
$pdf->Cell(43,5,'',0,0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(100,5,'Sample Receipt',0,1,'C');
$pdf->Ln(6);


// below header content
$pdf->SetFont('Arial','',10);
$pdf->Cell(28,8,' Receiving Date:',0,0);
$pdf->Cell(90,8,$customer['timestamp'],0,0);
$pdf->Cell(70,8,' Customer ID: '. $customer['customer_id'],0,1);
$pdf->Cell(28,8,' Expected Date:',0,0);
$pdf->Cell(90,8,$customer['expected_date'],0,0);
$pdf->Cell(70,8,' Concerned Person: Abdullah',0,1);
$pdf->Cell(118,8,'',0,0);
$pdf->Cell(70,8,' Email: '. $customer['email'],0,1);

//dump empty cell as a vertical spacer
$pdf->Cell(189,3,'',0,1);
// table start
$pdf->Cell(35,8,' Name',1,0);
$pdf->Cell(59,8," ". $customer['name'],1,0);
$pdf->Cell(35,8,' Designation',1,0);
$pdf->Cell(59,8," ". $customer['designation'],1,1);

$pdf->Cell(35,8,' Organization',1,0);
$pdf->Cell(59,8," ". $customer['organization'],1,0);
$pdf->Cell(35,8,' Sample Type',1,0);
$pdf->Cell(59,8," ". $customer['sample_type'],1,1);

$pdf->Cell(35,8,' Concerned lab',1,0);
$pdf->Cell(59,8," ". $customer['concerned_lab'],1,0);
$pdf->Cell(35,8,' No. of tests',1,0);
$pdf->Cell(59,8," ". $customer['no_of_tests'],1,1);

// for multi column
$cellWidth = 59; // wrapped cell width
$cellHeight=8;   // normal one line cell height

// check whether the text is overflowing
if($pdf->GetStringWidth($tests)< $cellWidth){
    $line =1;
    // do nothing
}
else{
    // if content is large then calculate the number of lines to fit the content
    $cellHeight=6; // for multiple lines we can reduce the height of the cells to maintain the structure
    $textLength= strlen($tests);
    $errMargin = 10;
    $startChar = 0;
    $maxChar = 0;
    $textArray = array();
    $tmpString = '';

    while($startChar < $textLength){
        while ($pdf->GetStringWidth($tmpString) < ($cellWidth-$errMargin) &&
            ($startChar+$maxChar)<$textLength){
            $maxChar++;
            $tmpString = substr($tests,$startChar,$maxChar);
        }
        $startChar =$startChar +$maxChar;
        array_push($textArray,$tmpString);
        $maxChar = 0;
        $tmpString = '';
    }
    $line = count($textArray);
}

$pdf->Cell(35,($line*$cellHeight),' Payment(Rs.)',1,0);
$pdf->Cell(59,($line*$cellHeight)," ". $customer['payment'],1,0);
$pdf->Cell(35,($line*$cellHeight),' Tests',1,0);
$pdf->MultiCell(59,$cellHeight,$tests,1);

$pdf->Ln(5);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(35,8,'Receptionist',0,1);
// add dummy cell for a cut-line
$pdf->Cell(0,5,'','B',1);
$pdf->Output();
?>