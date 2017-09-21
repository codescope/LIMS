<?php
/**
 * Created by PhpStorm.
 * User: Abdullah Sajid
 * Date: 20/09/2017
 * Time: 9:02 AM
 */
require_once '../includes/config.php';
$name ="Ali";
$html = <<<EOT
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>Swift Mailer HTML Email Test</title>
</head>
<body bgcolor="#EBEBEB" link="#B64926" vlink="#FFB03B">
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#EBEBEB">
<tr>
<td>
<table width="600" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
<tr>
<td style="padding-top: 0.5em">
<h1 style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', Verdana, sans-serif; color: #0E618C; text-align: center; border-bottom: solid 4px">HTML Email with Swift Mailer</h1>
</td>
</tr>
<tr>
<td style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', Verdana, sans-serif; color: #1B1B1B; font-size: 14px; padding: 1em">
<p>To send HTML email with Swift Mailer,{$name} simply pass the HTML markup to the <code style="color: #3a87ad; font-family: Consolas, Monaco, monospace; font-size: 16px">setBody()</code> method of the message object, and set the second argument to <code style="color: #3a87ad; font-family: Consolas, Monaco, monospace; font-size: 16px">'text/html'</code>.</p>
<p><a href="http://swiftmailer.org/docs/messages.html#setting-the-body-content" target="_blank" style="font-weight: bold; text-decoration: none">As the Swift Mailer documentation explains</a>, you should always add a plain text version of the content using the <code style="color: #3a87ad; font-family: Consolas, Monaco, monospace; font-size: 16px">addPart()</code> method.</p>
</td>
</tr>
</table>
</td>
</tr>
</table>
</body>
</html>
EOT;

$text = <<<EOT
HTML Email with Swift Mailer

To send HTML email with Swift Mailer, simply pass the
HTML markup to the setBody() method of the message object,
and set the second argument to 'text/html'.

As the Swift Mailer documentation explains
(http://swiftmailer.org/docs/messages.html#setting-the-body-content),
you should always add a plain text version of the content
using the addPart() method.
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
        ->setSubject('Swift Mailer SMTP Test')
        ->setFrom($from)
        ->setTo($from)
        ->setBody($html, 'text/html')
        ->addPart($text, 'text/plain');
//        ->setReadReceiptTo(['mehar.abdullah13@gmail.com'])
//        ->setBody('This message was sent using the Swift Mailer SMTP transport');

    // attach local file
 /*   $attachment = Swift_Attachment::fromPath('./images/a.png',
        'image/png');
    $attachment->setFilename('mascot.png');
    $message->attach($attachment);*/

    // validate email address
    /* $validator = new EmailValidator();
     if($validator->isValid("example@example.com", new RFCValidation())){
         $message->setReplyTo("david@gmail.com");
     }*/


    // create the transport
    $transport = (new Swift_SmtpTransport($smtp_server,465,'ssl'))
        ->setUsername($username)
        ->setPassword($password);
    $mailer = new Swift_Mailer($transport);
    $result = $mailer->send($message);
    if ($result) {
        echo "Number of emails sent: $result";
    } else {
        echo "Couldn't send email";
    }

}
catch (Exception $e){
    echo $e;
}