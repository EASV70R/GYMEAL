<?php
defined('BASE_PATH') or exit('No direct script access allowed');

require_once __DIR__.'/../models/user.php';
require_once __DIR__.'/../utils/session.php';
require_once __DIR__.'/../utils/validator.php';

class Auth
{
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
            return 'Success';
        } else {
            return 'Failed';
        }
    }

    public function Logout()
    {
        session_unset();
        $_SESSION = array();
        session_destroy();
    }
}