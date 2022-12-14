<?php
defined('BASE_PATH') or exit('No direct script access allowed');

class Util
{
    public static function Header(): void
    {
        include(SITE_ROOT.'/views/includes/header.inc.php');
    }

    public static function Navbar(): void
    {
        include(SITE_ROOT.'/views/includes/navbar.inc.php');
    }

    public static function Footer(): void
    {
        include(SITE_ROOT.'/views/includes/footer.inc.php');
    }

    public static function IsLoggedIn(): void
    {
        if (Session::Get('login')) {
            if (basename($_SERVER['REQUEST_URI']) == 'login' || basename($_SERVER['REQUEST_URI']) == 'register') {
                self::Redirect('/');
            }
        } else {
            if (basename($_SERVER['REQUEST_URI']) != 'login' && basename($_SERVER['REQUEST_URI']) != 'register') {
                self::Redirect('/');
            }
        }
    }

    public static function IsAdmin(): void
    {
        if (!Session::Get('login') || !Session::Get('admin')) {
            Util::Redirect('/../home');
        }
    }

    public static function IsOrderFromUser($uid): void
    {
        if (!Session::Get('login') || Session::Get('uid') != $uid) {
            Util::Redirect('/../home');
        }
    }

    public static function Redirect(string $location): void
    {
        exit(header("Location: ${location}"));
    }

    public static function SafePrint(string $string): string
    {
        return htmlspecialchars($string);
    }
}