<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php
require_once '../includes/config.php';
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
        $email = $customer['email'];
        // Gathering test names for html
        $tests_list = test_lists_for_emails($customer);
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

$text = <<<EOT
National Textile Research Center

 Hi, our valued customer. Your sample with id {$customer['customer_id']} has been submitted to NTRC at {$customer['creation_time']} 
 by {$customer['name']}. The following tests will be conducted.
 {$tests}.
 
 The expected date of completion of the report is {$customer['expected_date']}. We will inform you when report will be generated.
 For any queries, visit (http://www.ntu.edu.pk/) NTU website.
                       
EOT;

try{
//prepare email message
    /*  $message = (new Swift_Message())
     ->setSubject('Test of Swift Mailer')
     ->setFrom(['mehar.abdullah13@gmail.com' => 'NTRC'])
     //->setTo(['testing@foundationphp.com' => 'David Powers'])
     ->addTo('mehar.abdullah13@zoho.com', 'Abdullah Sajid')
     ->setBody('This is a test of Swift Mailer');
     echo $message->toString();*/
    // static methods mentioned in the swift mailer course are now depricated so we have to use the constructors
    $message = (new Swift_Message())
        ->setSubject('NTRC Sample Received Mail')
        ->setFrom($from)
       ->addTo($email);

    //embed image
    $image = $message->embed(Swift_Image::fromPath('images/ntrc.png'));

$html = <<<EOT
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>NTRC Mail</title>
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
<img src="$image" width="240" height="193"
 alt="National Textile Research Center logo">
</td>
</tr>
<tr>
<td style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', Verdana, sans-serif; color: #1B1B1B; font-size: 14px; padding: 1em">
<p>
    Hi, our valued customer. Your sample with id <span style="font-weight: bold; color:#3a87ad;">{$customer['customer_id']}</span> has been submitted to NTRC at {$customer['creation_time']} by {$customer['name']}
    . The following tests will be conducted.</p>
{$tests_list}
<p>
The expected date of completion of the report is {$customer['expected_date']}. We will inform you when report will be generated.
For any queries, visit <a href="http://www.ntu.edu.pk/" target="_blank" style="text-decoration: none; font-weight: bold">NTU website</a>.
</p>
<p>
Best Regards, <span style="display: block;">NTRC Team, NTU</span>
</p>
</td>
</tr>
</table>
</td>
</tr>
</table>
</body>
</html>
EOT;

    $message->setBody($html, 'text/html')
        ->addPart($text, 'text/plain');
//        ->setReadReceiptTo(['mehar.abdullah13@gmail.com'])
//        ->setBody('This message was sent using the Swift Mailer SMTP transport');

    // attach local file
    /*   $attachment = Swift_Attachment::fromPath('./images/a.png',
           'image/png');
       $attachment->setFilename('mascot.png');
       $message->attach($attachment);*/

    // validate email address and setting reply-to-header
    /* $validator = new EmailValidator();
     if($validator->isValid("mehar.abdullah13@gmail.com", new RFCValidation())){
         $message->setReplyTo("mehar.abdullah13@gmail.com");
     }*/


    // create the transport
    $transport = (new Swift_SmtpTransport($smtp_server,465,'ssl'))
        ->setUsername($username)
        ->setPassword($password);
    $mailer = new Swift_Mailer($transport);
    $result = $mailer->send($message);
    if ($result) {
        $_SESSION["message"] = "Email has been sent.";
        redirect_to("view_sample_record.php?customer_id={$customer['customer_id']}");
    } else {
        $_SESSION["message"] = "Email hasn't been sent.";
        redirect_to("view_sample_record.php?customer_id={$customer['customer_id']}");
    }

}
catch (Exception $e){
    echo $e;
}
?>
