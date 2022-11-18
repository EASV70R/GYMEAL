<?php
defined('BASE_PATH') or exit('No direct script access allowed');

require_once __DIR__.'/../models/user.php';
require_once __DIR__.'/../utils/session.php';
require_once __DIR__.'/../utils/validator.php';

class Auth
{

    public function GetAllUsers(): array
    {
        $User = new UserModel();
        return $User->GetUsers();
    }

    public function Register($data): string
    {
        $User = new UserModel();

        $username = trim($data['username']);
        $password = (string) $data['password'];
        $confirmPassword = (string) $data['confirmPassword'];
        $email = (string) $data['email'];

        $validationError = Validator::RegisterForm($username, $password, $confirmPassword, $email);
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
        $response = $User->Register($username, $hashedPassword, $email);

        return ($response) ? 'Registration successful.' : 'Registration failed.';
    }

    public function Login($data): null|string
    {
        $User = new UserModel();

        $username = trim($data['username']);
        $password = (string) $data['password'];

        $validationError = Validator::LoginForm($username, $password);
        if ($validationError) {
            return $validationError;
        }

        $response = $User->Login($username, $password);
        if ($response) {
            $response2 = $User->GetRole($response->uid);
            if ($response2) {
                Session::CreateUserSession($response, $response2);  
                Util::Redirect('/');
           // return ($response2) ? 'Login successful.' : 'Login failed.';
            }

        } else {
            return 'Invalid username or password.';
        }
    }

    public function Logout()
    {
        session_unset();
        $_SESSION = array();
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();
    }

    public function EditUser($data): null|string
    {
        $User = new UserModel();

        $username = trim($data['mUsername']);
        if( isset($data['mPassword']) ){
            $password = (string) $data['mPassword'];
        }
        $email = (string) $data['mEmail'];
        $uid = (int) $data['uid'];

        $validationError = Validator::EditUserForm($username, $email);
        if ($validationError) {
            return $validationError;
        }

        $response = $User->EditUser($uid, $username, $password, $email);

        return ($response) ? 'User edited successfully.' : 'User edit failed.';
    }

    public function DeleteUser($data): null|string
    {
        $User = new UserModel();
        $uid = (int)$data['uid'];
        $response = $User->DeleteUser($uid);
       return ($response) ? $uid : 'User delete failed.';
    }
}