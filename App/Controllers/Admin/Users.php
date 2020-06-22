<?php 
namespace App\Controllers\Admin;
use \Core\View;
use App\Models\Admin\User;

class Users extends \Core\Controller
{

protected function before()
{
}

protected function after()
{
}

public function indexAction()
{




  session_start(); // Starting Session
  $error=''; // Variable To Store Error Message
  $_SESSION['logged-in'] = false;

  if (isset($_POST['submit'])) 
  {     
  $e_user = $_POST['username'];    
  $e_pass = $_POST['password'];
  
  if (empty($e_user) || empty($e_pass)) {
  $error = "Username or Password cannot be Empty!";
  }
  else if(strlen($e_user) < 3 || strlen($e_pass) < 6 || strlen($e_pass) >12 )
  {
        $error = 'Username or Password incorrect!';
  }
  else 
  {
    $result = User::getAll($e_user,$e_pass);
    if (count($result) > 0)
        { 
          $s_username = $result[0]['username'];
          $s_password = $result[0]['password'];

          if($e_user == $s_username  &&  $e_pass == $s_password)
          {
            $error= "Password Match!";
            $_SESSION['logged-in'] = true;
            $_SESSION['user'] = $s_username;
            header("Location: /admin/profile"); 
            //$_SESSION['logged-in'] = true;
            //$_SESSION['user'] = $s_username;
          }  //End of Password Match
          else 
          {
            $error ="Wrong Password!";
            //$_SESSION['logged-in'] = false; 
          }
        } //End of $result->num_rows > 0
        else 
        {   
          $error = "No Account Found!";   
        }
  
  }
  }
  
 View::renderTemplate('Admin/users.html',[
    'error' => $error
    //'colors' => ['red','green','blue']
 ]);
}

}

?>