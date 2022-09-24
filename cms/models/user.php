<?php
defined('BASE_PATH') or exit('No direct script access allowed');

require_once __DIR__.'/../core/database.php';

class User extends Database
{
    public function GetUsername($username): bool|stdClass
    {
        $this->prepare('SELECT * FROM `users` WHERE `username` = ? LIMIT 1');
        $this->statement->execute([$username]);
        return $this->statement->fetch();
    }

    public function GetEmail($email): bool|stdClass
    {
        $this->prepare('SELECT * FROM `users` WHERE `email` = ? LIMIT 1');
        $this->statement->execute([$email]);
        return $this->statement->fetch();
    }

    public function Register($username, $hashedPassword, $email, $firstName, $lastName, $phone): bool
    {
        $this->prepare('INSERT INTO `users` (`username`, `password`, `email`, `firstName`, `lastName`, `phone`) VALUES (?, ?, ?, ?, ?, ?)');
     
        if ($this->statement->execute([$username, $hashedPassword, $email, $firstName, $lastName, $phone]))
        {
            return true;
        } else {
            return false;
        }
    }

    public function Login($username, $password): bool|object
    {
        $row = $this->GetUsername($username);
        return $row && password_verify($password, $row->password) ? $row : false;
    }

    public function UpdatePassword($currentPassword, $hashedPassword, $username): string
    {
        $row = $this->GetUsername($username);

        if (password_verify($currentPassword, $row->password)) {
            $this->prepare('UPDATE `users` SET `password` = ? WHERE `username` = ?');
            $this->statement->execute([$hashedPassword, $username]);
            return 'Password changed successfully.';
        } else {
            return 'Failed to change password.';
        }
    }
}