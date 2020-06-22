<?php
  /* 
  Front Controller
  PHP
  Public Folder
  */

  require_once dirname(__DIR__) . '/Vendor/autoload.php';
  //Twig_Autoloader::register();

  /*spl_autoload_register(function ($class) {
      $root = dirname(__DIR__);
      $file = $root.'/'.str_replace('\\','/',$class).'.php';
      if(is_readable($file)) {
          require $root . '/' . str_replace('\\','/',$class) . '.php';
      }
  });*/

  error_reporting(E_ALL);
  set_error_handler('Core\Error::errorHandler');
  set_exception_handler('Core\Error::exceptionHandler');

  //require '../Core/Router.php';
  //require '../App/Controllers/Posts.php';
  //use Core\Router as Router ;

  $router = new Core\Router();

  //Add some Routes
  $router->add('',['controller' => 'Home', 'action' => 'index']);
  $router->add('download/{var}',['controller' => 'Download', 'action' => 'index']);
  $router->add('joblist/{var}',['controller' => 'Joblist']);
  $router->add('exampapers/{action}/{var}',['controller' => 'ExamPapers']);
  //$router->add('exampapers/{var}',['controller' => 'ExamPapers', 'action' => 'index']);
  $router->add('admin/{controller}',['controller' => 'users', 'action' => 'index', 'namespace' => 'Admin']);
  $router->add('{controller}/{action}');  
  $router->add('{controller}');
  //$router->add('{controller}/{action}/{id:\d+}');
  //$router->add('{controller}/{id:\d+}/{action}');
  // Display the routing table
  //echo '<pre>';
  //var_dump($router->getRoutes());
  //echo '</pre><br><br>';
  //$url = $_SERVER['QUERY_STRING'];
  //echo $_SERVER['QUERY_STRING'];
  //echo $_GET['search'];

  $router->dispatch($_SERVER['QUERY_STRING']);

  ?>