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

    public function Login($username, $password): bool|object
    {
        $row = $this->GetUsername($username);
        return $row && password_verify($password, $row->password) ? $row : false;
    }
}