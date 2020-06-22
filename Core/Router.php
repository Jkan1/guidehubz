<?php
  namespace Core;
  /*
    Router Class
    PHP
  */

  class Router
  {

    /**
     * Associative array of routes (the routing table)
     */
    protected $routes = [];

    protected $params = [];

    /**
     * Add route to the routing table
     * 
     * @param string $route The route URL
     * @param array $params Parameters (controller,action, etc)
     * @return void
     */
    
    public function add($route, $params= [])
    {
      //$this->routes[$route] = $params;  
      $route = preg_replace('/\//','\\/',$route);
      $route = preg_replace('/\{([a-z]+([0-9]*[a-z]*)*)\}/', '(?P<\1>[a-z-]+([0-9]*[a-z]*)*)', $route);
      $route = preg_replace('/\{([a-z]+([0-9]*[a-z]*)*):([^\}]+)\}/', '(?P<\1>\2)', $route);
      $route  = '/^' . $route . '$/i';
      $this->routes[$route] = $params;    
    }

    public function getRoutes()
    {
      return $this->routes;
    }

    public function match($url)
    {
       // foreach($this->routes as $route => $params)
        //{
          //if($url == $route)
          //{
            //$this->params = $params;
            //return true;
         // }
        //}
        //return false;
        // $re = "/^(?P<controller>[a-z-]+)\/(?P<action>[a-z-]*)$/" ;
            
      foreach($this->routes as $route => $temp)
      {
        if(preg_match($route, $url , $array))
        {
         // $temp = [];
          foreach($array as $key => $val)
          {
            if(is_string($key))
            {
              $temp[$key] = $val ;
            }    
          }
          $this->params = $temp;
          return true;
        }
    }
          return false;
  }

    public function getParam()
    {
      return $this->params;
    }





  public function dispatch($url)
  {
    $url = $this->removeQueryStringVariables($url);

    if($this->match($url))
    {
      $controller = $this->params['controller'];
      $controller = $this->convertToStudlyCaps($controller);
      //$controller = "App\Controllers\\$controller";
      $controller = $this->getNamespace() . $controller;

      if(class_exists($controller))
      {
        $controller_obj = new $controller($this->params);

        if(array_key_exists('action', $this->params))
        {
          $action = $this->params['action'];
        }else{
          $action = 'index';
        }

        if(array_key_exists('var', $this->params))
        {
          $var = $this->params['var'];
        }else{
          $var = NULL;
        }
        

        //$action = $this->params['action'];
        $action = $this->convertToCamelCase($action);
          //preg_match('/action$/i', $action) == 0
          //is_callable([$controller_obj, $action])
        if(preg_match('/action$/i', $action) == 0)
        {
          $controller_obj->$action($var);
        }else{
          //echo "Method $action in controller $controller not found!";
          throw new \Exception("Method $action in controller $controller not found!");
        }
      }else{
        //echo "Controller class $controller not found!";
        throw new \Exception( "Controller class $controller not found!");
      }
    }else{
      //echo 'No Route found!';
      throw new \Exception('No Route found.', 404);
    }
  }




  protected function convertToStudlyCaps($string)
  {
    return str_replace(' ','',ucwords(str_replace('-',' ',$string)));
  }

  protected function convertToCamelCase($str)
  {
    return lcfirst($this->convertToStudlyCaps($str));
  }

  protected function removeQueryStringVariables($url)
  {
    if($url != '')
    {
      $parts = explode('&',$url,2);
      if(strpos($parts[0], '=')===false)
      {
        $url = $parts[0];
      }else{
      $url = '';
      }
    }
    return $url;
  }

  protected function getNamespace()
  {
    $namespace = 'App\Controllers\\';

    if(array_key_exists('namespace', $this->params))
    {
      $namespace .= $this->params['namespace'] . '\\';
    }
    return $namespace;
  }

  }
  ?>