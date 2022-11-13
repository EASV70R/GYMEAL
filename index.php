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

//var_dump(session_status() == PHP_SESSION_ACTIVE); // false
