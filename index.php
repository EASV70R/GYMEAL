<?php
include 'router.php';

$request = $_SERVER['REQUEST_URI'];
$router = new Router($request);

$router->get('/', 'views/index');
$router->get('home', 'views/index');
$router->get('about', 'views/about');
$router->get('contactus', 'views/contactus');
$router->get('products', 'views/products');
$router->get('productview', 'views/productview');
$router->get('cart', 'views/cart/cart');
$router->get('order', 'views/cart/placeorder');
$router->get('login', 'views/login');
$router->get('register', 'views/register');
$router->get('profile', 'views/profile');
$router->get('profilesettings', 'views/profilesettings');
$router->get('admin', 'views/admin/index');
$router->get('admsettings', 'views/admin/settings');
$router->get('editinvoice', 'views/admin/invoice');
$router->get('editproductlist', 'views/admin/productlist');
$router->get('editproduct', 'views/admin/editproduct');
$router->get('bloglist', 'views/admin/blog');
$router->get('logout', 'views/logout');
$router->get('404', 'views/404');


if ($_SERVER['REMOTE_ADDR'] != $_SESSION['ipaddress'])
{
    session_unset();
    session_destroy();
}
if ($_SERVER['HTTP_USER_AGENT'] != $_SESSION['useragent'])
{
    session_unset();
    session_destroy();
}

if (time() > ($_SESSION['lastaccess'] + 3600))
{
    session_unset();
    session_destroy();
}
else
{
    $_SESSION['lastaccess'] = time();
}
//var_dump(session_status() == PHP_SESSION_ACTIVE); // false