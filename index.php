<?php

include 'router.php';

$request = $_SERVER['REQUEST_URI'];
$router = new Router($request);

$router->get('/', 'views/index');
$router->get('home', 'views/index');
$router->get('about', 'views/about');
$router->get('contactus', 'views/contactus');
$router->get('login', 'views/login');
$router->get('register', 'views/register');
$router->get('profile', 'views/profile');
$router->get('profilesettings', 'views/profilesettings');
$router->get('admin', 'admin/index');
$router->get('admin', 'admin/adminsettings');
$router->get('admin', 'admin/invoice');
$router->get('logout', 'views/logout');
$router->get('404', 'views/404');
$router->get('products', 'views/products');

echo "test";