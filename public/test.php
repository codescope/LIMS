<?php
use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\RFCValidation;
require_once '../includes/config.php';


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
        ->setTo($test1)
//        ->setReadReceiptTo(['mehar.abdullah13@gmail.com'])
        ->setBody('This message was sent using the Swift Mailer SMTP transport');

    // attach local file
    $attachment = Swift_Attachment::fromPath('./images/a.png',
        'image/png');
    $attachment->setFilename('mascot.png');
    $message->attach($attachment);

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