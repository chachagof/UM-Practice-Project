<?php
require_once '../app/Connector.php';
require_once '../app/models/User.php';
require_once '../app/Router.php';
require_once '../app/controllers/AuthController.php';
require_once '../app/controllers/UserController.php';

session_start();

$connector = new Connector('database.sqlite');
$connector->initialize();
$db = $connector->getPdo();
$userModel = new User($db);
$router = new Router();

$authController = new AuthController($userModel);
$userController = new UserController($userModel);

$router->addRoute('/register', function () use ($authController) {
  $authController->register();
});

$router->addRoute('/login', function () use ($authController) {
  $authController->login();
});

$router->addRoute('/home', function () use ($userController) {
  $userController->home();
});

$router->addRoute('/members', function () use ($userController) {
  $userController->members();
});

$router->handleRequest($_SERVER['REQUEST_URI']);
