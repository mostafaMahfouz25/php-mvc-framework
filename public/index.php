<?php 
define("ROOT_PATH",dirname(__DIR__).DIRECTORY_SEPARATOR);
// twig template engin 
require(ROOT_PATH.'vendor/autoload.php');


// set error handler 
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');




/**
 * 
 * Routing
 * 
 */
// fire router class 
$router = new Core\Router();
// define all routes 
$router->add('/',['controller'=>'Home','action'=>'index']);
$router->add('/home/index',['controller'=>'Home','action'=>'index']);
$router->add('/news/index',['controller'=>'News','action'=>'index']);

$router->add('/posts/index',['controller'=>'Posts','action'=>'index']);


$router->add('/products/add',['controller'=>'Products','action'=>'add']);
$router->add('/products/index',['controller'=>'Products','action'=>'index']);
$router->add('/products/{id}/show',['controller'=>'Products','action'=>'show']);

$router->add('/admin/user/index',['controller'=>'User','action'=>'index','namespace'=>"Admin"]);


// run mvc pattern 
$router->dispatch();
// echo phpinfo();

