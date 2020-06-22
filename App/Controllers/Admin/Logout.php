<?php 
namespace App\Controllers\Admin;
use \Core\View;
//use App\Models\Admin\User;

class Logout extends \Core\Controller
{

protected function before()
{
}

protected function after()
{
}

public function indexAction()
{  
  session_start();
  session_unset();
  header("location: /admin/users");
}

}

?>
