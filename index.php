<?php
require_once 'cms/require.php';
include 'router.php';

$request = $_SERVER['REQUEST_URI'];
$router = new Router();

$router->any('/', 'views/index');
$router->any('/home', 'views/index');
$router->any('/about', 'views/about');
$router->any('/contactus', 'views/contactus');
$router->any('/products', 'views/products');
$router->any('/productview/$id', 'views/productview');
$router->any('/cart', 'views/cart/cart');
$router->get('/cart/empty', 'cms/callbacks/cart/empty');
$router->any('/order', 'views/cart/placeorder');
$router->any('/login', 'views/login');
$router->any('/register', 'views/register');
$router->any('/profile', 'views/profile');
$router->any('/profilesettings', 'views/profilesettings');
$router->any('/admin', 'views/admin/index');
$router->any('/admsettings', 'views/admin/settings');
$router->any('/editinvoice', 'views/admin/invoice');
$router->any('/editproductlist', 'views/admin/productlist');
$router->any('/editproductlist/delete/$id', 'views/admin/productdelete');
$router->any('/editproduct/edit/$id', 'views/admin/editproduct');
$router->any('/bloglist', 'views/admin/blog');
$router->any('/logout', 'views/logout');
$router->any('/404', 'views/404');

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