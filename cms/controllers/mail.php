<?php
defined('BASE_PATH') or exit('No direct script access allowed');
//https://stackoverflow.com/a/14371652
define('TIME_INTERVAL', 10);



require_once __DIR__.'/../models/sendmail.php';

class Mail
{
    public function SendMail($data): string
    {
        
        if(isset($_SESSION['ip']) && (time() - $_SESSION['lastSentSubmission']) < TIME_INTERVAL) 
        {
            return "Your message has already been sent!";
        } else {
            $mail = new SendMail();

            $email = (string)$data['email'];
            $name = (string)$data['name'];
            $subject = (string)$data['subject'];
            $message = (string)$data['message'];
    
            $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

            if (!preg_match($email_exp, $email)) {
                return "The Email address you entered does not appear to be valid.";
            }
        
            $string_exp = "/^[A-Za-z .'-]+$/";
        
            if (!preg_match($string_exp, $name)) {
                return "The Name you entered does not appear to be valid.";
            }

            if (strlen($subject) < 2) {
                return "The Subject you entered do not appear to be valid.";
            }

            if (strlen($message) < 2) {
                return "The Message you entered do not appear to be valid.";
            }

            return $mail->SendMail($email, $name, $subject, $message);
        }
    }
}


