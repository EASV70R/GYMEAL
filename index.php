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
$router->get('login', 'views/login');
$router->get('register', 'views/register');
$router->get('profile', 'views/profile');
$router->get('profilesettings', 'views/profilesettings');
$router->get('admin', 'admin/index');
$router->get('admin/settings', 'admin/settings');
$router->get('admin/invoice', 'admin/invoice');
$router->get('admin/productlist', 'admin/productlist');
$router->get('admin/editproduct', 'admin/editproduct');
$router->get('admin/blog', 'admin/blog');
$router->get('logout', 'views/logout');
$router->get('404', 'views/404');


echo "test";