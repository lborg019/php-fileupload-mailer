# php-fileupload-mailer
PHP script which enables users to upload their resumes to a webpage's server. Once uploaded, document gets emailed and deleted.

This example works with Gmail's external SMTP.

Requires that your server has  [pear](http://pear.php.net) PHP Extension installed.

To install pear on a Bitnami instance:
`sudo /opt/bitnami/php/bin/pear install pear/Net_SMTP pear/Mail-1.2.0`
