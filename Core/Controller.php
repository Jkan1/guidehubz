<?php
namespace Core;

abstract class Controller
{
  protected $route_params = [];

  public function __construct($route_params)
  {
    $this->route_params = $route_params;
  }

  public function __call($method_name, $args)
  {
    $method = $method_name.'Action';

    if(method_exists($this,$method))
    {
        if($this->before() !== false)
        {
          call_user_func_array([$this, $method], $args);
          $this->after();
        }
    }else{
      $xxx = get_class($this);
      $xxx = str_replace('App\Controllers\\', '', $xxx);
      //echo "Method $method_name not found in controller $xxx";
      throw new \Exception("Method $method_name not found in controller $xxx");
    }
  }

  protected function before()
  {
  }

  protected function after()
  {
  }

}

?>