<?php 
namespace App\Controllers;
use \Core\View;
use App\Models\Subscriber;

class Subscribe extends \Core\Controller
{

protected function before()
{
  $s_status = 0;

  if(isset($_POST["submit"]))
  {
    $e_email = $_POST["email"];
    $e_email = strtolower($e_email);
    //$e_email = htmlspecialchars($e_email);

    //echo $e_email;
    
    $e_email = filter_var($e_email, FILTER_SANITIZE_EMAIL);

    $to = $e_email;  
    $from = "GuideHubZ <noreply@guidehubz.com>";
    $headers = "From: " . $from . "\r\n";
    $subject = "Welcome | GuideHubZ";
    $body = "Your Subscription is Succesfull : ".$e_email;
    if (filter_var($e_email, FILTER_VALIDATE_EMAIL)) 
    {
      //echo("$e_email is a valid email address");
      
      if(count(Subscriber::getAll($e_email)) > 0)
      {
        $s_status = 1;
      }
      else if (mail($to, $subject, $body, $headers, "-f " . $from))
      {
        $result = Subscriber::insertAll($e_email); 
        if(!$result)
        {
          $s_status = 3;
        }else
        {
          $s_status = 2;  
        }
        //echo 'Your e-mail ('.$e_email.') has been added to our mailing list!';
      }else{
        $s_status = 4;    
      }
    }    
    else {
      $s_status = 10;  
    }      
  }

  if (!session_id()) 
  {   
    session_start();
  }
  
  if($s_status == 1)
  {
    $_SESSION['flashMessage'] = "<script>alert('This Email is Already Subscribed !!');</script>";
  }
  else if($s_status == 2)
  {
    $_SESSION['flashMessage'] = "<script>alert('Thankyou for Subscribing !');</script>";
  }
  else if($s_status == 3)
  {
    $_SESSION['flashMessage'] = "<script>alert('Email not Subscribed !!');</script>";
  }
  else if($s_status == 4)
  {
    $_SESSION['flashMessage'] = "<script>alert('Email not Found !!');</script>";
  }
  else if($s_status == 10)
  {
    $_SESSION['flashMessage'] = "<script>alert('Email error !');</script>";
  }

}

protected function after()
{
  //echo " (after)";
}

public function indexAction()
{

  /*$string = $_SERVER['HTTP_REFERER'];
  echo $_SERVER['HTTP_REFERER'];
  echo "<br>";
  $hostname = $_SERVER['HTTP_HOST'];
  echo $_SERVER['HTTP_HOST'];
  echo "<br>";
  echo $_SERVER['REQUEST_URI'];
  echo "<br>";
  $result = str_replace($hostname, '', $string);  # Replace with case insensitive matching
  $result = preg_replace('/\s+/', '', $string);      # Strip all whitespaces
  echo $string;*/

  header('Location: ' . $_SERVER['HTTP_REFERER']);
  //header("location: /Home");
 //View::renderTemplate('subscribe.html',[]);
}

}

?>
