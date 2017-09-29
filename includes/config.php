<?php


require_once 'lexer/lib/Doctrine/Common/Lexer/AbstractLexer.php';
require_once 'EmailValidator/EmailValidator/Validation/EmailValidation.php';
require_once 'EmailValidator/EmailValidator/Validation/RFCValidation.php';
require_once 'EmailValidator/EmailValidator/Validation/DNSCheckValidation.php';
require_once 'EmailValidator/EmailValidator/Exception/InvalidEmail.php';

require_once 'EmailValidator/EmailValidator/Parser/Parser.php';
require_once 'EmailValidator/EmailValidator/Warning/Warning.php';
require_once 'EmailValidator/EmailValidator/Warning/LocalTooLong.php';
require_once 'EmailValidator/EmailValidator/Parser/LocalPart.php';
require_once 'EmailValidator/EmailValidator/Parser/DomainPart.php';

require_once 'EmailValidator/EmailValidator/Validation/MultipleValidationWithAnd.php';
require_once 'EmailValidator/EmailValidator/Validation/NoRFCWarningsValidation.php';

require_once 'EmailValidator/EmailValidator/Validation/SpoofCheckValidation.php';

require_once 'EmailValidator/EmailValidator/EmailValidator.php';
require_once 'EmailValidator/EmailValidator/EmailParser.php';
require_once 'EmailValidator/EmailValidator/Validation/MultipleErrors.php';

require_once 'EmailValidator/EmailValidator/EmailLexer.php';

/*
 * $loader needs to be a relative path to an autoloader script.
 * Swift Mailer's autoloader is swift_required.php in the lib directory.
 * If you used Composer to install Swift Mailer, use vendor/autoload.php.
 */
$loader = __DIR__ . '/swiftmailer/lib/swift_required.php';

require_once $loader;

/*
 * Login details for mail server
 To send email from gmail besides other settings you also need to set username as your full gmail address(like mehar.abdullah13@gmail.com) and you have to turn on less secure apps in your settings and for zoho set the username as (mehar.abdullah13)
 */

$smtp_server = 'smtp.gmail.com';
$username = 'mehar.abdullah13@gmail.com';
$password = '';

/*
 * Email addresses for testing
 * The first two are associative arrays in the format
 * ['email_address' => 'name']. The rest contain just
 * an email address as a string.
 */
$from = ['mehar.abdullah13@gmail.com' => 'NTRC Faisalabad'];
$test1 = ['mehar.abdullah13@zoho.com' => 'Mehar Abdullah'];
$testing = '';
$test2 = '';
$test3 = '';
$secret = '';
$private = '';

?>
