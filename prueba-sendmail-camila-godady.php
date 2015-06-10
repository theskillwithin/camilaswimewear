<?php
require_once 'swiftmailer-5.4.0/lib/swift_required.php';

// Create SMTP Transport
/*
$transport = Swift_SmtpTransport::newInstance('smtp.example.org', 25)
  ->setUsername('your username')
  ->setPassword('your password')
  ;
*/
  
  
/*
You could alternatively use a different transport such as Sendmail or Mail:

// Sendmail
$transport = Swift_SendmailTransport::newInstance('/usr/sbin/sendmail -bs');

// Mail
$transport = Swift_MailTransport::newInstance();
*/


$transport = Swift_SendmailTransport::newInstance('/usr/sbin/sendmail -bs');



// Create the Mailer using your created Transport
$mailer = Swift_Mailer::newInstance($transport);

// Create a message
$message = Swift_Message::newInstance('Camila Wonderful Subject')
  ->setFrom(array('info@camilaswimwear.com' => 'Camila Swimwear Info'))
  ->setTo(array('john.doe.2015@mailinator.com' => 'Mr John Doe 2015'))
  ->setBody('Here is the message itself from Camila')
  ;

// Send the message
$result = $mailer->send($message);
echo print_r($result, true);
?>