<?php
if(empty($_GET['name'])  		||
   empty($_GET['email']) 		||
   empty($_GET['message']))
   {
	echo "please full in all blank";
   }
	
	
$name = $_GET['name'];
$email_address = $_GET['email'];
$message = $_GET['message'];

// Create the email and send the message
$to = 'receivemail@yourdomain.com'; // Add your email address inbetween the '' replacing receivemail@yourdomain.com - This is where the form will send a message to.
$email_subject = "Website Contact From:  $name";
$email_body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\n\nEmail: $email_address\n\nMessage:\n$message";

// This example shows making an SMTP connection with authentication.

//Import the PHPMailer class into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');
require 'PHPMailer/PHPMailer/src/Exception.php';
require 'PHPMailer/PHPMailer/src/PHPMailer.php';
require 'PHPMailer/PHPMailer/src/SMTP.php';
//Create a new PHPMailer instance
$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;
//Set the hostname of the mail server, you need to get it from your mail sever
$mail->Host = 'xxxxxxxx';   
//Set the SMTP port number - likely to be 25, 465 or 587, you need to get it from your mail sever
$mail->Port = 25;
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication
$mail->Username = 'sendmail@yourdomain.com'; #your mail address used to send email
//Password to use for SMTP authentication
$mail->Password = '*********'; //you may need the password or AUTHORIZE CODE of your mail account sendmail@yourdomain.com
//Set who the message is to be sent from
$mail->setFrom('sendmail@yourdomain.com', $name);
//Set an alternative reply-to address
$mail->addReplyTo($to, $name);
//Set who the message is to be sent to
$mail->addAddress($to, 'your name');
//Set the subject line
$mail->Subject = $email_subject;
$mail->Body    = $email_body;
$mail->SMTPSecure = 'ssl'; #if your mail sever use ssl to encrypt the email，like qq
if($mail->send()){
	header("Location: thank_you.html");  
}
else{
	echo "Failed, please try agian";
}
?>
