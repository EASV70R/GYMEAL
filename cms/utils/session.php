<?php
defined('BASE_PATH') or exit('No direct script access allowed');

class Session
{
    public static function Init(): void
    {
        session_start();

        Session::Set("ipaddress", $_SERVER['REMOTE_ADDR']);
        Session::Set("useragent", $_SERVER['HTTP_USER_AGENT']);
        Session::Set("lastaccess", time());
    }

    public static function Get(string $key)
    {
        return (isset($_SESSION[$key])) ? $_SESSION[$key] : false;
    }

    public static function CreateUserSession($user, $role)
    {
        Session::Set("login", true);
        Session::Set("uid", (int) $user->uid);
        Session::Set("username", (string) $user->username);
        Session::Set("email", (string) $user->email);
        Session::Set("createdAt", $user->createdAt);
        Session::Set("admin", (int)$role->roleid);
    }

    public static function Set(string $key, mixed $val): void
    {
        $_SESSION[$key] = $val;
    }
}