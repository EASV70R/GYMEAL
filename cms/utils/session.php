<?php
defined('BASE_PATH') or exit('No direct script access allowed');

class Session
{
    public static function Init(): void
    {
        session_start();
    }

    public static function Get(string $key)
    {
        return (isset($_SESSION[$key])) ? $_SESSION[$key] : false;
    }

    public static function CreateUserSession($user)
    {
        Session::Set("login", true);
        Session::Set("uid", (int) $user->uid);
        Session::Set("username", (string) $user->username);
        Session::Set("email", (string) $user->email);
        Session::Set("firstName", (string) $user->firstName);
        Session::Set("lastName", (string) $user->lastName);
        Session::Set("phone", (string) $user->phone);
        Session::Set("admin", (bool) $user->admin);
        Session::Set("createdAt", $user->createdAt);
    }

    public static function Set(string $key, mixed $val): void
    {
        $_SESSION[$key] = $val;
    }
}