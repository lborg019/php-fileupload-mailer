<?php
require "Mail.php";
require "Mail/mime.php";

$text = 'Text version of email';
$html = '<html><body>HTML version of email</body></html>';
$file = './yourfile.pdf'; //or whichever extension it is
$crlf = "\n";

$from = "youremail@example.com";
$to = 'youremail@example.com';
$subject = 'subject goes here';

$host = "ssl://smtp.example.com:465";
$username = 'youremail@example.com';
$password = 'yourpassword';

$headers = array ('From' => $from, 'To' => $to,'Subject' => $subject);

$mime = new Mail_mime($crlf);
$mime->setTXTBody($text);
$mime->setHTMLBody($html);
$mime->addAttachment($file, 'application/octet-stream');

$body = $mime->get();
$hdrs = $mime->headers($headers);

$smtp = Mail::factory('smtp',
	array ('host'     => $host,
		   'auth'     => true,
		   'username' => $username,
		   'password' => $password));
$mail = $smtp->send($to, $hdrs, $body);

if(PEAR::isError($mail))
{
	echo($mail->getMessage());
}
else
{
	echo("Message successfully sent!\n");
}
?>
