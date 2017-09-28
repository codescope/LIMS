<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php
$tests = "";
if(isset($_GET['customer_id'])){
    $customer =get_customer_by_id($_GET['customer_id']);
    if(!$customer){
        $_SESSION["message"] = "Customer ID doesn't exist.";
        redirect_to("reception.php");
        //  redirect_to("view_sample_record.php?customer_id={$customer['customer_id']}");
    }
    // now gather the name of tests of this sample in string
    if(isset($customer)){

        // Gathering test names for plain text
        if($customer['tensile_strength_test']){$tests .= "Tensile Strength, "; }
        if($customer['tear_strength_test']){$tests .= "Tear Strength, "; }
        if($customer['color_fastness_to_crocking_test']){$tests .= "Color Fastness to Crocking, "; }
        $tests = substr($tests,0,strlen($tests)-2);

    }
}
else{
    redirect_to("reception.php");
}
$receipt_content = <<< EOT
<table width="80%" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="margin-top: 15px;">
<tr style="padding-top: 1em">
<td style="width:18%;text-align: center;padding-top: 0.5em;">
<img src="images/ntrc.png" width="100" height="90"
     alt="NTRC logo">
</td>
<td colspan="2" style="width:64%;padding-top: 0.5em;">
<h1 style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', Verdana, sans-serif; color: #000;text-align: center; font-size: 28px;margin-bottom: 0;margin-top: -10px;">National Textile Research Center</h1>
<div style="text-align: center; padding-top: 5px;font-weight: bolder;">Sample Receipt</div>
</td>
<td style="width:18%;text-align: center;padding-top: 0.5em;">
<img src="images/ntu.jpg" width="100" height="90"
     alt="NTU logo">
</td>
</tr>
</table>
<div style="width: 80%; margin: 0 auto; margin-top: 15px;">
<p style="float: left; width: 35%; padding: 0.5em;margin: 0;">
Receiving Date:&nbsp;&nbsp;{$customer['creation_time']}
</p>
<p style="float: right; width: 28%; padding: 0.5em;margin: 0; text-align: left;">
Customer ID:&nbsp;&nbsp;&nbsp;{$customer['customer_id']}
</p>
</div>
<div style="width: 80%; margin: 0 auto; clear: both;">
<p style="float: left; width: 35%; padding: 0.5em; margin: 0;">
Expected-Date:&nbsp;&nbsp;&nbsp;{$customer['expected_date']}
</p>
<p style="float: right;width: 28%; padding: 0.5em; margin: 0;text-align: left;">
Concerned Person:&nbsp;&nbsp;&nbsp;Abdullah
</p>
</div>
<div style="width: 80%; margin: 0 auto; clear: both;">
<p style="float: right;width: 28%; padding: 0.5em; margin: 0; margin-bottom: 5px;text-align: left;">
Email:&nbsp;&nbsp;&nbsp;{$customer['email']}
</p>
</div>
<table width="80%" align="center" border="1" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
<tr>
<td style="width: 20%; padding: 0.5em;">
Name
</td>
<td style="width: 30%; padding: 0.5em;">
{$customer['name']}
</td>
<td style="width: 20%; padding: 0.5em;">
Designation
</td>
<td style="width: 30%; padding: 0.5em;">
{$customer['designation']}
</td>
</tr>
<tr>
<td style="width: 20%; padding: 0.5em;">
Organization
</td>
<td style="width: 30%; padding: 0.5em;">
{$customer['organization']}
</td>
<td style="width: 20%; padding: 0.5em;">
Sample Type
</td>
<td style="width: 30%; padding: 0.5em;">
{$customer['sample_type']}
</td>
</tr>
<tr>
<td style="width: 20%; padding: 0.5em;">
Concerned Lab
</td>
<td style="width: 30%; padding: 0.5em;">
{$customer['concerned_lab']}
</td>
<td style="width: 20%; padding: 0.5em;">
No. of tests
</td>
<td style="width: 30%; padding: 0.5em;">
{$customer['no_of_tests']}
</td>
</tr>
<tr>
<td style="width: 20%; padding: 0.5em;">
Payment(Rs.)
</td>
<td style="width: 30%; padding: 0.5em;">
{$customer['payment']}
</td>
<td style="width: 20%; padding: 0.5em;">
Tests
</td>
<td style="width: 30%; padding: 0.5em;">
{$tests}
</td>
</tr>
</table>
<div style="width:80%;margin:0 auto; border-bottom: 2px dashed black;">
<p style="margin-top: 30px;font-weight: bold;font-size: 18px;">
Receptionist:
</p>
</div>
EOT;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>Customer Sample Receipt</title>
</head>
<body style="background-color: white;">
 <?php echo $receipt_content;?>
 <?php echo $receipt_content;?>
</body>
</html>
