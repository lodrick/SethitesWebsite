<?php 

/*
THIS FILE USES PHPMAILER INSTEAD OF THE PHP MAIL() FUNCTION
*/

require 'PHPMailer-master/PHPMailerAutoload.php';

/*
*  CONFIGURE EVERYTHING HERE
*/

// an email address that will be in the From field of the email.
$fromEmail = 'demo@domain.com';
$fromName = 'Demo contact from';

// an email address that will receive the email with the output of the form
$sendToEmail = 'demo@domain.com';
$sendToName = 'Demo contact from';

// subject of the email
$subject = 'New message from conatct form';

// form field names and their translations.
// array variable name => Text to appear in the email
$fields = array('name' => 'Name', 'surname' => 'surname', 'phone' => 'Phone', 'email' => 'Email', 'message' => 'Message');

// message that will be displayed when everything is OK :)
$okMessage = 'Contact form successfully submitted. Thank you, I will get back to you soon!';

// If something goes wrong, we will display this message.
$errorMessage = 'There was an error while submitting the form. Please try again later';

$emailTextHtml = "<h1>You have a new message from your contact form</h1><hr>";

$emailTextHtml .= "<table>";

foreach ($_POST as $Key => $value) {
    // If the field exists in the $fields array, include it in the email
    if(isset($fields[$key])){
        $emailTextHtml .= "<tr><th>$fields[$key]</th><td>$value</td></tr>";
    }
}

$emailTextHtml .= "</table><hr>";
$emailTextHtml .= "<p>Have a nice day, <br>Best,<br>Pexley</p>"

$mail = new PHPMailer;
$mail->sendFrom($fromEmail, $fromName);
$mail->addAddress($sendToEmail, $sendToName); // you can add more addresses by simply adding another line with $mail->addAddress();
$mail->addReplyTo($from);

$mail->isHTML(true);

$mail->Subject = $subject;
$mail->msgHTML($emailTextHtml); // this will also create a plain-text version of the HTML email, very handy

if(!$mail->send()) {
    throw new \Exception('I could not send the email.'.$mail->ErrorInfo);
}
?>