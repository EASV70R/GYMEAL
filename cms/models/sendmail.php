<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './vendor/lib/PHPMailer/src/Exception.php';
require './vendor/lib/PHPMailer/src/PHPMailer.php';
require './vendor/lib/PHPMailer/src/SMTP.php';

//Create an instance; passing `true` enables exceptions
Class SendMailModel
{
    public function SendMail($email, $name, $subject, $message): string
    {
        try {
            $mail = new PHPMailer(true);
            //Server settings
           // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->getSMTPInstance()->Timelimit = 5;
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'send.one.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'admin@kuro.ac';                     //SMTP username
            $mail->Password   = 'Hej123321@';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            $mail->getSMTPInstance()->Timelimit = 5;

            //Recipients
            $mail->setFrom('admin@kuro.ac');
            $mail->addAddress('contact@kuro.ac', 'contact');     //Add a recipient
            $mail->addReplyTo($email, $name);
    
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = ($email ." - ". $name ." - ". $subject);
            //$mail->Subject = ("$email - $name ($subject)");
            $mail->Body = $message;
            //echo 'Message has been sent';
            $response = $mail->send();
            return ($response) ? 'Your message has been sent.' : 'Something went wrong, please try again.';
        } catch (Exception $e) {
            return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}