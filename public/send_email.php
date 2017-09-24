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
        if($customer['tensile_strength_test']){$tests .= "Tensile Strength, "; }
        if($customer['tear_strength_test']){$tests .= "Tear Strength, "; }
        if($customer['color_fastness_to_crocking_test']){$tests .= "Color Fastness to Crocking, "; }
        $tests = substr($tests,0,strlen($tests)-2);
    }
}
else{
    redirect_to("reception.php");
}
?>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>Swift Mailer Inline Image Test</title>
</head>
<body bgcolor="#EBEBEB" link="#B64926" vlink="#FFB03B">
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#EBEBEB">
    <tr>
        <td>
            <table width="600" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                <tr>
                    <td style="padding-top: 0.5em">
                        <h1 style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', Verdana, sans-serif; color: #0E618C; text-align: center; border-bottom: solid 4px;">National Textile Research Center</h1>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <img src="images/oric.jpg" width="281" height="193"
                             alt="National Textile Research Center logo">
                    </td>
                </tr>
                <tr>
                    <td style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', Verdana, sans-serif; color: #1B1B1B; font-size: 14px; padding: 1em">
                        <p>Hi</p>
                        <ul style="margin-left: 30px">
                            <li>Everyone likes this kind animal</li>
                            <li>It's useful to humankind</li>
                            <li>It's powerful, but gentle at the same time</li>
                            <li>It's quick when it attacks (databases)</li>
                            <li>The letters PHP form an elePHPant (take a close look)</li>
                        </ul>
                        <p>Vincent has generously made the elePHPant logo available in many different formats. You can <a href="http://www.elephpant.com/#download" target="_blank" style="text-decoration: none; font-weight: bold">download your own set from www.elephpant.com</a>.</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>