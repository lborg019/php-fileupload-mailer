<?php
require_once "Mail.php";

$from = "youremail@example.com";
$to = 'youremail@example.com';
$bcc = 'bccemail@example.com';

$host = "ssl://smtp.example.net:465";
$username = 'youremail@example.com';
$password = 'yourpassword';

$subject = "test";
$body = "test";

$headers = array('From'		=> $from,
				 'To'		=> $to,
				 'Subject'	=> $subject);

$smtp = Mail::factory('smtp',
	array ('host'     => $host,
		   'auth'     => true,
		   'username' => $username,
		   'password' => $password));

//concatenate recipients:
$recipients = $to. ", ".$bcc;

//send
$mail = $smtp->send($recipients, $headers, $body);

if(PEAR::isError($mail))
{
	echo($mail->getMessage());
}
else
{
	echo("Message successfully sent!\n");
}
?>
