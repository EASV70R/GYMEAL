<?php
defined('BASE_PATH') or exit('No direct script access allowed');

class Util
{
    public static function Header(): void
    {
        include(SITE_ROOT.'/includes/header.inc.php');
    }

    public static function Navbar(): void
    {
        include(SITE_ROOT.'/includes/navbar.inc.php');
    }

    public static function Footer(): void
    {
        include(SITE_ROOT.'/includes/footer.inc.php');
    }

    public static function IsLoggedIn(): void
    {
        if (Session::Get('login')) {
            if (basename($_SERVER['PHP_SELF']) == 'login.php' || basename($_SERVER['PHP_SELF']) == 'register.php') {
                self::Redirect('/index.php');
            }
        } else {
            if (basename($_SERVER['PHP_SELF']) != 'login.php' && basename($_SERVER['PHP_SELF']) != 'register.php') {
                self::Redirect('/index.php');
            }
        }
    }

    public static function IsAdmin(): void
    {
        if (!Session::Get('login') || !Session::Get('admin')) {
            Util::Redirect('/../index.php');
        }
    }

    public static function Redirect(string $location): void
    {
        header("location: ${BASE_PATH}.${location}");
        exit;
    }

    public static function Print(string $string): string
    {
        return htmlspecialchars($string);
    }
}