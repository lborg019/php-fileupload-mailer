<?php
require_once "Mail.php";

$from = "youremail@example.com";
$to = 'youremail@example.com';

$host = "ssl://smtp.example.com:465";
$username = 'youremail@example.com';
$password = 'yourpassword';

$subject = "subjectgoeshere";
$body = "bodygoeshere";

$headers = array ('From' => $from, 'To' => $to,'Subject' => $subject);
$smtp = Mail::factory('smtp',
	array ('host'     => $host,
		   'auth'     => true,
		   'username' => $username,
		   'password' => $password));

$mail = $smtp->send($to, $headers, $body);

if(PEAR::isError($mail))
{
	echo($mail->getMessage());
}
else
{
	echo("Message successfully sent!\n");
}
?>
