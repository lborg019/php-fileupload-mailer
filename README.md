# php-fileupload-mailer
PHP script which enables users to upload their resumes to a webpage's server. Once uploaded, document gets emailed and deleted.

This example works with Gmail's external SMTP.

Requires that your server has  [pear](http://pear.php.net) PHP Extension installed.

To install pear on a Bitnami instance:
`sudo /opt/bitnami/php/bin/pear install pear/Net_SMTP pear/Mail-1.2.0`

I created the test-mailer folder with phps to help you test the email settings setup.
It is much easier to simply type `php mail.php` and check to see if your setup works then actually testing on a browser for example.

I included php files for:
- sending a simple email (mail.php)
- sending an email with attachment (mail_attachment.php)
- sending an email with attachment to multiple recipients (mail_cc.php)

To add an extra attachment simply add another $mime->addAttachment($file, 'application/octet-stream') line to the code.


