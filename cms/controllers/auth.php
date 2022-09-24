<?php
defined('BASE_PATH') or exit('No direct script access allowed');

require_once __DIR__.'/../models/user.php';
require_once __DIR__.'/../utils/session.php';
require_once __DIR__.'/../utils/validator.php';

class Auth
{
    public function Register($data): string
    {
        $User = new User();

        $firstName = trim($data['firstName']);
        $lastName = trim($data['lastName']);
        $username = trim($data['username']);
        $password = (string) $data['password'];
        $confirmPassword = (string) $data['confirmPassword'];
        $email = (string) $data['email'];
        $phone = (string) $data['phone'];

        $validationError = Validator::RegisterForm($username, $password, $confirmPassword, $email, $firstName, $lastName, $phone);
        if ($validationError) {
            return $validationError;
        }

        $userExists = $User->GetUsername($username);
        if ($userExists) {
            return "Username already exists.";
        }
  
        $emailExists = $User->GetEmail($email);
        if ($emailExists) {
            return "Email already exists.";
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $response = $User->Register($username, $hashedPassword, $email, $firstName, $lastName, $phone);

        return ($response) ? 'Registration successful.' : 'Registration failed.';
    }

    public function Login($data): null|string
    {
        $User = new User();

        $username = trim($data['username']);
        $password = (string) $data['password'];

        $validationError = Validator::LoginForm($username, $password);
        if ($validationError) {
            return $validationError;
        }

        $response = $User->Login($username, $password);
        if ($response) {
            Session::CreateUserSession($response);
            Util::Redirect('/');

        } else {
            return 'Invalid username or password.';
        }
    }

    public function Logout()
    {
        session_unset();
        $_SESSION = array();
        session_destroy();
    }
}