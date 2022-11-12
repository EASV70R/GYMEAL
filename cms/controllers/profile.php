<?php
defined('BASE_PATH') or exit('No direct script access allowed');

require_once __DIR__.'/../models/user.php';
require_once __DIR__.'/../utils/validator.php';

if (!Session::Get('login')) {
    http_response_code(403);
    exit();
}

class Profile
{
    public string $username;

    public function __construct()
    {
        $this->username = Session::Get('username');
    }

    public function UpdatePassword($data): string
    {
        $User = new UserModel();

        $currentPassword = (string) $data['currentPassword'];
        $newPassword = (string) $data['newPassword'];
        $confirmPassword = (string) $data['confirmPassword'];

        $validationError = Validator::UpdatePasswordForm($currentPassword, $newPassword, $confirmPassword);
        if ($validationError) {
            return $validationError;
        }

        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        return $User->UpdatePassword($currentPassword, $hashedPassword, $this->username);
    }
}