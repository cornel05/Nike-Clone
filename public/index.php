<?php

require_once __DIR__ . '/../config/config.php';

$router = new Router();

// Home routes
$router->get('/', 'HomeController', 'index');

// Product routes
$router->get('/products', 'ProductsController', 'index');
$router->get('/products/search', 'ProductsController', 'search');
$router->get('/product/(\d+)', 'ProductController', 'show');

// Launches routes
$router->get('/launches', 'LaunchesController', 'index');
$router->get('/launch/(\d+)', 'LaunchesController', 'show');

// Auth routes
$router->get('/login', 'AuthController', 'loginForm');
$router->post('/login', 'AuthController', 'login');
$router->get('/register', 'AuthController', 'registerForm');
$router->post('/register', 'AuthController', 'register');
$router->get('/logout', 'AuthController', 'logout');

// Store routes
$router->get('/stores', 'StoresController', 'index');
$router->get('/store/(\d+)', 'StoresController', 'show');

// API routes
$router->get('/api/products/search', 'ApiController', 'searchProducts');
$router->get('/api/stores/nearby', 'ApiController', 'nearbyStores');
$router->post('/api/launch/notify', 'ApiController', 'launchNotify');

$router->dispatch();